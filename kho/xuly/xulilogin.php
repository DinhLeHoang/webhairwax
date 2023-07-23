<?php 
 require '../../connectdb/connect.php';
 require '../../model/encrypt.php';
    $con = ketnoi();
    session_start();
    
                                        if (isset($_POST['submit'])) {
                                           
                                            $check = 0;
                                            $email = mysqli_real_escape_string($con, $_POST['email']);
                  
                                            $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
                                            if (!preg_match($regex_email, $email)) {
                                                echo "<p class=\"error\">Email không hợp lệ</p><br>";
                                                $check++;
                                            }
                                            $password = mysqli_real_escape_string($con,$_POST['password']);
                                            if(strlen($password)<6){
                                                echo "<p class=\"error\">Password không hợp lệ, tối thiểu 6 kí tự</p><br>";
                                                $check++;
                                            }
                                            if($check == 0){
                                               $tiento = explode("@", $email);
                                                $model = new encrypt();
                                                $mahoatiento = $model->apphin_mahoa($tiento[0]);
                                                $encryptemail = $mahoatiento."@".$tiento[1];
                                                $encryptpass = $model->apphin_mahoa($password);
                                                $user_authentication_query = "select role,user_id,email from user where email='$encryptemail' and pass='$encryptpass' and role='kho'";
                                                $user_authentication_result = mysqli_query($con, $user_authentication_query) or die(mysqli_error($con));
                                                $rows_fetched = mysqli_num_rows($user_authentication_result);
                                                if($rows_fetched==0){
                                                   
                                                   echo "<script>
                                                    alert('Sai email hoặc mật khẩu');
                                                    window.location.href='../giaodien/Dangnhap.php';
                                                    </script>";
  
                                                }
                                               
                                                else{
                                                    $row= mysqli_fetch_assoc($user_authentication_result);
         
                                                        $_SESSION['email'] = $email;
                                                        $_SESSION['id'] = $row['user_id'];
                                                        $_SESSION['role'] = $row['role'];
                                                        header("location:../giaodien/index.php");
                                                   
                                                }
                                                 
                                            }
                                        }
                                     ?>
