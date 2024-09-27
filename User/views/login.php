<?php
#login.php
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'] . "님 환영합니다!";
        echo '<form method="POST" action="/index.php?controller=user&action=logout">
            <button type="submit">로그아웃</button>
          </form>';
    }else{
        // 로그인하지 않은 경우 로그인 폼 표시
        echo '<form method="POST" action="/index.php?controller=user&action=login">
            <input type="text" name="username" placeholder="사용자명" required>
            <input type="password" name="userpw" placeholder="비밀번호" required>
            <button type="submit">로그인</button>
          </form>';
        echo '<p>아직 계정이 없으신가요? <a href="/index.php?controller=user&action=signup">회원가입</a></p>';    }
?>