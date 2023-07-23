<?php
    
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $brand = $_POST['nhanhang'];
            if(strcmp($brand, "All") == 0){
                $query = "select giay.ten,giay.hinh1,giay.don_gia,giay.so_luong_ton_kho_tong from giay";
                $locresult = mysqli_query($con, $query);
                $arrayObj = array();
                $biendem=0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $arrayObj[$biendem] = (object)[];
                    $arrayObj[$biendem]->name = $row['ten'];
                    $arrayObj[$biendem]->image = $row['hinh1'];
                    $arrayObj[$biendem]->price = $row['don_gia'];
                    $arrayObj[$biendem]->soluong = $row['so_luong_ton_kho_tong'];
                    
                    $biendem+=1;
                }
                 echo json_encode($arrayObj);
            }
            else{
                $query = "select giay.ten,giay.hinh1,giay.don_gia,giay.so_luong_ton_kho_tong from giay where giay.ma_nha_cung_cap='$brand'";
                $locresult = mysqli_query($con, $query);
                $arrayObj = array();
                $biendem=0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $arrayObj[$biendem] = (object)[];
                    $arrayObj[$biendem]->name = $row['ten'];
                    $arrayObj[$biendem]->image = $row['hinh1'];
                    $arrayObj[$biendem]->price = $row['don_gia'];
                    $arrayObj[$biendem]->soluong = $row['so_luong_ton_kho_tong'];
                    $biendem+=1;
                }
                 echo json_encode($arrayObj);
            }
           
            //$query = "insert into(name,brand,size,category,price,quantity_left,image)
        //values (ajsad,adidas,49,kjdkas,1000000,5,img/".tenhang."/".tenhinh.");"
?>
