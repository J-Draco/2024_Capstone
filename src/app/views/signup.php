<!DOCTYPE html>
<html lang="ko">
<head>
    <title>회원가입</title>
</head>
<body>
<?php
require_once ('nav.php');
?><section>
<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-center">
            <div class="card border-dark mb-3" style="max-width: 100rem;">
                <div class="card-header text-center">회원가입</div>
                <div class="card-body">
                    <form method="POST" action="/index.php?controller=user&action=signup" class="needs-validation" novalidate>
                        <div class="form-floating mb-4">
                            <div class="input-group input-group-lg mb-3">
                            <input type="text" name="username" id="user_id" class="form-control form-control-sm" placeholder="아이디" aria-describedby="checkid" required>

                                <button type="button" id="checkDup" class="btn btn-outline-secondary">중복 확인</button>

                            </div>

                            <div id="checkid" class="invalid-feedback">
                                아이디을 입력 해주세요.
                            </div>
                            <div id="duplicateCheckMessage" class="form-text mt-1"></div>
                        </div>

                        <div class="form-floating mb-4">
                            <div class="input-group-lg">
                            <input type="password" name = "userpw" id="user_pw" class="form-control form-control-sm" placeholder="비밀번호" aria-describedby="checkpw" required>
                            <label class="form-label" for="user_id"></label>
                            <div id="checkpw" class="invalid-feedback">
                                비밀번호를 입력 해주세요.
                            </div>
                        </div>
                        </div>
                        <div class="d-flex justify-content-center">
                        <button type="submit" id="signupBtn" class="btn btn-secondary " disabled>회원가입</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</section>
<script>
    document.getElementById('checkDup').addEventListener('click', function () {
        const username = document.getElementById('user_id').value;
        const duplicateCheckMessage = document.getElementById('duplicateCheckMessage');

        duplicateCheckMessage.textContent = "확인 중...";
        duplicateCheckMessage.className = "form-text text-dark";

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?controller=user&action=checkDuplication", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText.trim();

                if (response === "available") {
                    duplicateCheckMessage.textContent = "사용 가능한 아이디입니다.";
                    duplicateCheckMessage.className = "form-text text-success";
                    document.getElementById('signupBtn').disabled = false;
                } else if (response === "unavailable") {
                    duplicateCheckMessage.textContent = "이미 사용 중인 아이디입니다.";
                    duplicateCheckMessage.className = "form-text text-danger";
                    document.getElementById('signupBtn').disabled = true;
                } else {
                    duplicateCheckMessage.textContent = response;
                    duplicateCheckMessage.className = "form-text text-warning";
                    document.getElementById('signupBtn').disabled = true;
                }
            }
        };

        xhr.send("username=" + encodeURIComponent(username));
    });

</script>
<script>
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }



                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
<?php include 'footer.php';?>
</body>
</html>
