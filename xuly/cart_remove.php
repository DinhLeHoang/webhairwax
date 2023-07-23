<?php
    require '../connectdb/connect.php';
    require '../model/cart_model1.php';
    session_start();
    $con = ketnoi();
    $cartmodel = new cart_model1();
    $item_id=$_GET['id'];
    $size=$_GET['size'];
    $user_id=$_SESSION['username'];
    $idgio = $cartmodel->getIDgiohangbyUsername($user_id);
    $delete_query="delete from chi_tiet_gio_hang where id_gio_hang=$idgio and id_sanpham=$item_id and size='$size'";
    $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
    $delete_query1="delete from gio_hang where id_gio_hang=$idgio";
    $delete_query_result1=mysqli_query($con,$delete_query1) or die(mysqli_error($con));
    header('location: ../giaodien/cart.php');
?>