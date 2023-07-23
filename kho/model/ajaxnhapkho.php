<?php
    
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $tabledata = $_POST['tabledata'];
            
            $tenncc = $_POST['ncc'];
            $tongslnhap = 0;
            $tongtiennhap = 0;
            $checkinsert = 0;
            for($i = 0;$i< count($tabledata); $i++){
                $tongsltam = (int)$tabledata[$i]["3"];
                $tongtientam = (int)$tabledata[$i]["5"];
                $tongslnhap+=$tongsltam;
                $tongtiennhap+=$tongtientam;
            }
            $queryncc = "select ma_nha_cung_cap from nha_cung_cap where ten_nha_cung_cap='$tenncc'";
            $nccresult = mysqli_query($con, $queryncc);
            $mancc = 0;
            while($row = mysqli_fetch_assoc($nccresult)){
                    $mancc = (int)$row['ma_nha_cung_cap'];
                    break;
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngaynhapkho = date("Y-m-d H:i:s");
            $insertnhapkho = "insert into nhap_kho(ma_nha_cung_cap,ngay_gio_nhap_kho,so_luong_hang_nhap,tong_tien_nhap_kho) "
                    . "values($mancc,'$ngaynhapkho',$tongslnhap,$tongtiennhap)";
            mysqli_query($con, $insertnhapkho);
            if(mysqli_affected_rows($con) != 0){
                $getmanhapkho = "select ma_nhap_kho from nhap_kho where ngay_gio_nhap_kho='$ngaynhapkho'";
                $manhapkhoresult = mysqli_query($con, $getmanhapkho);
                $manhapkho = 0;
                while($row = mysqli_fetch_assoc($manhapkhoresult)){
                        $manhapkho = (int)$row['ma_nhap_kho'];
                        break;
                }
                for($i = 0;$i< count($tabledata); $i++){
                    $idsp = $tabledata[$i]["0"];
                    $sizesp = $tabledata[$i]["2"];
                    $slnhapthem = $tabledata[$i]["3"];
                    $dongiasp = $tabledata[$i]["4"];
                    $insertchitiet = "insert into chi_tiet_nhap_kho(ma_nhap_kho,id_giay,size,so_luong_cua_size,don_gia) "
                    . "values($manhapkho,$idsp,$sizesp,$slnhapthem,$dongiasp)";
                    mysqli_query($con, $insertchitiet);
                    $querytangsl = "select so_luong_ton_kho_tong from giay where id_giay='$idsp'";
                    $tangslresult = mysqli_query($con, $querytangsl);
                    $sl = 0;
                        while($row = mysqli_fetch_assoc($tangslresult)){
                        $sl = (int)$row['so_luong_ton_kho_tong'];
                        break;
                        }
            
                    $updatesl="UPDATE giay SET so_luong_ton_kho_tong=$sl+$slnhapthem WHERE id_giay ='$idsp' ;";
                    mysqli_query($con, $updatesl);
                    $getslkhotong = "select so_luong_ton_kho_tong from kich_co where id_giay=$idsp and size=$sizesp";
                    $getslresult = mysqli_query($con, $getslkhotong);
                    $slkhotong = 0;
                        while($row = mysqli_fetch_assoc($getslresult)){
                        $slkhotong = (int)$row['so_luong_ton_kho_tong'];
                        break;
                        }
                    $updateslkichco="update kich_co set so_luong_ton_kho_tong=$slkhotong+$slnhapthem where id_giay=$idsp and size=$sizesp";
                    mysqli_query($con, $updateslkichco);
                }
                if(mysqli_affected_rows($con) != 0){
                    $checkinsert = 1;
                }
            }
            echo json_encode($checkinsert);
            //echo json_encode($mancc.' '.$ngaynhapkho.' '.$tongslnhap.' '.$tongtiennhap);
?>
