<?php 
    session_start();
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
               if(!isset($_SESSION['username'])){
                    header('location: login.php');
                }
               require '../giaodien/header.php';
            ?>
            <br>
            <div class="container">
                <form method="post" action="">
                <?php require '../xuly/xulylichsu.php';?>
                         
                </form>
            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <footer class="footer">
               <div class="container">
                <center>
                   <p>Copyright &copy Store. All Rights Reserved.</p>
                   <!--<p>This website is developed by Yugesh Verma</p>-->
               </center>
               </div>
           </footer>
        </div>
    </body>
   <script type="text/javascript">
            
            $(document).ready(function(){
                function statusmacdinh(){
                    var macdinh = document.getElementById('slboxsort').value;
                    var monthmacdinh = document.getElementById('sortthang').value;
                    guiajax(macdinh,monthmacdinh);
                }
                function guiajax(status,month){
                    var user = <?php echo $_SESSION['id'];?>;
                    $.ajax({
                            method: 'post',
                            url: '../model/ajax_loctinhtrang.php',
                            datatype: "JSON",
                            data: {userid: user,tinhtrang: status, thang: month},
                            success: function(response){
                                var arrayObj = JSON.parse(response);
                                $("#tablelichsu").find('tbody').empty();
                                arrayObj.forEach(function (item,index){
                                    var row = $('<tr>');
                                    row.append('<td>' + item.billid+ '</td>');
                                    row.append('<td>' + item.name + '</td>');
                                    row.append('<td>' + item.size + '</td>');
                                    row.append('<td>' + item.soluong + '</td>');
                                    row.append('<td>' + item.ngaythanhtoan + '</td>');
                                    row.append('<td style="color:#92f200; font-weight: bold;">' + item.tinhtrang + '</td>');
                                    //row.append('<td>'  '</td>');
                                    row.append('</tr>');
                                    $("#tablelichsu").find('tbody').append(row);
                                });
                                //console.log(arrayObj);
                            }
                    });
                }
                function checkselect(){
                    var statusdachon = document.getElementById('slboxsort').value;
                    guiajax(statusdachon);
                }
                function loclichsu(){
                    var status = document.getElementById('slboxsort').value;
                    var month = document.getElementById('sortthang').value;
                    guiajax(status,month);
                }
                //statusmacdinh();
                //document.getElementById("loclichsu").onclick = loclichsu;
                //document.getElementById("slboxsort").onchange = checkselect;
            });
            
   </script>
</html>

