<?php
    
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $status = $_POST['loai'];
            if(strcmp($status, "nhapkho") == 0){
                $query = "select * from nhap_kho";
                $locresult = mysqli_query($con, $query);
                $arrayObj = array();
                $biendem=0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $arrayObj[$biendem] = (object)[];
                    $arrayObj[$biendem]->id1 = $row['ma_nhap_kho'];
                    $arrayObj[$biendem]->id2 = $row['ma_nha_cung_cap'];
                    $arrayObj[$biendem]->date = $row['ngay_gio_nhap_kho'];
                    $arrayObj[$biendem]->quality = $row['so_luong_hang_nhap'];
                    $arrayObj[$biendem]->price = $row['tong_tien_nhap_kho'];
                    
                    $biendem+=1;
                }
                 echo json_encode($arrayObj);
            }
            else{
                $query = "select * from xuat_kho";
                $locresult = mysqli_query($con, $query);
                $arrayObj = array();
                $biendem=0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $arrayObj[$biendem] = (object)[];
                    $arrayObj[$biendem]->id = $row['ma_xuat_kho'];
                    $arrayObj[$biendem]->quality = $row['so_luong_xuat_kho'];
                    $arrayObj[$biendem]->date = $row['ngay_gio_xuat_kho'];
                    $biendem+=1;
                }
                 echo json_encode($arrayObj);
            }
           
            //$query = "insert into(name,brand,size,category,price,quantity_left,image)
        //values (ajsad,adidas,49,kjdkas,1000000,5,img/".tenhang."/".tenhinh.");"
?>
