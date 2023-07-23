<?php
session_start();
//kiem tra session
if (!isset($_SESSION['username']) or !isset($_SESSION['role_id'])) {
    header("Location: ../giaodien/index.php");
    exit;
} else if ($_SESSION['role_id'] != '1' and $_SESSION['role_id'] != '2' and $_SESSION['role_id'] != '3') {
    header("Location: ../giaodien/index.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> HTVC Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <!--<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">-->
    <link rel="stylesheet" href="../css/csskho.css">
    <link rel="stylesheet" href="../bootstrap/css/admin2.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
</head>

<body style="background-color: #F0F0F0;" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
    <?php require '../giaodien/admin_menu.php'; ?>
    <!-- Navbar -->

    <?php
    include '../connectdb/connect.php';
    require '../model/paginator.php';
    require '../model/product_model.php';
    ?>
    <div class="container-fluid" style="width: 100%;">
        <div class="col">
            <div class="container-fluid" id="cacsanpham">
                <div class="card">
                    <div class="abc">

                        <table class="def">
                            <tr>
                                <?php if (isset($_SESSION['username']) && isset($_SESSION['role_id']))
                                    $con = ketnoi();
                                $roleid = $_SESSION['role_id'];
                                $query = "select * from func_role,function where func_role.func_id=function.func_id and func_role.status=1 and func_role.role_id='$roleid'";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) { 
                                    switch($row['func_id']) {
                                        case 1: $file_name='a.php?layout=them';
                                        break;
                                        case 2: $file_name='qlkh2.php';
                                        break;
                                        case 3: $file_name='ttgh.php';
                                        break;
                                        case 4: $file_name='thongke.php';
                                        break;
                                        case 5: $file_name='phanquyen.php';
                                        break;
                                    }
                                ?>
                                    <td><a href="../giaodien/<?php echo $file_name; ?>" id="def1"><?php echo $row['func_name'] ?></a></td>
                                    <!-- <td><a href="../giaodien/qlkh2.php">Quản lí tài khoản</a></td> -->
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <div class="card-header">
                        <h2>Danh sách sản phẩm</h2>
                    </div>
                    <br>

                    <div class="card-body">
                        <div class="header_search">
                            <form action="../giaodien/admin.php" method="post" id="header-search-form">
                                <input type="text" name="keyword" class="form-control searchbar" placeholder="Search..">

                                <button type="submit" name="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                        <div class="filteradmin">
                            <form action="../giaodien/admin.php" method="post" class="formfilter">
                                <?php $productmodel = new product_model();
                                $brandresult = $productmodel->getAllBrand();
                                ?>
                                <select class="form-control" name="selectedbrand">
                                    <option value="All">All</option>
                                    <?php while ($row = mysqli_fetch_assoc($brandresult)) {

                                    ?>
                                        <option value="<?php echo $row['ten_nha_cung_cap']; ?>"><?php echo $row['ten_nha_cung_cap']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <button class="btn btn-primary btnfilter" type="submit" name="submitfilter">Lọc</button>
                            </form>
                        </div>
                        <?php require '../xuly/xulyadminsearch.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <footer class="footer">
            <div class="container">
                <center>
                    <br>
                    <p>Copyright &copy Store. All Rights Reserved.</p>

                    <br>
                </center>
            </div>
        </footer>
    </div>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script src="../js/script.js"></script>
    <script>
        function Del(name) {
            return confirm("Bạn có chắc chắn muốn xóa sản phẩm: " + name + " ?");
        }
    </script>
</body>

</html>