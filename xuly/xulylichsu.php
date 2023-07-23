<?php 
    require '../connectdb/connect.php';
    require '../model/paginator.php';
    $con = ketnoi();
    $user_id=$_SESSION['id'];
    $sql="select user_id from user_new,account where user_new.user_key=account.username and account.account_id=$user_id";
    $result= mysqli_query($con, $sql);
    $row0=mysqli_fetch_assoc($result);
    $userid=$row0["user_id"];
    $limit = ( isset($_GET['limit']) ) ? $_GET['limit'] : 5;
    $page = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
    $links = ( isset($_GET['links']) ) ? $_GET['links'] : 7;
    $user_products_query = "select don.ma_don_hang,g.ten, ct.size, ct.so_luong, ct.don_gia, don.ngay_gio_thanh_toan, don.tinh_trang
                    from don_hang as don
                    join gio_hang as gio
                    on don.user_id = gio.user_id
                    join chi_tiet_don_hang as ct
                    on don.ma_don_hang = ct.ma_don_hang
                    join sanpham as g
                    on ct.id_sanpham = g.id_sanpham
                    join (select ma_don_hang, MONTH(CAST(ngay_gio_thanh_toan as date)) as datethanhtoan
                    from don_hang
                    WHERE tinh_trang!='Processing') as don1
                    on don.ma_don_hang = don1.ma_don_hang
                    where don.user_id=$userid and tinh_trang!='Processing'";
    if(!isset($_SESSION['username'])){
        header('location: login.php');
    }
    if(!isset($_POST['submit'])){
        $Paginator = new Paginator($user_products_query);
        $user_products_result = $Paginator->getData($limit, $page);
        if($Paginator->_total != 0){
        $statusquery = "select tinh_trang from don_hang where user_id=$userid and (tinh_trang='Paid' or tinh_trang='Shipped') GROUP BY tinh_trang";
        $statusres = mysqli_query($con,$statusquery);
        ?>

        <div class="form-group col-md-9">
            <div class="form-group col-md-4">
                <label style="font-weight: bold;" for="slboxsort">Tình trạng đơn hàng: </label>
                <select id="slboxsort" class="form-control" name="statusselected">
                    <option selected="true">All</option>
                <?php
                if(mysqli_num_rows($statusres) != 0){

                ?>

                        <?php while($statusrow = mysqli_fetch_assoc($statusres))
                        {
                            ?>
                            <option><?php echo $statusrow['tinh_trang'];?></option>
                        <?php 
                        }
                   ?>
                <?php 
                 }
                ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label style="font-weight: bold;" for="sortthang">Tháng: </label>
                <select id="sortthang" class="form-control" name="monthselected">
                                <option value="--" selected>--</option>
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
            </div>
            <div class="form-group col-md-2" style="display: flex; align-items:center; justify-content: center; padding-top: 3%;">
                <button id="loclichsu" class="btn-primary" style="width:100%; height:35px; font-size: 13px;" name="submit">Lọc</button>
            </div>
        </div>

               <table id="tablelichsu" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                        <th>Bill_id</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Date of payment</th>
                                        <th>Status</th>
                               </tr>    
                            </thead>
                            <tbody>

                               <?php 
                                    //while($row=mysqli_fetch_assoc($user_products_result)){
                                    for ($i = 0; $i < count($user_products_result->data); $i++) :
                                 ?>
                                <tr>
                                    <td><?php echo $user_products_result->data[$i]['ma_don_hang']?></td>
                                    <td><?php echo $user_products_result->data[$i]['ten']?></td>
                                    <td><?php echo $user_products_result->data[$i]['size']?></td>
                                    <td><?php echo $user_products_result->data[$i]['so_luong']?></td>
                                    <td><?php echo $user_products_result->data[$i]['ngay_gio_thanh_toan']?></td>
                                    <td style="color:#92f200;"><?php echo $user_products_result->data[$i]['tinh_trang']?></td>
                                    <!--<th><a href="../giaodien/in_pdf.php?ma_don_hang=<?php //echo $row['ma_don_hang']; ?>">Print</a></th>-->


                                </tr>
                               <?php endfor;
                                //}
                               ?>
                            </tbody>
               </table>
            <div style="display: flex; justify-content: center">
            <?php

                    echo $Paginator->createLinks( $links, 'pagination' );
                    ?>
            </div>
            <?php 
        }
        else{
                               ?>
                            <h3>There is no history at here!Go to <a href="../giaodien/products.php">shopping</a></h3>
                                <?php 

        }
    }
    else{
        
        $statusselected = $_POST['statusselected'];
        $monthselected = $_POST['monthselected'];
        if(strcmp($statusselected, "All") == 0){
            if(strcmp($monthselected,"--") != 0){
              $user_products_query=$user_products_query." and datethanhtoan=$monthselected";
            }
        }
        else{
            if(strcmp($monthselected,"--") != 0){
                $user_products_query ="select don.ma_don_hang,g.ten, ct.size, ct.so_luong, ct.don_gia, don.ngay_gio_thanh_toan, don.tinh_trang
                from don_hang as don
                join gio_hang as gio
                on don.user_id = gio.user_id
                join chi_tiet_don_hang as ct
                on don.ma_don_hang = ct.ma_don_hang
                join sanpham as g
                on ct.id_sanpham = g.id_sanpham
                join (select ma_don_hang, MONTH(CAST(ngay_gio_thanh_toan as date)) as datethanhtoan
                from don_hang
                WHERE tinh_trang!='Processing') as don1
                on don.ma_don_hang = don1.ma_don_hang
                where don.user_id=$userid and tinh_trang='$statusselected' and datethanhtoan=$monthselected";
            }
            else{
                $user_products_query ="select don.ma_don_hang,g.ten, ct.size, ct.so_luong, ct.don_gia, don.ngay_gio_thanh_toan, don.tinh_trang
                from don_hang as don
                join gio_hang as gio
                on don.user_id = gio.user_id
                join chi_tiet_don_hang as ct
                on don.ma_don_hang = ct.ma_don_hang
                join sanpham as g
                on ct.id_sanpham = g.id_sanpham
                join (select ma_don_hang, MONTH(CAST(ngay_gio_thanh_toan as date)) as datethanhtoan
                from don_hang
                WHERE tinh_trang!='Processing') as don1
                on don.ma_don_hang = don1.ma_don_hang
                where don.user_id=$userid and tinh_trang='$statusselected'";
            }
        }
        $Paginator = new Paginator($user_products_query);
        $user_products_result = $Paginator->getData($limit, $page);
        $statusquery = "select tinh_trang from don_hang where user_id=$userid and (tinh_trang='Paid' or tinh_trang='Shipped') GROUP BY tinh_trang";
        $statusres = mysqli_query($con,$statusquery);
        if($Paginator->_total != 0){
        
        
        ?>

    <div class="form-group col-md-9">
        <div class="form-group col-md-4">
            <label style="font-weight: bold;" for="slboxsort">Tình trạng đơn hàng: </label>
            <select id="slboxsort" class="form-control" name="statusselected">
                <option selected="true">All</option>
            <?php
            if(mysqli_num_rows($statusres) != 0){

            ?>

                    <?php while($statusrow = mysqli_fetch_assoc($statusres))
                    {
                        ?>
                        <option><?php echo $statusrow['tinh_trang'];?></option>
                    <?php 
                    }
               ?>
            <?php 
             }
            ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label style="font-weight: bold;" for="sortthang">Tháng: </label>
            <select id="sortthang" class="form-control" name="monthselected">
                            <option value="--" selected>--</option>
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
        </div>
        <div class="form-group col-md-2" style="display: flex; align-items:center; justify-content: center; padding-top: 3%;">
            <button id="loclichsu" class="btn-primary" style="width:100%; height:35px; font-size: 13px;" name="submit">Lọc</button>
        </div>
    </div>

               <table id="tablelichsu" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                        <th>Bill_id</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Date of payment</th>
                                        <th>Status</th>
                               </tr>    
                            </thead>
                            <tbody>

                               <?php 
                                    //while($row=mysqli_fetch_assoc($user_products_result)){
                                    for ($i = 0; $i < count($user_products_result->data); $i++) :
                                 ?>
                                <tr>
                                    <td><?php echo $user_products_result->data[$i]['ma_don_hang']?></td>
                                    <td><?php echo $user_products_result->data[$i]['ten']?></td>
                                    <td><?php echo $user_products_result->data[$i]['size']?></td>
                                    <td><?php echo $user_products_result->data[$i]['so_luong']?></td>
                                    <td><?php echo $user_products_result->data[$i]['ngay_gio_thanh_toan']?></td>
                                    <td style="color:#92f200;"><?php echo $user_products_result->data[$i]['tinh_trang']?></td>
                                    <!--<th><a href="../giaodien/in_pdf.php?ma_don_hang=<?php //echo $row['ma_don_hang']; ?>">Print</a></th>-->


                                </tr>
                               <?php endfor;
                                //}
                               ?>
                            </tbody>
               </table>
            <div style="display: flex; justify-content: center">
            <?php

                    echo $Paginator->createLinks( $links, 'pagination' );
                    ?>
            </div>
            <?php 
            }
        else{
            ?>
              <div class="form-group col-md-9">
                    <div class="form-group col-md-4">
                        <label style="font-weight: bold;" for="slboxsort">Tình trạng đơn hàng: </label>
                        <select id="slboxsort" class="form-control" name="statusselected">
                            <option selected="true">All</option>
                        <?php
                        if(mysqli_num_rows($statusres) != 0){

                        ?>

                                <?php while($statusrow = mysqli_fetch_assoc($statusres))
                                {
                                    ?>
                                    <option><?php echo $statusrow['tinh_trang'];?></option>
                                <?php 
                                }
                           ?>
                        <?php 
                         }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label style="font-weight: bold;" for="sortthang">Tháng: </label>
                        <select id="sortthang" class="form-control" name="monthselected">
                                        <option value="--" selected>--</option>
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
                    </div>
                    <div class="form-group col-md-2" style="display: flex; align-items:center; justify-content: center; padding-top: 3%;">
                        <button id="loclichsu" class="btn-primary" style="width:100%; height:35px; font-size: 13px;" name="submit">Lọc</button>
                    </div>
              </div><br>
                            <?php
                               ?>
                            <div style="float: left;"><h3>There are no result within your filter!</h3></div>
                                <?php 

        }
    }
?>
     


