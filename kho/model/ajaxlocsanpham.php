<?php
    
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $brand = $_POST['nhanhang'];
                $query = "select g.ten 
from giay as g join nha_cung_cap as ncc 
on g.ma_nha_cung_cap=ncc.ma_nha_cung_cap
where ncc.ten_nha_cung_cap='$brand'";
                $locresult = mysqli_query($con, $query);
                $arrayObj = array();
                $biendem=0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $arrayObj[$biendem] = (object)[];
                    $arrayObj[$biendem]->name = $row['ten'];
                    $biendem+=1;
                }
                 echo json_encode($arrayObj);
?>
