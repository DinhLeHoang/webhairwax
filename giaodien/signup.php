<?php
    require '../connectdb/connect.php';
    session_start();
    if(isset($_SESSION['email'])){
        header('location: products.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="../img/lifestyleStore.png" />
        <title>Projectworlds Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="../bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="../css/style.css" type="text/css">
        <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    </head>
    <body>
        <div>
            <?php
                require '../giaodien/header.php';
            ?>
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h1><b>SIGN UP</b></h1>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="true">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="true"">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="repassword" id="repassword" placeholder="RePassword" required="true"">
                            </div>
                            <!-- <button type="button" onclick="togglePassword()">Hiển thị mật khẩu</button> -->
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required="true">
                            </div>
                            <div class="form-group"> 
                                <input type="num" class="form-control" name="phone" id="phone" placeholder="Phone" required="true">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="true">
                            </div> 
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" required="true">
                            </div>
                            <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" id="btndangky" value="Sign Up">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br>
           <footer class="footer">
               <div class="container">
                <center>
                   <p>Copyright &copy Store. All Rights Reserved.</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
<script>
    $(document).ready(function() {
        $('#btndangky').click(function(event) {
        event.preventDefault();
        var username = document.getElementById("username").value; 
        var email = document.getElementById("email").value; 
        var name=document.getElementById("name").value;
        var password=document.getElementById("password").value; 
        var repassword=document.getElementById("repassword").value;
        var phone=document.getElementById("phone").value;
        var address=document.getElementById("address").value; 
        if (username == '') {
            alert('Vui lòng nhập tên tài khoản!');
            return;
        }
        if (email == '') {
            alert('Vui lòng nhập địa chỉ email!');
            return;
        }
        var regex_email = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/;
        if (!regex_email.test(email)) {
            alert('Email không hợp lệ');
            return;
        }
        if (name == '') {
            alert('Vui lòng nhập họ tên!');
            return;
        }
        if (password == '') {
            alert('Vui lòng nhập mật khẩu!');
            return;
        }
        if (password != repassword){
            alert('Nhập sai mật khẩu');
            return;
        }
        // var regex_pass=/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_])[a-zA-Z\d\W_]{8,}$/;
        // if (!regex_pass.test(password)) {
        //     alert('Mật khẩu phải ít nhất 8 kí tự, ít nhất một chữ/số/kí tự đặc biệt');
        //     return;
        // }
        if (phone == '') {
            alert('Vui lòng nhập số điện thoại!');
            return;
        }
        //đầu 84 hoặc 0
        var regex_sdt =/(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
        if (!regex_sdt.test(phone)) {
            alert('Số điện thoại không hợp lệ');
            return;
        }
        if (address == '') {
            alert('Vui lòng nhập địa chỉ!');
            return;
        }
        $.ajax({
            type: 'POST',
            url: '../xuly/user_registration_script.php',
            data: {
                username: username,
                email: email,
                name: name,
                password: password,
                phone: phone,
                address: address
            },
            success: function(result) {
                console.log(result)
                if (result==1) {
                    alert("Đăng kí thành công")
                    window.location.href = 'login.php';
                } else if (result==0){
                    alert("Tài khoản đã tồn tại")
                } else if (result=='blank') {

                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        });
    });
</script>