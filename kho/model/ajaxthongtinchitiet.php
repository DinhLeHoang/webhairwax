<?php
    require '../../connectdb/connect.php';
    $con = ketnoi();
    $shoe = $_POST['shoe'];
    $isgetsize = (int)$_POST['checkgetsize'];
    if($isgetsize == 0){
        $query1 = "select id_giay, hinh1,hinh2,hinh3, so_luong_ton_kho_tong
                    from giay
                    where id_giay=$shoe
                    group by id_giay";
        $result1 = mysqli_query($con, $query1);
        $arrayObj = array();
                    $biendem=0;
                    while($row = mysqli_fetch_assoc($result1)){
                        $arrayObj[$biendem] = (object)[];
                        $arrayObj[$biendem]->hinh1 = $row['hinh1'];
                        $arrayObj[$biendem]->hinh2 = $row['hinh2'];
                        $arrayObj[$biendem]->hinh3 = $row['hinh3'];
                        $arrayObj[$biendem]->tongslkhotong = $row['so_luong_ton_kho_tong'];
                        $biendem+=1;
                    }
                     //echo '<h2>'.$checkbrand.' '.$checksearch.'</h2>';
                     echo json_encode($arrayObj);
    }
    else{
        $query2 = "select size
                    from giay as g join kich_co as kc
                    on g.id_giay=kc.id_giay
                    where g.id_giay=$shoe";
        $result2 = mysqli_query($con, $query2);
        $arrayObj = array();
                    while($row = mysqli_fetch_assoc($result2)){
                        array_push($arrayObj,$row['size']);
                    }
                     //echo '<h2>'.$checkbrand.' '.$checksearch.'</h2>';
                     echo json_encode($arrayObj);
    }
?>