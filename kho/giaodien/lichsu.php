<?php 
session_start();
                    if(isset($_SESSION['email'])){
                            $user = $_SESSION['email'];
                        }
                        else{
                            $user = "";
                        }
                     
                    if($user === ""){
                    echo "<script>
                    alert('Vui lòng đăng nhập trước!');
                    window.location.href='../giaodien/Dangnhap.php';
                    </script>";
                    }
                    ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/css.css" type="text/css">
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->


<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title></title>
    </head>
    <body>
       <?php require 'header.php'; ?>
          <div class="container">
<?php require '../xuly/xulilichsu.php'; ?>
          </div>
    </body>
     <script type="text/javascript">
            
            $(document).ready(function(){
                function statusmacdinh(){
                    var macdinh = document.getElementById('slboxsort').value;
                    guiajax(macdinh);
        }
                function guiajax(status){
                    //var user = <?php //echo $_SESSION['id'];?>;
                    $.ajax({
                            method: 'post',
                            url: '../model/ajaxlaynhapxuat.php',
                            datatype: "JSON",
                            data: {loai: status},
                            success: function(response){
                                var arrayObj = JSON.parse(response);
                                $("#tablehtls").find('tbody').empty();
                                arrayObj.forEach(function (item,index){
                                    var row = $('<tr>');
                                    row.append('<td>' + item.id1+'</td>');
                                    row.append('<td>'+ item.id2+'</td>');
                                    row.append('<td>' + item.date + '</td>');
                                    row.append('<td>' + item.quality + '</td>');
                                    row.append('<td>' + item.price + '</td>');
                                    row.append('<td><a class=" btn btn-info" href="../giaodien/chitietls.php?id='+item.id1+'&loai=nhapkho">Chi tiết</a></td>');
                                    row.append('</tr>');
                             
                                    $("#tablehtls").find('tbody').append(row);
                                });
                            }
                    });
                }
                function guiajaxxuat(status){
                    //var user = <?php //echo $_SESSION['id'];?>;
                    $.ajax({
                            method: 'post',
                            url: '../model/ajaxlaynhapxuat.php',
                            datatype: "JSON",
                            data: {loai: status},
                            success: function(response){
                                var arrayObj = JSON.parse(response);
                                $("#tablehtlsx").find('tbody').empty();
                                arrayObj.forEach(function (item,index){
                                    var row = $('<tr>');
                                    row.append('<td>' + item.id+'</td>');
                                    row.append('<td>' + item.quality + '</td>');
                                    row.append('<td>' + item.date + '</td>');
                                    row.append('<td><a class=" btn btn-info" href="../giaodien/chitietls.php?id='+item.id+'&loai=xuatkho">Chi tiết</a></td>');
                                    row.append('</tr>');
                                    $("#tablehtlsx").find('tbody').append(row);
                                });
                            }
                    });
                }
                function checkselect(){
                    var statusdachon = document.getElementById('slboxsort').value;
                    if(statusdachon === "nhapkho"){
                      document.getElementById("tablehtls").style.visibility = 'visible';
                    document.getElementById("tablehtlsx").style.visibility = 'hidden';;
                    guiajax(statusdachon);
                }
                else{
                      document.getElementById("tablehtls").style.visibility = 'hidden';
                     document.getElementById("tablehtlsx").style.visibility = 'visible';
                     guiajaxxuat(statusdachon);
                }
                }
                statusmacdinh();
                document.getElementById("slboxsort").onchange = checkselect;
            });
            
   </script>
</html>