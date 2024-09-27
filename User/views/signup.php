<!DOCTYPE html>
<html>
<head>
    <title>회원가입</title>
</head>
<body>
<form method="POST" action="/index.php?controller=user&action=signup">
    <input type="text" name="username" placeholder="사용자명" required>
    <input type="password" name="userpw" placeholder="비밀번호" required>
    <button type="submit">회원가입</button>
</form>
</body>
</html>
