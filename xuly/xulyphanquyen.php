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
include '../connectdb/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $func_id = $_POST['func_id'];
    $role_id = $_POST['role_id'];
    $status = $_POST['status'];

    $con = ketnoi();
    $sql = "UPDATE func_role SET status = $status WHERE func_id = $func_id AND role_id = $role_id";
    $query = mysqli_query($con, $sql);

    if (!$query) {
        echo "0";
    } else {
        echo "1";
    }
}
?>
