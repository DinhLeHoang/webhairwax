<?php
    require 'connection.php';
    session_start();
    $username=mysqli_real_escape_string($con,$_POST['username']);
    // $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    // if(!preg_match($regex_email,$email)){
    //     echo "Incorrect email. Redirecting you back to login page...";
    //     ?>
    //     <meta http-equiv="refresh" content="2;url=login.php" />
    //     <?php
    // }
    $password=md5(md5(mysqli_real_escape_string($con,$_POST['password'])));
    if(strlen($password)<6){
        echo "Password should have atleast 6 characters. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }
    $user_authentication_query="select account_id,username from users_new where username='$email' and password='$password'";
    $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($user_authentication_result);
    if($rows_fetched==0){
        //no user
        //redirecting to same login page
        ?>
        <script>
            window.alert("Wrong username or password");
        </script>
        <meta http-equiv="refresh" content="1;url=login.php" />
        <?php
        //header('location: login');
        //echo "Wrong email or password.";
    }else{
        $row=mysqli_fetch_array($user_authentication_result);
        $_SESSION['username']=$username;
        $_SESSION['account_id']=$row['account_id'];  //user id
        header('location: products.php');
    }
    
 ?>