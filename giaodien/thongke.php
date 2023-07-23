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
        <link rel="stylesheet" href="/font-awesome/css/all.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    </head>

    <body style="background-color: #F0F0F0;" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
        <form method="post" action="">
        <?php include '../connectdb/connect.php';
        require_once '../model/paginator.php';
        require '../giaodien/admin_menu.php';
        require '../model/bill_model.php';
        ?>
        <div class="main">
            
            <div class="container">
                <h2>Danh sách các hoá đơn đã thanh toán</h2>
                <select id="locthang" name="monthselected">
                    <option value="1">Tháng 1</option>
                    <option value="2">Tháng 2</option>
                    <option value="3">Tháng 3</option>
                    <option value="4">Tháng 4</option>
                    <option value="5">Tháng 5</option>
                    <option value="6">Tháng 6</option>
                    <option value="7">Tháng 7</option>
                    <option value="8">Tháng 8</option>
                    <option value="9">Tháng 9</option>
                    <option value="10">Tháng 10</option>
                    <option value="11">Tháng 11</option>
                    <option value="12">Tháng 12</option>
                </select>
                <input class="btn-primary" type="submit" name="submit" value="Lọc"><br><br>
                <?php
                if(isset($_POST['submit'])){
                    $month = $_POST['monthselected'];
                    $limit = ( isset($_GET['limit']) ) ? $_GET['limit'] : 5;
                    $page = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
                    $links = ( isset($_GET['links']) ) ? $_GET['links'] : 7;
                    $query = "select d1.user_id, d1.ma_don_hang, d1.ngay_gio_thanh_toan, d1.tong_tien
                            from don_hang as d1 join 
                            (select ma_don_hang, MONTH(CAST(ngay_gio_thanh_toan as date)) as datethanhtoan
                            from don_hang
                            WHERE tinh_trang!='Processing') as d2
                            on d1.ma_don_hang=d2.ma_don_hang
                            where datethanhtoan=$month";
                    $Paginator = new Paginator($query);

                    $results = $Paginator->getData($limit, $page);
                ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                           <th>User_id</th>
                            <th>Bill_id</th>
                            <th>Date</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($results->data); $i++) : ?>
                            <tr>
                                <td><?php echo $results->data[$i]['user_id']; ?></td>
                                <td><?php echo $results->data[$i]['ma_don_hang']; ?></td>
                                <td><?php echo $results->data[$i]['ngay_gio_thanh_toan']; ?></td>
                                <td><?php echo $results->data[$i]['tong_tien']; ?></td>
                            </tr>
                        <?php endfor; ?>   
                    </tbody>
                </table>
                <?php echo $Paginator->createLinks( $links, 'pagination' ); ?>
                <?php }
                else{
                    $limit = ( isset($_GET['limit']) ) ? $_GET['limit'] : 5;
                    $page = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
                    $links = ( isset($_GET['links']) ) ? $_GET['links'] : 7;
                    $query = "select * from don_hang where tinh_trang!='Processing'";
                    $Paginator = new Paginator($query);
                    $results = $Paginator->getData($limit, $page);
                ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                           <th>User_id</th>
                            <th>Bill_id</th>
                            <th>Date</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($results->data); $i++) : ?>
                            <tr>
                                <td><?php echo $results->data[$i]['user_id']; ?></td>
                                <td><?php echo $results->data[$i]['ma_don_hang']; ?></td>
                                <td><?php echo $results->data[$i]['ngay_gio_thanh_toan']; ?></td>
                                <td><?php echo $results->data[$i]['tong_tien']; ?></td>
                            </tr>
                        <?php endfor; ?>   
                    </tbody>
                </table>
                <?php echo $Paginator->createLinks( $links, 'pagination' ); ?>
                <?php }?>
            </div>
            <div class="aa">
                <?php
                        $con = ketnoi();
                        $ordermodel = new bill_model();
                        $totalpaidres = $ordermodel->totalpaidorder();
                        $paidorderres = $ordermodel->numofpaidorder();
                        $shippedorderres = $ordermodel->numofshippedorder();
                        $rowtotalpaid = mysqli_fetch_assoc($totalpaidres);
                        $rowpaidorder = mysqli_fetch_assoc($paidorderres);
                        $rowshippedorder = mysqli_fetch_assoc($shippedorderres);
                        ?>
                <h4 class="a0">Tổng số đơn hàng đã được thanh toán: <?php echo $rowtotalpaid['tongdonhang'];?></h4>
                <h4 class="a0">Số đơn hàng chưa xử lý: <?php echo $rowpaidorder['chuaxuly'];?></h4>
                <h4 class="a0">Số đơn hàng đã xử lý: <?php echo $rowshippedorder['daxuly'];?></h4>
            </div>
            <h4 class="total">
                <?php 
                    $result = $ordermodel->gettotalprice();
                    while ($row = mysqli_fetch_assoc($result)) {
                       echo "Tổng doanh thu:".$row['tong']." VNĐ";
                    }
                ?>
            </h4>

        </div>
        </form>
            <footer class="footer">
               <div class="container">
                <center>
                   <p style="padding-top: 20px;">Copyright &copy Store. All Rights Reserved.</p>
                   <br><br><br>
                   <!--<p>This website is developed by Yugesh Verma</p>-->
               </center>
               </div>
           </footer>


    </body>
    
</html>