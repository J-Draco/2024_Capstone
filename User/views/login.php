<?php
#login.php
    if(isset($_SESSION['username'])){
        header('Location: index.php?controller=user&action=main');
    }else{
        // 로그인하지 않은 경우 로그인 폼 표시
           include 'loginpage.php';   }
?>