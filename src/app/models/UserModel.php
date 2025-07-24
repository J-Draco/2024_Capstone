<?php
#UserModel.php
#User Authentication,session
    class UserModel{
        private $db;

        public function __construct(){#생성자문법임
            $this->db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            if ($this->db->connect_error) {
                die("DB 연결 실패: " . $this->db->connect_error);
            }
        }
        public function authentication($username,$userpw){#사용자인증
            $query = $this->db->prepare("SELECT id, user_pw FROM user_info WHERE user_id = ?");
            #perepare:mysqli의 함수 쿼리준비 및 사용자입력을 쿼리에 직접 반영하지 않으므로 sqlInjection방지
            $query->bind_param("s", $username);
            #매개변수 바인데이터 타입을 명시하여 입력형태 제한가능
            $query->execute();#준비된쿼리실행
            $result = $query->get_result();#객체형태 반환
            if($result->num_rows===1){#반환받은객체의  배열 결과가 존재 한다면
                $user = $result-> fetch_assoc();#mysqli_result로 반환받은 객체에서 배열
                if(password_verify($userpw,$user['user_pw'])){#비밀번호가 해싱되기때문에 단순 비교연산자가아닌 password_verify함수 사용
                    return $user['id'];
                }
            }
            return false;
        }
        public function saveSession($user_id,$session_id){
            $query = $this->db->prepare("INSERT INTO sessions (user_id,session_id) VALUES (?,?)");
            $query->bind_param('is',$user_id,$session_id);
            $query->execute();
        }
        public function deleteSession($session_id) {
            $query = $this->db->prepare("DELETE FROM sessions WHERE session_id = ?");
            $query->bind_param("s", $session_id);
            $query->execute();
        }
        public function signup($user_name,$user_pw){
            $hashed_pw = password_hash($user_pw,PASSWORD_DEFAULT);
            $query = $this->db->prepare("INSERT INTO user_info (user_id,user_pw) VALUES(?,?)");
            $query->bind_param("ss",$user_name,$hashed_pw);
            $query->execute();
            $score_query = $this->db->prepare("INSERT INTO user_scores (user_name) VALUES(?)");
            $score_query->bind_param("s",$user_name);
            $score_query->execute();
        }
        public function checkDuplication($username) {
            $query = $this->db->prepare("SELECT * FROM user_info WHERE user_id = ?");
            $query->bind_param("s", $username);
            $query->execute();
            $result = $query->get_result();

            return $result->num_rows > 0; // 아이디가 존재하면 true, 아니면 false
        }
        public function showboardlists($page,$category){
            $start=$page*10;
            $end =10;

            if($category === 'all'){
                $query = $this->db->prepare("SELECT * FROM board ORDER BY id DESC LIMIT ?,?");
                $query->bind_param("ii",$start,$end);
                $numquery = $this->db->prepare("SELECT COUNT(*) AS total FROM board");

            }else{
                $query = $this->db->prepare("SELECT * FROM board WHERE cat=? ORDER BY id DESC LIMIT ?,?");
                $query->bind_param("sii",$category,$start,$end);
                $numquery = $this->db->prepare("SELECT COUNT(*) AS total FROM board WHERE cat = ?");
                $numquery->bind_param("s", $category);

            }
            $query->execute();
            $result = $query->get_result();
            $numquery->execute();
            $count=$numquery->get_result();
            $row = $count->fetch_assoc();

            $totalCount = $row['total'];

            return ['result' => $result, 'totalCount' => $totalCount];

        }


        public function createJwtToken($username,$session_value){
            $symmetricKey = openssl_random_pseudo_bytes(32);

            // 1번 서버의 개인 키로 서명하기 위해 로드
            $private_key = openssl_pkey_get_private(file_get_contents('src/app/config/private_key1.pem'));

            // 2번 서버의 공개 키로 암호화하기 위해 로드
            $public_key = openssl_pkey_get_public(file_get_contents('src/app/config/public_key.pem'));

            $issuedAt = time(); // 현재 시간
            $expirationTime = $issuedAt + 3600; // 1시간 뒤 만료 (단위: 초)

            $header = json_encode(['alg'=>'HS256','typ'=>'JWT']);
            $payload = json_encode(['username'=>$username,'session_value'=>$session_value,'iat' => $issuedAt,'exp' => $expirationTime]);



            $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
            $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));


            //대칭키로 페이로드 암호화
            $encryptedPayload = openssl_encrypt($base64UrlPayload, 'aes-256-cbc', $symmetricKey, 0, substr($symmetricKey, 0, 16));
            $base64UrlEncryptedPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encryptedPayload));


            // 대칭키를 2번 서버의 공개 키로 페이로드 암호화
            openssl_public_encrypt($symmetricKey, $encryptedSymmetricKey, $public_key);
            $base64UrlEncryptedSymmetricKey = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encryptedSymmetricKey));

            // 1번 서버의 개인 키로 서명 생성
            openssl_sign($base64UrlHeader . "." . $base64UrlEncryptedSymmetricKey, $signature, $private_key, OPENSSL_ALGO_SHA256);
            $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

            return $base64UrlHeader . "." . $base64UrlEncryptedPayload . "." . $base64UrlEncryptedSymmetricKey . "." . $base64UrlSignature;
        }
        public function read($idx){
            $query = $this->db->prepare("SELECT * FROM board WHERE id = ?");
            $query->bind_param("i",$idx);
            $query->execute();
            $result = $query->get_result();
            return $result->fetch_assoc();
        }
        public function savePost($title, $username, $content, $image, $category) {

            $date = date('Y-m-d H:i:s');
            $hit = 0;

            $query = $this->db->prepare("INSERT INTO board (title, user_id, content, image, date, hit, cat) VALUES (?, ?, ?, ?, ?, ?, ?)");

            $query->bind_param("sssssss", $title, $username, $content, $image, $date, $hit, $category);

            $query->execute();
        }

        public function uploadImg($file)
        {
            if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'src/uploads/'; // 파일 저장 경로

                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

                $newFileName = uniqid('img_', true) . '.' . $ext;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $uploadFile = $uploadDir . $newFileName;
                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    return $uploadFile;  // 업로드된 이미지의 경로 반환
                } else {
                    return null; // 실패한 경우 null 반환
                }
            }
            return null;
        }
        public function JwtDecryptSymmetricKey($encryptedKey) {
            $privateKey = openssl_pkey_get_private(file_get_contents('src/app/config/private_key1.pem'));

            // RSA 개인 키로 대칭 키 복호화
            $encryptedKeyDecoded = base64_decode(str_replace(['-', '_'], ['+', '/'], $encryptedKey));
            openssl_private_decrypt($encryptedKeyDecoded, $decryptedKey,$privateKey);

            if ($decryptedKey) {
                return $decryptedKey;
            } else {
                echo "대칭 키 복호화 실패: " . openssl_error_string();
                return false;
            }
        }

        public function JwtDecryptPayload($encrypted, $symmetricKey) {
            // Base64 URL 디코딩 후 복호화
            $encryptedPayload = base64_decode(str_replace(['-', '_'], ['+', '/'], $encrypted));

            // 대칭 키로 페이로드 복호화
            $decryptedPayload = openssl_decrypt($encryptedPayload, 'aes-256-cbc', $symmetricKey, 0, substr($symmetricKey, 0, 16));

            if ($decryptedPayload !== false) {
                return $decryptedPayload;
            } else {
                echo "페이로드 복호화 실패: " . openssl_error_string();
                return false;
            }
        }

        public function JwtDecode($encoded) {
            $decodedPayload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $encoded)), true);
            if ($decodedPayload !== null) {
                if (isset($decodedPayload['exp']) && time() > $decodedPayload['exp']) {
                    echo "토큰이 만료되었습니다.";
                    return false; // 토큰이 만료되었으면 false를 반환
                }
                return $decodedPayload;
            } else {
                echo "디코딩 실패";
                return false;
            }
        }

        public function JwtSignatureAuth($signedData, $signature) {
            $publicKey = file_get_contents('src/app/config/public_key.pem');
            $decodedSignature = base64_decode(str_replace(['-', '_'], ['+', '/'], $signature));

            $isValid = openssl_verify($signedData, $decodedSignature, $publicKey, OPENSSL_ALGO_SHA256);
            return $isValid === 1;
        }

        public function savescore($username,$type,$difficulty){
            $column = "{$type}_{$difficulty}";

            $query = $this->db->prepare("SELECT $column FROM user_scores WHERE user_name = ?");
            $query->bind_param("s", $username);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row[$column]) {
                    return;
                }else{
                    $updateQuery = $this->db->prepare("UPDATE user_scores SET $column = TRUE  WHERE user_name = ?");
                    $updateQuery->bind_param("s",  $username);
                    $updateQuery->execute();
                    }
            }else{
                error_log('없는사용자');
            }


        }



    }
?>