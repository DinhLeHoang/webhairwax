<?php
session_start();
require '../connectdb/connect.php';
$con = ketnoi();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$email = mysqli_real_escape_string($con, $_POST['email']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$address = mysqli_real_escape_string($con, $_POST['address']);
$username=$_SESSION['username'];

$query = "update user_new,account set email='$email', phone='$phone', name='$name', address='$address' 
where user_new.user_key=account.username and account.username='$username'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
if (mysqli_affected_rows($con) > 0) {
    echo '1';
} else {
    echo '0';
}
?>