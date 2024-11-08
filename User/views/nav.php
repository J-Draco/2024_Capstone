<head>
    <script type="text/javascript" src="/public/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="/public/css/bootstrap.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">
            <img src="/image/logo.png" alt="LOGO" width="130" height="30">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mt-2">
                    <a class="btn btn-light btn-sm" aria-current="page" href="/index.php?controller=user&action=problem">문제집</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="btn btn-light btn-sm" href="#">랭킹</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="btn btn-light btn-sm" href="#">사용가이드</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="btn btn-light btn-sm" href="#">게시판</a>
                </li>

                <?php
                if(isset($_SESSION['username'])){

                    echo '<li><div class="btn-group">
                            <form class="d-flex ms-2 mt-2">
                      <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">'
                        .$_SESSION['username'].
                      '</button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/index.php?controller=user&action=logout">Log Out</a></li>
                      </ul>
                    </div>
                    </form>
                    </li>';

                }else{
                    echo '<li class="nav-item">
                    <form class="d-flex ms-2 mt-2">
                        <a class="btn btn-outline-secondary btn-sm" href="/index.php?controller=user&action=login">Sign in</a>
                    </form>
                </li>
                <li class="nav-item">
                    <form class="d-flex ms-2 mt-2" >
                        <a class="btn btn-dark btn-sm" href="/index.php?controller=user&action=signup">Register</a>
                    </form>
                </li>';
                }
                ?>


            </ul>
        </div>
    </div>
</nav>


</body>
