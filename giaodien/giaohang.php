<?php
   include '../connectdb/connect.php';
   $con = ketnoi();
$user_id=$_GET['userid'];
$don=$_GET['don'];
 $sql="UPDATE don_hang SET tinh_trang= 'Shipped'  WHERE user_id = '$user_id' and tinh_trang='Paid' and ma_don_hang=$don";
            $query=mysqli_query($con,$sql);

            header('location:ttgh.php');
?>
