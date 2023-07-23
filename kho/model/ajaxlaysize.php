<?php
   
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $tensp = $_POST['ten'];
            $size = $_POST['size'];
            $query= null;
            $sl=0;
            $sizearray = array();
            $query= "select kc.size
                    from giay as g join nha_cung_cap as ncc 
                    on g.ma_nha_cung_cap=ncc.ma_nha_cung_cap
                    join kich_co as kc
                    on g.id_giay = kc.id_giay
                    where g.ten='$tensp'";
                        
                        $biendem = 0;
                        $locresult1 = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($locresult1)) {
                            $sizearray[$biendem] = $row['size'];
                            $biendem += 1;
                        }
            
            /*else {
                
                $query = "select kc.so_luong_ton_kho_tong
from giay as g join nha_cung_cap as ncc 
on g.ma_nha_cung_cap=ncc.ma_nha_cung_cap
join kich_co as kc
on g.id_giay = kc.id_giay
where g.ten='$tensp' AND kc.size=$size";
                $locresult2 = mysqli_query($con, $sql);
                 while($row = mysqli_fetch_assoc($locresult2)){
                     $sl=$row['so_luong_ton_kho_tong'];
                     }
            }*/

             
                 echo json_encode($sizearray);
?>