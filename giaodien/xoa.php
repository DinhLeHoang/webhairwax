
<?php

   $con = ketnoi();
$id=$_GET['id'];
$sql="DELETE FROM kich_co WHERE id_sanpham=$id";
$sql2="DELETE FROM sanpham WHERE id_sanpham=$id";
$query= mysqli_query($con, $sql);
$query2= mysqli_query($con, $sql2);
//echo $id;
header('location:admin.php');
?>
