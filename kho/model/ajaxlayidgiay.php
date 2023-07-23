<?php
    
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $ten = $_POST['ten'];
                $query = "select id_giay
from giay 
where ten='$ten'";
                $locresult = mysqli_query($con, $query);
                $idtrave = 0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $idtrave = (int)$row['id_giay'];
                    break;
                }
                 echo json_encode($idtrave);
?>
