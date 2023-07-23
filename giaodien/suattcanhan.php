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
        require '../model/user_model.php';
        // require '../model/encrypt.php';
        $model = new user_model();
        // $decrypt = new encrypt();
        // echo $_SESSION['username'];
        $result = $model->getInfo(($_SESSION['username']));
        $row = mysqli_fetch_assoc($result);
        //$num_row = mysqli_num_rows($row);
        // echo $num_row;
        // $truoc = explode("@", $row['email']);
        // $giaima = $decrypt->apphin_giaima($truoc[0]);
        // $decryptemail = $giaima."@".$truoc[1];
        // $decryptsdt = $decrypt->apphin_giaima($row['sdt']);
        $name = $row['name'];
        $address = $row['address'];
        $phone = $row['phone'];
        $email = $row['email'];
        ?>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <h1>Change Information</h1>
                    <form method="post" action="../xuly/change_info_script.php">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input id="name" type="text" class="form-control" name="name" required="true" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input id="email" type="email" class="form-control" name="email" required="true" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input id="phone" type="num" class="form-control" name="phone" required="true" value="<?php echo $phone; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input id="address" type="text" class="form-control" name="address" required="true" value="<?php echo $address; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="changeInfo" class="btn btn-primary" value="Change">
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
            $('#changeInfo').click(function(event) {
                event.preventDefault();
                var email = document.getElementById("email").value;
                var name = document.getElementById("name").value;
                var phone = document.getElementById("phone").value;
                var address = document.getElementById("address").value;

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
                var regex_sdt = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
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
                    url: '../xuly/change_info_script.php',
                    data: {
                        email: email,
                        name: name,
                        phone: phone,
                        address: address
                    },
                    success: function(result) {
                        console.log(result)
                        if (result == 1) {
                            alert("Sửa thông tin thành công")
                            window.location.href = 'suattcanhan.php';
                        }  else if (result == 0) {
                            alert("Không có thông tin thay đổi")
                            window.location.href = 'suattcanhan.php';
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