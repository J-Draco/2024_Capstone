
<head>
    <title>CodeXGuard</title>
</head>
<body class="bg-black">
<div class="bg-black">
    <?php
    include 'nav.php';
    ?>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 position-relative">
                <!-- 이미지: 네비게이션 바를 가리지 않게, 위로 올리되  -->
                <img src="/public/resources/Main.png" class="img-fluid w-100" alt="메인 이미지" style="max-height: 100vh; object-fit: cover; position: relative; top: -20px; margin-top:20px;">

                <!-- 텍스트: 이미지 위에 겹치게, 네비게이션 바와 겹치지 않도록 아래로 이동 -->
                <div class="text-center position-absolute bottom-0 start-50 translate-middle-x p-4 text-light" style="background-color: rgba(0,0,0,0.5); z-index: 15;">
                    <p class="mb-2" id="mainText" style="font-size: 1vw; line-height: 1.6;">
                        CodexGuard는 클라우드 기반의 웹 애플리케이션으로, 웹 보안 테스트와 학습을 위한 혁신적인 플랫폼입니다.<br>
                        사용자는 다양한 웹 보안 취약점을 직접 경험하고 실습할 수 있으며, 이를 통해 보안에 대한 깊은 이해를 쌓을 수 있습니다.<br>
                        클라우드 환경을 통해 언제 어디서나 쉽게 접근할 수 있어, 보안 테스트를 보다 효율적으로 수행할 수 있습니다.<br>
                        CodexGuard는 초보자부터 전문가까지 모두에게 유용한 학습 도구를 제공하여, 웹 보안 역량을 강화하는 데 기여합니다.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div><div class="bg-black text-light">
<?php   include'footer.php';?>
</div>
</body>
