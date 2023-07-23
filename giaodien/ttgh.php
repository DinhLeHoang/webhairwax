<?php 
    session_start();
?>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> HTVC Admin</title>
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
                <h2 class="a0">Thông tin đơn hàng</h2>
              
                <table class="aa1"  > 
                    <tr class="aa2">
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>user_id</th>                    
                        <th>Ngày giờ thanh toán</th>
                        <th>Tên người nhận</th>
                        <th>Địa chỉ giao hàng</th>
                        <th>Chi tiết</th>
                        <th>Giao hàng</th>
                        <th>Hóa đơn</th>

                    </tr>
                    <tbody>


                        <?php
                        include '../connectdb/connect.php';
                        $con = ketnoi();
                        $sql = "select don.ma_don_hang, u.user_id, u.email, u.phone, don.ngay_gio_thanh_toan, don.ten_nguoinhan
                            ,don.sdt_nguoinhan, don.diachi_giaohang
                                from don_hang as don join user_new as u
                                on don.user_id = u.user_id
                                where tinh_trang='Paid'";
                        $query = mysqli_query($con, $sql);

                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr id="a1">     
                              
                                
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['ma_don_hang'];?></td>
                                <td><?php echo $row['user_id']; ?></td>
<!--                                <td>
                                        <?php 
                                        ?>
                                </td>-->
                                <td><?php echo $row['ngay_gio_thanh_toan']?></td>
                                <td><?php echo $row['ten_nguoinhan']?></td>
                                <td><?php echo $row['diachi_giaohang']?></td>
                                <td><a href="../giaodien/chitiet.php?user_id=<?php echo $row['user_id']; ?>&don=<?php echo $row['ma_don_hang']; ?>"><button class="btn btn-primary"> Chi tiết</button></a></td>
                                <td><a onclick="return giao()" href="../giaodien/giaohang.php?userid=<?php echo $row['user_id']; ?>&don=<?php echo $row['ma_don_hang']; ?>"><button class="btn btn-primary"> Giao hàng</button></a></td>
                                 <th><a href="../giaodien/in_pdf.php?ma_don_hang=<?php echo $row['ma_don_hang']; ?>"><button class="btn btn-primary"> Print</button></a></th

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
               <script>
              
                                            function giao() {
                                                return alert("Giao hàng thành công!!");
                                            }
             
             
            </script>   
                
    </body>

</html>