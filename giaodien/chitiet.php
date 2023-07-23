<?php 
    session_start();
?>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HTVC Admin</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../bootstrap/css/admin.css">
        <link rel="stylesheet" href="../bootstrap/css/admin2.css">
        <!--<link rel="stylesheet" href="/font-awesome/css/all.css">-->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    </head>

    <body style="background-color: #F0F0F0;" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
        <?php require '../giaodien/admin_menu.php';?>
        <div class="main">

            <div class="aa">
                <h2 class="a0">Chi tiết đơn hàng</h2>
                <table class="aa1"  > 
                    <tr class="aa2">
                        <th>#</th>
                       
                        <th>id</th>
                        <th>Tên mặt hàng</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        
                    </tr>
                    <tbody>


                        <?php
                        include '../connectdb/connect.php';
                        $con = ketnoi();
                         $user_id=$_GET['user_id'];
                         $don=$_GET['don'];
                        $sql = "select ct.id_sanpham,g.ten, ct.size, ct.so_luong, ct.don_gia, don.ngay_gio_thanh_toan, don.ten_nguoinhan, don.sdt_nguoinhan, don.diachi_giaohang
                                from don_hang as don 
                                join chi_tiet_don_hang as ct
                                on don.ma_don_hang = ct.ma_don_hang
                                join sanpham as g
                                on ct.id_sanpham = g.id_sanpham
                                where don.ma_don_hang=$don and don.user_id=$user_id";
                        $query = mysqli_query($con, $sql);

                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr id="a1">     
                               

                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['id_sanpham']; ?></td>
                                <td><?php echo $row['ten']; ?></td>
                                <td><?php echo $row['size']; ?></td>
                                 <td><?php echo $row['so_luong']; ?></td>
                                 <td><?php echo $row['don_gia']; ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>  
                </table>
            </div>


        </div>
        <div>
            <footer class="footer">
               <div class="container">
                <center>
                   <p style="padding-top: 20px;">Copyright &copy Store. All Rights Reserved.</p>
                   <br><br><br>
                   <!--<p>This website is developed by Yugesh Verma</p>-->
               </center>
               </div>
           </footer>
        </div>


    </body>

</html>