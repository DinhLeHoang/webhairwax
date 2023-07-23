<?php
            require '../connectdb/connect.php';
            function getspdaco(){
                $con = ketnoi();
                $user = $_POST['user'];
                $sp = (int)$_POST['sp'];
                $quantity = (int)$_POST['quantity'];
                $size = $_POST['size'];
                $query0 = "select user_id from user_new,account where user_new.user_key=account.username and account.username='$user'";
                $result0 = mysqli_query($con, $query0);
                $row0=mysqli_fetch_assoc($result0);
                $userid=$row0['user_id'];
                $query2 = "select * from gio_hang, chi_tiet_gio_hang where gio_hang.user_id=$userid
                 and chi_tiet_gio_hang.id_gio_hang=gio_hang.id_gio_hang and chi_tiet_gio_hang.id_sanpham=$sp
                 and chi_tiet_gio_hang.size='$size'";
                            
                $result = mysqli_query($con, $query2);
                $num_row = mysqli_num_rows($result);
                
                if($num_row!= 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $qty = (int)$row["so_luong"];
                        return $qty;
                        break;
                    }
                } else return 0;
            }
            function getIDgiohangbyUsername($userid){
                $con = ketnoi();
                $query = "select id_gio_hang from gio_hang,account,user_new where gio_hang.user_id=user_new.user_id and user_new.user_key=account.username and account.username='$userid'";
                $result = mysqli_query($con, $query);
                $num_row = mysqli_num_rows($result);
                if($num_row!= 0){
                    while($row = mysqli_fetch_assoc($result)){
                       $idgiohang = $row["id_gio_hang"];
                       return $idgiohang;
                    }
                }
                return 0;
            }
            function updatecart(){
                $con = ketnoi();
                $user = $_POST['user'];
                $idgiohang = getIDgiohangbyUsername($user);
                    $sp = (int)$_POST['sp'];
                    $quantity = (int)$_POST['quantity'];
                    $size = $_POST['size'];
                    $newqty = getspdaco()+$quantity;
                    
                $query1 = "update chi_tiet_gio_hang set so_luong=? where id_gio_hang=? and id_sanpham=? and size=?";
                $stmt = mysqli_prepare($con, $query1);
                mysqli_stmt_bind_param($stmt,"iiii", $newqty,$idgiohang,$sp,$size);
                mysqli_stmt_execute($stmt);
            }
            function getslbyspandsize(){
                $con = ketnoi();
                $sp = (int)$_POST['sp'];
                $size = $_POST['size'];
                $query = "select so_luong_ton_kho_ban from kich_co where id_sanpham=$sp and size='$size'";
                $result = mysqli_query($con, $query);
                $sl = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $sl = (int)$row['so_luong_ton_kho_ban'];
                    return $sl;
                }
                return 0;
            }
            $quantity = (int)$_POST['quantity'];
            $slspdangco = getslbyspandsize();
            $vuotquasl = 0;
            if($quantity <= $slspdangco){
                $newqty = 0;
                if(getspdaco() != 0){
                    $newqty = getspdaco()+$quantity;
                    if($newqty <= $slspdangco){
                        updatecart();
                    }
                    else{
                        $vuotquasl = 1;
                    }
                }
                else if(getspdaco()==0){
                    $con = ketnoi();
                    $user = $_POST['user'];
                    // $idgiohang = getIDgiohangbyUsername($user);
                    $sp = (int)$_POST['sp'];
                    // $quantity = (int)$_POST['quantity'];
                    $size = $_POST['size'];
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $date = date("Y-m-d H:i:s");
                    $query0 = "select user_id from user_new,account where user_new.user_key=account.username and account.username='$user'";
                    $result0 = mysqli_query($con, $query0);
                    $row0=mysqli_fetch_assoc($result0);
                    $userid=$row0["user_id"];
                    $query1 = "insert into gio_hang(id_gio_hang,user_id) values('',$userid)";
                    mysqli_query($con, $query1);
                    $query2 = "select id_gio_hang from gio_hang order by id_gio_hang desc limit 0,1";
                    $result1 = mysqli_query($con,$query2);
                    $row1=mysqli_fetch_assoc($result1);
                    $idgiohang=$row1['id_gio_hang'];
                    $query = "insert into chi_tiet_gio_hang(id_gio_hang,id_sanpham,size,so_luong,ngay_gio_them_vao_gio) values($idgiohang,$sp,'$size',$quantity,'$date')";
                    mysqli_query($con, $query);
                    /*$stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "iiiis", $user,$sp,$quantity,$date);
                    mysqli_stmt_execute($stmt);*/
            }}
            else{
                $vuotquasl = 1;
            }
            if($vuotquasl == 0) {
                echo json_encode(1);
                // echo '1';
            }
            else {
                echo json_encode(0);
            } 
           //$query = "insert into(name,brand,size,category,price,quantity_left,image)
        //values (ajsad,adidas,49,kjdkas,1000000,5,img/".tenhang."/".tenhinh.");"
?>
