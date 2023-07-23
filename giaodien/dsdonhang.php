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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <h2 class="a0">Danh sách đơn hàng</h2>
                    <!--<div class="a00">
                        <p>Mã hóa đơn:</p>
                        <p>Email khách hàng:</p> 
                        <p>Số điện thoai:</p>
                    </div>-->
                    
<?php
$con = ketnoi();
$user_id = $_SESSION['id'];
$sql0="select user_id from user_new,account where user_new.user_key=account.username and account.account_id='$user_id'";
        $result0= mysqli_query($con, $sql0);
        $row0=mysqli_fetch_assoc($result0);
        $userid=$row0["user_id"];
$sql = "select * from don_hang where user_id=$userid and tinh_trang='Processing'";
$query = mysqli_query($con, $sql);
if(mysqli_num_rows($query) != 0){

    ?>
                    <table class="aa1"  > 
                        <tr class="aa2">
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Total</th> 
                            <th>Detail</th>
                            <th>Payment</th>
                            <th>Cancel</th>
                        </tr>
                        <tbody>
                                <?php $i = 1;
    while ($row = mysqli_fetch_assoc($query)) {?>
                                <tr id="a1">     

                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['ma_don_hang']; ?></td>
                                    <td><?php echo $row['tong_tien']; ?></td>
                                    <td><a href="../giaodien/chitietdonhang.php?orderid=<?php echo $row['ma_don_hang']; ?>">Detail</a></td>
                                    <td><a class="btn btn-primary" href="../giaodien/success.php?orderid=<?php echo $row['ma_don_hang'];?>">Confirm Order</a></td>
                                    <td><a class="btn btn-danger" href="../xuly/xulyhuydonhang.php?orderid=<?php echo $row['ma_don_hang'];?>">Cancel Order</a></td>
                                </tr>
<?php } 

    }
else{
    echo "<h3>No order at the moment!</h3>";
}
?>

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
