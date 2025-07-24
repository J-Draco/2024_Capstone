<head>
    <title>게시판</title>
</head>
<body>
<?php
include 'nav.php';
?>
<div>
    <section class="align-items-center py-5">
        <div class="d-flex justify-content-center" style="width: 50%">

            <select id="category" class="form-select" style="width: 50%" onchange="filterCategory()">
                <option value="all" <?php if(!isset($_GET['category']) || $_GET['category'] === 'all') echo 'selected'; ?>>전체</option>
                <option value="SqlInjection" <?php if(isset($_GET['category']) && $_GET['category'] === 'SqlInjection') echo 'selected'; ?>>SQL Injection</option>
                <option value="xss" <?php if(isset($_GET['category']) && $_GET['category'] === 'xss') echo 'selected'; ?>>XSS</option>
                <option value="csrf" <?php if(isset($_GET['category']) && $_GET['category'] === 'csrf') echo 'selected'; ?>>CSRF</option>
                <option value="요청사항" <?php if(isset($_GET['category']) && $_GET['category'] === '요청사항') echo 'selected'; ?>>요청사항</option>
            </select>

        </div>
        <div class="d-flex justify-content-center ">
            <table class="table table-hover table-striped" style="width: 75%">
                <thead>
                <tr>
                    <th scope="col">제목</th>
                    <th class="text-center" scope="col">카테고리</th>
                    <th class="text-end" scope="col">글쓴이</th>
                    <th class="text-end" scope="col">작성일</th>
                    <th class="text-end" scope="col">댓글수</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $board->fetch_assoc()) {
                    ?>
                    <tr>
                        <td class="text"><a href="index.php?controller=user&action=read&idx=<?php echo $row["id"]; ?>"> <?php echo $row['title']; ?> </a></td>
                        <td class="text-center"><?php echo $row['cat']; ?></td>
                        <td class="text-end"><?php echo $row['user_id']; ?></td>
                        <td class="text-end"><?php echo $row['date']; ?></td>
                        <td class="text-end"><?php echo $row['hit']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot style="border: none;">
                <tr>
                    <td colspan="5" class="text-end" style="border: none;">
                        <a href="/index.php?controller=user&action=write" class="btn btn-outline-secondary btn-sm">작성하기</a>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>

        <!-- 페이지네이션 버튼 -->
        <div class="d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    <?php
                    // 이전 페이지 버튼
                    if ($page > 0) {
                        echo '<li class="page-item"><a class="page-link" href="?controller=user&action=board&page=' . ($page - 1) . '">이전</a></li>';
                    }

                    // 페이지 번호 버튼
                    for ($i = 0; $i < $totalPages; $i++) {
                        echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">
                    <a class="page-link" href="?controller=user&action=board&page=' . $i . '">' . ($i + 1) . '</a>
                  </li>';
                    }

                    // 다음 페이지 버튼
                    if ($page < $totalPages - 1) {
                        echo '<li class="page-item"><a class="page-link" href="?controller=user&action=board&page=' . ($page + 1) . '">다음</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>

    </section>
    <?php include 'footer.php';?>
</body>
<script>
    function filterCategory() {
        var category = document.getElementById("category").value;
        var currentUrl = window.location.href;

        var newUrl = updateURLParameter(currentUrl, 'category', category);
        newUrl = updateURLParameter(newUrl, 'page', 0);  // 페이지 번호는 0으로 초기화

        window.location.href = newUrl;

    }

    // URL에서 파라미터를 추가하거나 수정하는 함수
    function updateURLParameter(url, param, value) {
        var newUrl;
        if (url.indexOf(param) === -1) {
            newUrl = url + (url.indexOf('?') === -1 ? '?' : '&') + param + '=' + value;
        } else {
            newUrl = url.replace(new RegExp(param + '=[^&]*'), param + '=' + value);
        }
        return newUrl;
    }
</script>
