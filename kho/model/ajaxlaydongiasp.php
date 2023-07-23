<?php
    
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $tensp = $_POST['ten'];
                $query = "select g.don_gia, kc.size
from giay as g join nha_cung_cap as ncc 
on g.ma_nha_cung_cap=ncc.ma_nha_cung_cap
join kich_co as kc
on g.id_giay = kc.id_giay
where g.ten='$tensp'";
                $locresult = mysqli_query($con, $query);
                $gia="";
                $sizearray = array();
                $biendem=0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $gia=$row['don_gia'];
                    $sizearray[$biendem] = $row['size'];
                    $biendem+=1;
                }
                $arrresult = array($gia,$sizearray);
                 echo json_encode($arrresult);
?>