<?php
    require '../connectdb/connect.php';

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['address'])) {
        $con = ketnoi();
        $username=mysqli_real_escape_string($con,$_POST['username']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $name= mysqli_real_escape_string($con,$_POST['name']);
        $phone= mysqli_real_escape_string($con,$_POST['phone']);
        $email= mysqli_real_escape_string($con,$_POST['email']);
        $address= mysqli_real_escape_string($con,$_POST['address']);
        $currentDate =date("Y-m-d");
        $duplicate_acc_query="select account_id from account where username='$username'";
        $duplicate_acc_result=mysqli_query($con,$duplicate_acc_query) or die(mysqli_error($con));
        $rows_fetched=mysqli_num_rows($duplicate_acc_result);
        if($rows_fetched>0){
            echo '0';
        }else{
            $acc_insert_query="insert into account(username,password,role_id,status,create_date) values ('$username','$password','0','1','$currentDate')";
            $acc_insert_result=mysqli_query($con,$acc_insert_query) or die(mysqli_error($con));
            $user_insert_query="insert into user_new(user_key,name,address,phone,email) values ('$username','$name','$address','$phone','$email')";
            $user_insert_result=mysqli_query($con,$user_insert_query) or die(mysqli_error($con));
            echo '1';
        }
    } else {
        echo 'blank';
    }

?>