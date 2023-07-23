<?php
session_start();
//kiem tra session
if (!isset($_SESSION['username']) or !isset($_SESSION['role_id'])) {
    header("Location: ../giaodien/index.php");
    exit;
} else if ($_SESSION['role_id'] != '1' and $_SESSION['role_id'] != '2' and $_SESSION['role_id'] != '3') {
    header("Location: ../giaodien/index.php");
    exit;
}
include '../connectdb/connect.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTVC Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/css/admin.css">
    <link rel="stylesheet" href="../bootstrap/css/admin2.css">
    <!--<link rel="stylesheet" href="/font-awesome/css/all.css">-->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #F0F0F0;" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
    <?php require '../giaodien/admin_menu.php'; ?>
    <div class="main">
        <h3 class="a0">Quản lý phân quyền</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th></th>
                    <?php
                    $con = ketnoi();
                    $sql = "SELECT * FROM role where role_id!='0'";
                    $query = mysqli_query($con, $sql);
                    while ($role_row = mysqli_fetch_assoc($query)) {
                        $role_name = $role_row['role_name'];
                        echo "<th>" . $role_name . "</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $con = ketnoi();
                $sql = "SELECT * FROM function";
                $query = mysqli_query($con, $sql);
                while ($func_row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    $func_name = $func_row['func_name'];
                    echo "<td>" . $func_name . "</td>";
                    $role_query = mysqli_query($con, "SELECT * FROM func_role WHERE func_id = {$func_row['func_id']}");
                    while ($role_row = mysqli_fetch_assoc($role_query)) {
                        echo "<td><input type='checkbox' class='role-checkbox' data-funcid='" . $func_row['func_id'] . "' data-roleid='" . $role_row['role_id'] . "' " . ($role_row['status'] == 1 ? "checked" : "") . "></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../giaodien/phanquyen.php" id="update-link">REFRESH</a>
    </div>
    <script>
        $(document).ready(function() {
            $('.role-checkbox').change(function() {
                var func_id = $(this).data('funcid');
                var role_id = $(this).data('roleid');
                var status = $(this).is(':checked') ? 1 : 0;
                console.log(func_id,role_id)
                $.ajax({
                    url: '../xuly/xulyphanquyen.php',
                    type: 'POST',
                    data: {
                        func_id: func_id,
                        role_id: role_id,
                        status: status
                    },
                    success: function(result) {
                        console.log(result)
                        if (result.trim() === '1') {
                            alert('Cập nhật quyền thành công!');
                        } else if (result.trim() === '0'){
                            alert('Cập nhật quyền thất bại!');
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('Cập nhật quyền thất bại!');
                    }
                });
            });
        });
    </script>
</body>

</html>