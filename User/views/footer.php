<div class="container">
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
            <a href="/index.php" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                <img src="/public/resources/Logo.png" alt="LOGO" width="130px" height="auto">
            </a>
            <p class="text-light">&copy; 20192753 문승민</p>
            <p class="text-light">&copy; 20202792 김지용</p>
            <p class="text-light">&copy; 20202828 제갈도원</p>
            <p class="text-light">&copy; 20202932 이현규</p>
        </div>

        <div class="col mb-3">
        </div>

        <div class="col mb-3">
            <h5 class="text-light">CodeXGuard</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="/index.php" class="nav-link p-0 text-light">Home</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Help</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
            </ul>
        </div>

        <div class="col mb-3">
            <h5 class="text-light">Main</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">랭킹</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">게시판</a></li>
            </ul>
        </div>

        <div class="col mb-3">
            <h5 class="text-light">vulnerabilities</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="/index.php?controller=user&action=problem" class="nav-link p-0 text-light">문제</a></li>
            </ul>
        </div>
    </footer>

    <div class="d-flex flex-column flex-sm-row justify-content-center py-4 my-4 border-top">
        <p>&copy; 2024 Capstone Design Team 9th</p>

    </div>
</div>
<script>
    window.onload=function(){
        var bodyClass = document.body.className;
        if(bodyClass===""){
            var elements = document.querySelectorAll('.text-light');
            elements.forEach(function(el) {
                el.classList.remove('text-light');  // Remove 'text-light' class
                el.classList.add('text-black');  // Add 'text-dark' class
            });
        }
    }
</script>
