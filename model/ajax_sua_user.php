<?php
 include '../model/encrypt.php';
require '../connectdb/connect.php';
$model = new encrypt();
            $con = ketnoi();
            $user_id = $_POST['id'];
            $query = "select * from user where user_id=$user_id";
           $result = mysqli_query($con, $query);
        $arrayObj = array();
                    $biendem=0;
                    while($row = mysqli_fetch_assoc($result)){
                       
           $tiento = explode("@",$row['email']);
           $decryptemail = $model->apphin_giaima($tiento[0])."@".$tiento[1];
            $decryptsdt = $model->apphin_giaima($row['sdt']);      
        
                        $arrayObj[$biendem] = (object)[];
                        $arrayObj[$biendem]->user_id = $row['user_id'];
                        $arrayObj[$biendem]->email = $decryptemail;
                        $arrayObj[$biendem]->sdt = $decryptsdt;
                        $arrayObj[$biendem]->role = $row['role'];
                        $biendem+=1;
                    }
                     echo json_encode($arrayObj);     
?>

