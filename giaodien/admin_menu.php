<div class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../giaodien/index.php"><img src="../img/logoshop.png" alt="..." width="100px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <!-- xóa -->
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../giaodien/admin.php">Trang chủ</a>
                    </li>
               </ul>
                <ul class="navbar-nav px-3">
                    <li class="nav-item text-nowrap">
                        <p class="nav-link">
                            <?php if (isset($_SESSION['username'])) {
                            ?>Xin chào quản trị viên
                        <?php } ?>
                        </p>
                    </li>
                    <?php if (isset($_SESSION['username'])) {
                    ?>
                        <li class="nav-item text-nowrap">
                            <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
                            <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="../giaodien/logout.php">Đăng Xuất</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
    </nav>
</div>