<?php
    require '../connectdb/connect.php';
    require '../model/cart_model1.php';
    session_start();
    $con = ketnoi();
    $user_id=$_SESSION['username'];
    $model = new cart_model1();
    $num = $model->getnumrowcart($user_id);
    $arridsanpham = $model->getallidsanphambyuser($user_id);
    $arrsizesanpham = $model->getallsizesanphambyuser($user_id);
    $idgio=$model->getIDgiohangbyUsername($user_id);
    // print_r($arridsanpham);
    //var_dump($arridsanpham); echo '<br>';
    //var_dump($arrsizesanpham);echo '<br>';
    //$arrtemp = array();
    //$dem=0;
    //while($num != 0){
        //$dem2=$dem+1;
        //$arrtemp[$dem] = $_POST['qty-'.$dem2];
        //$dem+=1;
        //$num--;
    //}
    //var_dump($arrtemp);
    $dem = 1;
    while($num !=0){
       
        $qty = $_POST['qty-'.$dem];
        $query = "update chi_tiet_gio_hang set so_luong=? where id_sanpham=? and size=?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "iii", $qty,$arridsanpham[$dem-1],$arrsizesanpham[$dem-1]);
        mysqli_stmt_execute($stmt);
        $num--;
        $dem+=1;
        /*$temp = $arrid;
        echo "<h2>$temp</h2>";
        $num--;*/
    }
    header('location:../giaodien/cart.php');
    
    /**/
?>

