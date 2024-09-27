<?php
#UserModel.php
#User Authentication,session
    class UserModel{
        private $db;
        public function __construct(){#생성자문법임
            $this->db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_PORT);
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
        }



    }
?>