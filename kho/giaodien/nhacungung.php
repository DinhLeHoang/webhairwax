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
      <!-- Latest compiled and minified CSS -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/csskho.css" type="text/css">
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
       
        <?php require 'header.php';
             
        ?>
        <div class="container">
            
        <div class="form-row col-md-12" style="margin: 10px 0px;">
        <div class="form-group col-md-4">
            <input id="searchinput" class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search" style="display:inline-block; margin-left: 3%; width: 60%; font-size: 13px;">
            <button id="searchbtn" class="btn btn-outline-success" type="submit" name="submit" style="font-size: 13px;">Search</button>
        </div>
        </div>
             <?php require '../xuly/xulincc.php';?>
        </div>
    </body>
     <script type="text/javascript">
            
            $(document).ready(function(){
                function statusmacdinh(){
                    var searchinput = document.getElementById("searchinput").value;
                    guiajax(searchinput);
                }
                function guiajax(searchinput){
            
                    $.ajax({
                            method: 'post',
                            url: '../model/ajaxlocncc.php',
                            datatype: "JSON",
                            data: {search: searchinput},
                            success: function(response){
                                var arrayObj = JSON.parse(response);
                                $("#tablehienthi").find('tbody').empty();
                                arrayObj.forEach(function (item,index){
                                    var row = $('<tr>');
                                    row.append('<td>' + item.id+'</td>');
                                    row.append('<td>' + item.name+'</td>');
                                    row.append('<td>' + item.address + '</td>');
                                    row.append('<td>' + item.phone + '</td>');
                                    row.append('</tr>');
                                    $("#tablehienthi").find('tbody').append(row);
                                });
                                //console.log(arrayObj);
                            }
                    });
                }
                function search(){
                    var searchinput = document.getElementById("searchinput").value;
                    guiajax(searchinput);
                }
                statusmacdinh();
                document.getElementById("searchbtn").onclick = search;
            });
           </script>
</html>