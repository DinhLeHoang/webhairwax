<?php
    
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $tabledata = $_POST['tabledata'];
             $tongslxuat = 0;
             $checkinsert = 0;
              for($i = 0;$i< count($tabledata); $i++){
                $tongsltam = (int)$tabledata[$i]["3"];
                $tongslxuat+=$tongsltam;
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngayxuatkho = date("Y-m-d H:i:s");
            $insertxuatkho = "insert into xuat_kho(so_luong_xuat_kho,ngay_gio_xuat_kho) "
                    . "values($tongslxuat,'$ngayxuatkho')";
            mysqli_query($con, $insertxuatkho);
            if(mysqli_affected_rows($con) != 0){
                $getmaxuatkho = "select ma_xuat_kho from xuat_kho where ngay_gio_xuat_kho='$ngayxuatkho'";
                $maxuatkhoresult = mysqli_query($con, $getmaxuatkho);
                $maxuatkho = 0;
                while($row = mysqli_fetch_assoc($maxuatkhoresult)){
                        $maxuatkho = (int)$row['ma_xuat_kho'];
                        break;
                }
                for($i = 0;$i< count($tabledata); $i++){
                    $idsp = $tabledata[$i]["0"];
                    $sizesp = $tabledata[$i]["2"];
                    $slxuat = $tabledata[$i]["3"];
                    $insertchitiet = "insert into chi_tiet_xuat_kho(ma_xuat_kho,id_giay,size,so_luong_cua_size) "
                    . "values($maxuatkho,$idsp,$sizesp,$slxuat)";
                    mysqli_query($con, $insertchitiet);
                    $querygiamsl = "select so_luong_ton_kho_tong from giay where id_giay='$idsp'";
                    $giamslresult = mysqli_query($con, $querygiamsl);
                    $sl = 0;
                        while($row = mysqli_fetch_assoc($giamslresult)){
                        $sl = (int)$row['so_luong_ton_kho_tong'];
                        break;
                        }
            
                    $updatesl="UPDATE giay SET so_luong_ton_kho_tong=$sl-$slxuat WHERE id_giay ='$idsp' ;";
                    mysqli_query($con, $updatesl);
                    $querygiamsl1 = "select so_luong_ton_kho_tong from kich_co where id_giay='$idsp' AND size='$sizesp'";
                    $giamslresult1 = mysqli_query($con, $querygiamsl1);
                    $sl1 = 0;
                        while($row = mysqli_fetch_assoc($giamslresult1)){
                        $sl1 = (int)$row['so_luong_ton_kho_tong'];
                        break;
                        }
            
                    $updatesl1="UPDATE kich_co SET so_luong_ton_kho_tong=$sl1-$slxuat WHERE id_giay ='$idsp' AND size='$sizesp';";
                    mysqli_query($con, $updatesl1);
                }
                if(mysqli_affected_rows($con) != 0){
                    $checkinsert = 1;
                }
            }
            echo json_encode($checkinsert);
?>
