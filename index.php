<?php
require_once "User/controllers/UserController.php";
$controller = new UserController();

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
    }else if(isset($_GET['action']) && $_GET['action'] === 'boardlist'){
        $controller->boradlist();
    }else if(isset($_GET['action']) && $_GET['action'] === 'problem'){
        $controller->problem();
    }
}else{
    $controller->main();
}

?>
