<?php 
                                        if (isset($_POST['submit'])) {
                                           
                                            $check = 0;
                                            $password = mysqli_real_escape_string($con,$_POST['password']);                                    
                                            $username =  mysqli_real_escape_string($con, $_POST['username']);
                                            if($check == 0){                                 
                                                $user_authentication_query = "select account_id,role_id,status from account where username='$username' and password='$password'";
                                                $user_authentication_result = mysqli_query($con, $user_authentication_query) or die(mysqli_error($con));
                                                $rows_fetched = mysqli_num_rows($user_authentication_result);
                                                if($rows_fetched==0){
                                                    echo "<p class=\"error\">Sai tài khoản hoặc mật khẩu</p><br>";
                                                }
                                                else{
                                                    $row= mysqli_fetch_assoc($user_authentication_result);
                                                    if ($row['status']==0) {
                                                        echo "<p class=\"error\">Tài khoản bị khóa</p><br>";
                                                    } else {
                                                        if($row['role_id'] == '0'){
                                                            $_SESSION['username'] = $username;
                                                            $_SESSION['id'] = $row['account_id'];
                                                            $_SESSION['role_id'] = $row['role_id'];
                                                            header('location:products.php');
                                                        } 
                                                        else if ($row['role_id'] != '0') {
                                                            $_SESSION['username'] = $username;
                                                            $_SESSION['id'] = $row['account_id'];
                                                            $_SESSION['role_id'] = $row['role_id'];
                                                            header('location:admin.php');
                                                        } 
                                                    }
                                                }
                                            }
                                        }
                                     ?>
