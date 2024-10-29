<head>
    <title>로그인</title>
</head>
<body>
<?php
require_once ('nav.php');
?><section class="vh-100">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-center">
    <div class="card border-dark mb-3" style="max-width: 100rem;">
        <div class="card-header text-center">로그인</div>
        <div class="card-body">
            <form method="post" action="/index.php?controller=user&action=login" class="needs-validation" novalidate>
                <div class="form-floating mb-4">
                    <input type="text" name="username" id="user_id" class="form-control form-control-sm" placeholder="ID" aria-describedby="checkid" required>
                    <label class="form-label" for="user_id">아이디</label>
                    <div id="checkid" class="invalid-feedback">
                        아이디을 입력 해주세요.
                    </div>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name = "userpw" id="user_pw" class="form-control form-control-sm" placeholder="PW" aria-describedby="checkpw" required>
                    <label class="form-label" for="user_id">비밀번호</label>
                    <div id="checkpw" class="invalid-feedback">
                        비밀번호를 입력 해주세요.
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-outline-secondary" value="로그인">
                </div>
            </form>
        </div>
        </div>
                <a action="findid">아이디 찾기</a>
                <a action="findpw">비밀번호 찾기</a>
                <a href="/index.php?controller=user&action=signup">회원가입</a>
    </div>

    </div>
    </div>

</section>
</body>
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