<head>
    <title>작성하기</title>
</head>
<body>
<?php
include 'nav.php';
?>

<section class="align-items-center py-5">
    <div class="d-flex justify-content-center">
        <form action="/index.php?controller=user&action=write" method="POST" enctype="multipart/form-data" style="width: 75%;">
            <div class="mb-3">
                <label for="title" class="form-label">제목</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">카테고리</label>
                <select id="category" name="category" class="form-select">
                    <option value="SqlInjection">SQL Injection</option>
                    <option value="xss">XSS</option>
                    <option value="csrf">CSRF</option>
                    <option value="요청사항">요청사항</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">내용</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">이미지 업로드</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-sm btn-outline-secondary">작성하기</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
