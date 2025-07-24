<head>
    <title>로그인</title>
    <style>

        .find .nav-link {
            color: #000000;
        }

        .find .nav-link:hover {
            color: darkgray;
        }
    </style>
</head>
<body>
<?php
require_once ('nav.php');
?><section class="align-items-center">
    <div class="container py-5">

        <div class="row d-flex justify-content-center ">

            <div class="col-12 col-md-8 col-sm-6 col-xl-5 text-left" style="max-width: 330px">
                <div class=" border-dark mb-3" style="max-width: 100rem;">

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


                                <input type="submit" class="btn btn-outline-secondary w-100" value="로그인">

                        </form>
                        <div class="row d-flex justify-content-center mt-3" >
                            <ul class="nav col row  justify-content-center find">

                                <li class="nav-item mb-2 col row d-flex">
                                    <a class="nav-link text-end" href="findpw.php">비밀번호 찾기</a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<?php include 'footer.php';?>
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