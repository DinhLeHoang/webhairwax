<?php 
session_start();
                    if(isset($_SESSION['email'])){
                            $user = $_SESSION['email'];
                        }
                        else{
                            $user = "";
                        }
                     
                    if($user === ""){
                    echo "<script>
                    alert('Vui lòng đăng nhập trước!');
                    window.location.href='../giaodien/Dangnhap.php';
                    </script>";
                    }
                    ?>
<html>

    <head>
        <meta charset="UTF-8">
      <!-- Latest compiled and minified CSS -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/csskho.css" type="text/css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->


<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title></title>

    </head>
<body>  
    <?php

    require '../../connectdb/connect.php';
 require 'header.php';
 $con = ketnoi();
 ?>
    
<div class="container">
<div class="col-md-12">
          <?php

$id = $_GET['id'];
$get = $_GET['loai'];
    if(strcmp($get, "nhapkho") == 0){
        ?>
    <table id="tablenhapkho" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã nhập kho</th>
                <th>ID giày </th>
                <th>Size</th>
                <th>Số lượng của size</th>
                <th>Đơn giá</th>
                
            </tr>
       </thead>
       <tbody>
    <?php
    $sql = "select * from chi_tiet_nhap_kho where ma_nhap_kho=$id"; 
$query = mysqli_query($con, $sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
    ?>
                                <tr id="a1">     

                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['ma_nhap_kho']; ?></td>
                                    <td><?php echo $row['id_giay']; ?></td>
                                    <td><?php echo $row['size']; ?></td>
                                    <td><?php echo $row['so_luong_cua_size']; ?></td>
                                    <td><?php echo $row['don_gia']; ?></td>

                                </tr>
                                
<?php }

?>
       </tbody>
    </table>
<?php
}
 else { 
     ?>
     <table id="tablexuatkho" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã xuất kho</th>
                <th>ID giày </th>
                <th>Size</th>
                <th>Số lượng của size</th>
            </tr>
       </thead>
       <tbody>
           <?php
     $sql = "select * from chi_tiet_xuat_kho where ma_xuat_kho=$id"; 
$query = mysqli_query($con, $sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
 ?>
                                <tr>     

                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['ma_xuat_kho']; ?></td>
                                    <td><?php echo $row['id_giay']; ?></td>
                                    <td><?php echo $row['size']; ?></td>
                                    <td><?php echo $row['so_luong_cua_size']; ?></td>

                                </tr>
                                <?php
}
 }
?>
     </tbody>
    </table>   
    <div class="row">
        <div class="col text-center">
          <a class="btn btn-dark" style="font-size: 15px;" id="getdatatable">In phiếu</a>
        </div>
    </div>
</div>
    </div>
    </body>
</html>