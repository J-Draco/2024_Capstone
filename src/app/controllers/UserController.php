<?php
session_start();
require_once "src/app/config/database.php";
require_once "src/app/models/UserModel.php";

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['username'];
            $user_pw = $_POST['userpw'];
            #사용자 인증
            $user_id = $this->model->authentication($user_name, $user_pw);
            if ($user_id) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user_name;

                $this->model->saveSession($user_id, session_id());#세션값을전달
                header('Location: index.php?controller=user&action=main'); // index.php로 리디렉션
                exit();
                }else{
                echo "<script>
                 alert('아이디 또는 비밀번호를 확인해주세요..');
                window.location.href = 'index.php?controller=user&action=login ';
                    </script>";
            }
        }else{
            include "src/app/views/login.php";
        }
    }

    public function logout()
    {
        $session_id=session_id();
        session_unset();
        session_destroy();


        $this->model->deleteSession($session_id);
        header('Location: index.php?controller=user&action=main');

        exit();
    }
    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['username'];
            $user_pw = $_POST['userpw'];
            $this->model->signup($user_name,$user_pw);
            header('Location: index.php?controller=user&action=login');
            exit();
        }else{
            include 'src/app/views/signup.php';
        }
    }
    public function checkDuplication() {
        if (isset($_POST['username'])) {
            $isAvailable = $this->model->checkDuplication($_POST['username']);

            if ($isAvailable) { // 존재하는 경우
                echo "unavailable"; // 이미 존재하는 아이디
            } else { // 존재하지 않는 경우
                echo "available"; // 사용 가능한 아이디
            }
        } else {
            echo "아이디를 입력하세요."; // 사용자 ID가 비어있는 경우
        }
    }
    public function main(){
        include 'src/app/views/main.php';
    }
    public function checkSessionTimeout(){
        $timeout = 30*60;
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
            // 세션이 만료되었으면 로그아웃 처리

            $this->logout();
        }else {
            // 세션 만료 시간이 갱신되었으므로, 마지막 활동 시간을 현재 시간으로 갱신
            $_SESSION['last_activity'] = time();
        }
    }
    public function boardlist($page,$category) {


        $data = $this->model->showboardlists($page,$category);  // 게시글 목록과 총 게시글 수를 반환받음

        $board = $data['result'];       // 게시글 목록
        $totalCount = $data['totalCount'];  // 총 게시글 수

        // 총 페이지 수 계산
        $totalPages = ceil($totalCount / 10); // 한 페이지당 10개씩 출력
        include 'src/app/views/board.php';  // 뷰에 전달
    }

    public function problem(){
        if(isset($_SESSION['username'])) {
            $username=$_SESSION['username'];
            $session_value = session_id();

            $jwt_token = $this->model->createJwtToken($username, $session_value);
            header('Location: http://61.245.248.211:8080/index.php?token=' . urlencode($jwt_token));
            exit();
        }else{
            echo "<script>
                alert('로그인 후 이용해 주세요.');
                window.location.href='index.php?controller=user&action=login'
                </script>";
            exit();
        }
    }

    public function write(){
        if (isset($_SESSION['username'])) {
            $username=$_SESSION['username'];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $category = $_POST['category'];
                $imagePath = null;
                if (isset($_FILES['image'])) {
                    $imagePath = $this->model->uploadImg($_FILES['image']);
                }
                $this->model->savePost($title, $username,$content, $imagePath, $category);
                header('Location: index.php?controller=user&action=board');
                exit();
            } else {
                include 'src/app/views/write.php';
            }
        }else{
            echo "<script>
                alert('로그인 후 이용해 주세요.');
                window.location.href='index.php?fcontroller=user&action=login'
                </script>";
            exit();
        }
    }
    public function read(){
        if(isset($_GET['idx'])){
            $idx=$_GET['idx'];
            $board = $this->model->read($idx);
            if(isset($board)) {
                $title = $board['title'];
                $username = $board['user_id'];
                $category = $board ['cat'];
                $date = $board['date'];
                $hit = $board['hit'];
                $content = $board['content'];
                $image = $board['image']; // 이미지 경로 추가
                include "src/app/views/read.php";
            }else{
                echo "<script>alert('허용되지 않은 접근 입니다.');
                window.location.href='index.php?controller=user&action=board'
                </script>";
                exit();
            }
        }
    }
    public function submit($token){
        $parts =explode('.', $token);

        // 토큰을 분리하여 헤더, 암호화된 페이로드, 암호화된 대칭 키, 서명 추출
        list($header, $encryptedPayload, $encryptedSymmetricKey, $signature) = $parts;
        error_log(count($parts));

        // 대칭 키 복호화
        $symmetricKey = $this->model->JwtDecryptSymmetricKey($encryptedSymmetricKey);
        if ($symmetricKey) {
            // 페이로드 복호화
            $decryptedPayload = $this->model->JwtDecryptPayload($encryptedPayload, $symmetricKey);
            if ($decryptedPayload) {
                // 디코드
                $decoded = $this->model->JwtDecode($decryptedPayload);
                if ($decoded) {
                    // 서명 검증
                    $signatureValidation = $this->model->JwtSignatureAuth($header . '.' . $encryptedSymmetricKey, $signature);
                    if ($signatureValidation) {
                        error_log($decoded['username']);
                        error_log($decoded['type']);
                        error_log($decoded['difficulty']);
                        $this->model->saveScore($decoded['username'], $decoded['type'], $decoded['difficulty']);

                    } else {
                        echo "유효하지 않은 서명";
                    }
                } else {
                    echo "페이로드 디코딩 실패";
                }
            } else {
                echo "페이로드 복호화 실패";
            }
        } else {
            echo "대칭 키 복호화 실패";
        }
    }




}
?>

