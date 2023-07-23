<?php
    
            require '../../connectdb/connect.php';
            $con = ketnoi();
            $keyword = $_POST['search'];
            if(empty($keyword)){
                 $query = "select * from nha_cung_cap";
                $locresult = mysqli_query($con, $query);
                $arrayObj = array();
                $biendem=0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $arrayObj[$biendem] = (object)[];
                    $arrayObj[$biendem]->id = $row['ma_nha_cung_cap'];
                    $arrayObj[$biendem]->name = $row['ten_nha_cung_cap'];
                    $arrayObj[$biendem]->address = $row['dia_chi'];
                    $arrayObj[$biendem]->phone = $row['sdt'];
                    
                    $biendem+=1;
                }
                 echo json_encode($arrayObj);
            }
            else {
                $query = "select * from nha_cung_cap where ten_nha_cung_cap like '%$keyword%' or ten_nha_cung_cap like '$keyword%' or ten_nha_cung_cap like '%$keyword'";
                $locresult = mysqli_query($con, $query);
                $arrayObj = array();
                $biendem=0;
                while($row = mysqli_fetch_assoc($locresult)){
                    $arrayObj[$biendem] = (object)[];
                    $arrayObj[$biendem]->id = $row['ma_nha_cung_cap'];
                    $arrayObj[$biendem]->name = $row['ten_nha_cung_cap'];
                    $arrayObj[$biendem]->address = $row['dia_chi'];
                    $arrayObj[$biendem]->phone = $row['sdt'];
                    
                    $biendem+=1;
                }
                 echo json_encode($arrayObj);
 }
 ?>
 
