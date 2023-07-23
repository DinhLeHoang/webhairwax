<?php
    session_start();
    require '../connectdb/connect.php';
    require '../model/cart_model1.php';
    require '../model/bill_model.php';
    require '../model/detailbill_model.php';
    require '../model/tanggiamslsp.php';
    if(!isset($_SESSION['username'])){
        header('location:index.php');
    }else{
        $con = ketnoi();
        $user_id = $_SESSION['id'];
        $total = $_SESSION['total'];
        $sql="select user_id from user_new,account where user_new.user_key=account.username and account.account_id=$user_id";
        $result= mysqli_query($con, $sql);
        $row0=mysqli_fetch_assoc($result);
        $userid=$row0["user_id"];
        $bill = new bill_model();
        $result1 = $bill->insertbill($userid, $total);
        $detailbill = new detailbill_model();
        $result2 = $detailbill->insertdetailbill($userid);
        $result3 = $bill->getlatestbillbyUserID($userid);
        $row = mysqli_fetch_assoc($result3);
        $madonhang = $row['latestbill'];
        $tanggiammodel = new tanggiamsl();
        $result4 = $tanggiammodel->giam($madonhang,$userid);
        //var_dump($result4);
        if($result1 == 1 && $result2 == 1 && $result4 == 1){
            
    
?>
                
                     <script>alert("Đơn hàng của bạn đã được tạo!");
                      window.location='../giaodien/dsdonhang.php';
                     </script> 
                       
    <?php 
            $model = new cart_model1();
            $model->emptycart($userid);
        }
        else{
          
    ?>
                      <script>alert("Đã xảy ra sự cố! Đơn hàng không thể tạo");
                      window.location='../giaodien/cart.php';
                      </script> 
    <?php }
    
        } ?>

