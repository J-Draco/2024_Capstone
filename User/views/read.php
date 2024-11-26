<head>
    <title> <?php
        echo $title;
    ?>
    </title>
</head>
<body>
<?php
    include 'nav.php';
?>
<section class="align-items-center py-5">

    <main class="container">
        <div class="align-content-center">

            <div class=" py-1"></div>
            <div class="hstack gap-3">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <p class=" lh-lg fs-2 fw-bold mb-0"><?php echo $title; ?></p>
                    <p class="text-muted fs-5 mb-0 "> <?php echo $category; ?></p>
                </div>
            </div>
            <div class="py-1"></div>
            <div class="table-group-divider py-1"></div>
            <div class="hstack gap-1">
                <div class="d-flex justify-content-between w-100 align-items-center">
                <a class="fw-lighter fs-6 mb-0 nav-link" href="#"><?php echo $username; ?> </a>
                    <div class="hstack gap-1">
                <p class="fw-light fs-6 mb-0"><?php echo $date; ?></p>
                        <div class="vr"></div>
                    <p  class="fw-light fs-6 mb-0">댓글수 : <?php echo $hit; ?></p>
                    </div>
                </div>
            </div>
            <div class="py-1"></div>
            <div class="table-group-divider py-3" style="border-color:gray;border-width: thin "></div>
                <h2><?php echo $content ?></h2>
            <?php if ($image): ?>
                <div class="image-container">
                    <img src="<?php echo $image; ?>" alt="게시글 이미지" class="img-fluid" />
                </div>
            <?php endif; ?>
        </div>

    </main>

</section>

</body>
