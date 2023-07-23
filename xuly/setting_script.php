<?php
    session_start();
    require '../connectdb/connect.php';
    // require '../model/encrypt.php';
    $con = ketnoi();
    if(!isset($_SESSION['username'])){
        header('location:index.php');
    }  
    $old_password= mysqli_real_escape_string($con,$_POST['old']);
    $new_password= mysqli_real_escape_string($con,$_POST['new']);

    $username = $_SESSION['username'];

    $password_from_database_query="select password from account where username='$username'";
    $password_from_database_result=mysqli_query($con,$password_from_database_query) or die(mysqli_error($con));
    $row=mysqli_fetch_array($password_from_database_result);
    $passData = $row['password'];
    if($passData == $old_password){
        $update_password_query="update account set password='$new_password' where username='$username'";
        $update_password_result=mysqli_query($con,$update_password_query) or die(mysqli_error($con));
        echo "1";
    }else{
        echo "0";
    }
?>