<?php
   
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $tensp = $_POST['ten'];
            $size = $_POST['size'];
            $query= null;
            $sl=0;
            $query = "select kc.so_luong_ton_kho_tong
from giay as g join nha_cung_cap as ncc 
on g.ma_nha_cung_cap=ncc.ma_nha_cung_cap
join kich_co as kc
on g.id_giay = kc.id_giay
where g.ten='$tensp' AND kc.size=$size";
                $locresult = mysqli_query($con, $query);
                 while($row = mysqli_fetch_assoc($locresult)){
                     $sl=$row['so_luong_ton_kho_tong'];
                     }
                     echo json_encode($sl);
                     ?>