<?php
session_start();
require '../connectdb/connect.php';
if (!isset($_SESSION['username'])) {
    header('location:index.php');
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
        <br>
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <h1>Change Password</h1>
                    <form method="post" action="../xuly/setting_script.php">
                        <div class="form-group">
                            <input type="password" id="oldPassword" class="form-control" name="oldPassword" placeholder="Old Password">
                        </div>
                        <div class="form-group">
                            <input type="password" id="newPassword" class="form-control" name="newPassword" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <input type="password" id="retype" class="form-control" name="retype" placeholder="Re-type new password">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="changePass"class="btn btn-primary" value="Change">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br><br><br><br>
        <footer class="footer">
            <div class="container">
                <center>
                    <p>Copyright &copy Store. All Rights Reserved.</p>
                    <!--<p>This website is developed by Yugesh Verma</p>-->
                </center>
            </div>
        </footer>
    </div>
    <script>
        $(document).ready(function() {
            $('#changePass').click(function(event) {
                event.preventDefault();
                var oldPass = document.getElementById("oldPassword").value;
                var newPass = document.getElementById("newPassword").value;
                var rePass = document.getElementById("retype").value;
                console.log(oldPass,newPass,rePass)
                if (oldPass == '') {
                    alert('Vui lòng nhập mật khẩu!');
                    return;
                }
                if (newPass == '') {
                    alert('Vui lòng nhập mật khẩu!');
                    return;
                }
                if (rePass == '') {
                    alert('Vui lòng nhập mật khẩu!');
                    return;
                }
                if (rePass != newPass) {
                    alert('Mật khẩu mới không khớp nhau');
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: '../xuly/setting_script.php',
                    data: {
                        old: oldPass,
                        new: newPass
                    },
                    success: function(result) {
                        console.log(result)
                        if (result.trim() == 1) {
                            alert("Cập nhật mật khẩu thành công")
                            window.location.href = 'settings.php';
                            oldPass.value=""
                            newPass.value=""
                            rePass.value=""
                        } else if (result.trim() == 0) {
                            alert("Sai mật khẩu cũ")
                            window.location.href = 'settings.php';
                            oldPass.value=""
                            newPass.value=""
                            rePass.value=""
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>