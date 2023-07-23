<?php
    
    require '../connectdb/connect.php';
    session_start();
    $con = ketnoi();
    if(!isset($_SESSION['username'])){
        header('location: login.php');
    }
    $user_id=$_SESSION['username'];
    $query= "select user_id from user_new,account where user_new.user_key=account.username and account.username='$user_id'";
    $result0 = mysqli_query($con, $query);
    $row0=mysqli_fetch_assoc($result0);
    $userid=$row0["user_id"];
    $user_products_query="select ct.id_sanpham,g.ten, ncc.ten_nha_cung_cap,ct.size,ct.so_luong,g.don_gia
                        from chi_tiet_gio_hang as ct 
                        join sanpham as g
                        on ct.id_sanpham = g.id_sanpham
                        join nha_cung_cap as ncc
                        on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap
                        join gio_hang as gio
                        on ct.id_gio_hang = gio.id_gio_hang
                        where gio.user_id =$userid";
    $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
    $no_of_user_products= mysqli_num_rows($user_products_result);
    $sum=0;
    if($no_of_user_products!=0){
        
        //echo "Add items to cart first.";
    ?>
        <!--<script>
        window.alert("No items in the cart!!");
        </script>-->
        
    <?php
    
        while($row=mysqli_fetch_array($user_products_result)){
            $sum=$sum+$row['don_gia']*$row['so_luong']; 
       }
    }
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
    </head>
    <body>
        <div>
            <?php 
               require '../giaodien/header.php';
            ?>
            <br>
            <div class="container">
                <?php require '../xuly/xulycart.php';?>
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
    <script type="text/javascript">
        function thongbao(){
            alert("Thay đổi thành công!");
        }
        function xacnhantaodonhang(){
            var r= confirm("Bạn có muốn tạo đơn hàng?");
                if (r==true)
                  {
                      location="../xuly/xulytaodonhang.php";
                    <?php //header('location:../xuly/xulytaodonhang/php');?>
                    //alert("Đơn hàng của bạn đã được tạo!");
                  }
        }
        document.getElementById("cfchange").onclick = thongbao;
        document.getElementById("createorder").onclick = xacnhantaodonhang;
        </script>
</html>
