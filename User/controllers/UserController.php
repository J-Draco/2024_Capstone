<?php
session_start();
require_once "User/config/database.php";
require_once "User/models/UserModel.php";
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
                header('Location: index.php?controller=user&action=login'); // index.php로 리디렉션
                exit();
                }else{
                echo "로그인 실패 : 잘못된 사용자 또는 비밀번호 입니다.";
                include "User/views/login.php";
            }
        }else{
            include "User/views/login.php";
        }
    }

    public function logout()
    {
        $session_id=session_id();
        session_unset();
        session_destroy();


        $this->model->deleteSession($session_id);
        header('Location: index.php?controller=user&action=login');

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
            include 'User/views/signup.php';
        }
    }
}
?>