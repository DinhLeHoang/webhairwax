<?php
require '../connectdb/connect.php';
session_start();
$con = ketnoi();


?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="../img/lifestyleStore.png" />
        <title>Projectworlds Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="../bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="../css/style.css" type="text/css">
        <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../bootstrap/css/admin.css">
    </head>
    <body>
        <div>
<?php
require '../giaodien/header.php';
?>
            <br>
            <div class="container">

                <div class="aa">
                    <!--<h2 class="a0">Phiếu thanh toán</h2>
                    <div class="a00">
                        <p>Mã hóa đơn:</p>
                        <p>Email khách hàng:</p> 
                        <p>Số điện thoai:</p>
                    </div>-->
                    <h2 class="a0">Chi tiết đơn hàng</h2>
                    <table class="aa1"  > 
                        <tr class="aa2">
                            <th>STT</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        <tbody>

<?php
$con = ketnoi();
$billid = $_GET['orderid'];
$sql = "select g.ten, ncc.ten_nha_cung_cap, ct.so_luong, ct.don_gia
        from chi_tiet_don_hang as ct 
        join sanpham as g
        on ct.id_sanpham = g.id_sanpham
        join nha_cung_cap as ncc
        on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap
        where ma_don_hang=$billid";
$query = mysqli_query($con, $sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
    ?>
                                <tr id="a1">     

                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['ten']; ?></td>
                                    <td><?php echo $row['ten_nha_cung_cap']; ?></td>
                                    <td><?php echo $row['so_luong']; ?></td>
                                    <td><?php echo $row['don_gia']; ?></td>
                                    

                                </tr>
<?php } ?>

                        </tbody>  
                    </table>
                </div>

            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <footer class="footer">
               <div class="container">
                <center>
                   <p>Copyright &copy Store. All Rights Reserved.</p>
                   <!--<p>This website is developed by Yugesh Verma</p>-->
               </center>
               </div>
           </footer>
        </div>
    </body>

</html>


