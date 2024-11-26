<?php
require_once "User/controllers/UserController.php";
$controller = new UserController();
$controller->checkSessionTimeout();

if (isset($_GET['controller']) && $_GET['controller'] === 'user') {
    if (isset($_GET['action']) && $_GET['action'] === 'login') {
        $controller->login();
    }else if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        $controller->logout();
    }else if (isset($_GET['action']) && $_GET['action'] === 'signup') {
        $controller->signup();
    }else if (isset($_GET['action']) && $_GET['action'] === 'main'){
        $controller->main();
    }else if (isset($_GET['action']) && $_GET['action'] === 'checkDuplication'){
        $controller->checkDuplication();
    }else if(isset($_GET['action']) && $_GET['action'] === 'board'){
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 0; // $_GET['page']가 없거나 숫자가 아니면 기본값 0
        $category = isset($_GET['category']) ? $_GET['category'] : 'all';
        $controller->boardlist($page,$category);
    }else if(isset($_GET['action']) && $_GET['action'] === 'problem'){
        $controller->problem();
    }else if(isset($_GET['action']) && $_GET['action'] === 'write'){
        $controller->write();
    }else if(isset($_GET['action']) && $_GET['action'] === 'read'){
        if(isset($_GET['idx'])) {
            $controller->read();
        }else{
            echo"<script>alert('비정상적인접근입니다.')</script>";
            $controller->main();
        }
    }else if(isset($_GET['action']) && $_GET['action'] === 'submit'){
        $token = isset($_POST['token']) ? $_POST['token'] : 'null';
        error_log("Received token: " . $_POST['token']);

        $controller->submit($token);
    }

    else{
        echo"<script>alert('비정상적인접근입니다.')</script>";
        $controller->main();
    }
}else{
    $controller->main();
}

?>
