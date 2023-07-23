
<?php
   include '../connectdb/connect.php';
   $con = ketnoi();
$username=$_GET['username'];
 // echo $id." ";
    $sql0= "select user_id from user_new,account where user_new.user_key=account.username and account.username='$username'";
    $query0=mysqli_query($con,$sql0);
    $row0=mysqli_fetch_assoc($query0);
    $id=$row0['user_id'];
    $sql1 = "SELECT * FROM don_hang WHERE user_id= '" . $id . "'";
    $query1 = mysqli_query($con, $sql1);
        $row1= mysqli_fetch_assoc($query1);
         if (mysqli_num_rows($query1)!= 0) {
        $ma_dh=$row1['ma_don_hang']; 
        
        $sql3="DELETE FROM chi_tiet_don_hang WHERE ma_don_hang=$ma_dh";
        $query3= mysqli_query($con, $sql3);   
        
     $sql4="DELETE FROM don_hang WHERE user_id=$id";
    $query4= mysqli_query($con, $sql4);  
        }
   //     echo $ma_dh." ";
    
      
   
    $sql2 = "SELECT * FROM gio_hang WHERE user_id= '" . $id . "'";
   
    $query2 = mysqli_query($con, $sql2);
        $row2= mysqli_fetch_assoc($query2);        
         if (mysqli_num_rows($query2)!= 0) {
              $ma_gh=$row2['id_gio_hang']; 
              
             $sql5="DELETE FROM chi_tiet_gio_hang WHERE id_gio_hang=$ma_gh";
            $query5= mysqli_query($con, $sql5);  

            $sql6="DELETE FROM gio_hang WHERE user_id=$id";
            $query6= mysqli_query($con, $sql6);   
             
     
    
        }
 //   echo $ma_gh." ";
     
     
$sql7="DELETE FROM user_new WHERE user_key='$username'";
$query7= mysqli_query($con, $sql7);
$sql8="DELETE FROM account WHERE username='$username'";
$query8= mysqli_query($con, $sql8);

header('location:qlkh2.php');
?>

