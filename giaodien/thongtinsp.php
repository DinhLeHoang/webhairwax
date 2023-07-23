<!DOCTYPE html>
<?php require '../connectdb/connect.php';
    session_start();
    
?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
     <link rel="shortcut icon" href="../img/lifestyleStore.png" />
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min(1).css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--<link rel="stylesheet" href="../css/style.css" type="text/css">-->
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">  
</head>
<body>
    <?php require '../giaodien/header_products.php';?>

<br><br><br>

<div class="than">
    <div class="anh">
        <?php require '../xuly/xulythongtinsp.php';?>
        <!--<p> – Về mặt thiết kế: Với form dáng mạnh mẽ, linh hoạt và trẻ trung. Đối tượng hướng đến là khá đa dạng.</p>

        <p>– Chất lượng: Riêng về mặt chất lượng sẽ không bao giờ phải lo lắng khi lựa chọn. Nổi tiếng với sự gia công tinh xảo từ đường kim mũi chỉ đem lại cho người dùng trải nghiệm rất tốt. Sản phẩm này được sử dụng với khá nhiều mục đích như chơi thể thao, dạo phố….</p>-->


    </div>
    
    <div class="spkhac">
        <p id="c2">Sản phẩm liên quan</p><br><br>
        <table border="2" id="table">
                <tr>
                <?php
                $con = ketnoi();
                $masp = $_GET['spid'];
                $query1 = "select ma_nha_cung_cap from sanpham where sanpham.id_sanpham='$masp'";
                $result = mysqli_query($con, $query1);
                $row = mysqli_fetch_assoc($result);
                $mancc = $row['ma_nha_cung_cap'];
                $query2 = "select * from sanpham where sanpham.ma_nha_cung_cap='$mancc' limit 0,3";
                $result2 = mysqli_query($con, $query2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                    <td><a href="../giaodien/thongtinsp.php?spid=<?php echo $row2['id_sanpham'];?>"><img src="../<?php echo $row2['hinh1']; ?>" width="50%"><br><span id="c1"><?php echo $row2['ten']; ?></span></a></td>
                <?php
                }
                ?>
                </tr>
            </table>

    </div>
</div>
<br><br><br><br><br><br><br><br>
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
                
                var mySelect = document.getElementById('sizesanpham');
                mySelect.selectedIndex = 0; 
                var sizemacdinh = mySelect.value;
                guiajax(sizemacdinh);
                function guiajax(sizedachon){
                    var spid = '<?php echo $_GET['spid'];?>';
                    $.ajax({
                            method: 'post',
                            url: '../model/slsize.php',
                            datatype: "JSON",
                            data: {sp: spid, size: sizedachon},
                            success: function(response){
                                // alert (response);
                                if(response <=0){
                                    document.getElementById("slton").innerHTML = "Đã hết";
                                    $("#slton").css("color","red");
                                    $("#a4").attr("disabled",true);
                                }
                                else{
                                    document.getElementById("slton").innerHTML = response;
                                    $("#slton").css("color","black");
                                    $("#a4").attr("disabled",false);
                                }
                            }
                    });
                }
                 
                function addcart(){
                     <?php if(isset($_SESSION['username'])){
                            $user = $_SESSION['username'];
                        }
                        else{
                            $user = "";
                        }
                     ?>
                    var username = '<?php echo $user;?>';
                   
                    if(username == ""){
                        window.location="http://localhost:8080/web/giaodien/login.php";
                    }
                    else{
                        
                        var spid = '<?php echo $_GET['spid'];?>';
                        var qty = document.getElementById('quantity').value;
                        var szsanpham = document.getElementById('sizesanpham').value;
                        $.ajax({
                           
                            url: '../model/cart_model.php',
                            method: 'POST',
                            data: {user: username, sp: spid, quantity: qty, size: szsanpham},
                            datatype: "json",
                            success: function(response){ 
                                // alert(response)
                               if(response == 1){
                                    document.getElementById('addsuccess').style.display = "block";
                               }
                               else{
                                   document.getElementById('vuotquasl').style.display = "block";
                               }
                            }
                        });
                    }
                }
                function checksize(){
                    var sizedachon = document.getElementById('sizesanpham').value;
                    guiajax(sizedachon);
                        //document.getElementById('slconlai').innerHTML = "Số lượng còn lại: "
                }
                function clearmessage(){
                    $("#addsuccess").css("display","none");
                    $("#vuotquasl").css("display","none");
                }
            document.getElementById("a4").onclick = addcart;
            document.getElementById("sizesanpham").onchange = checksize;
            document.getElementById("quantity").onclick = clearmessage;
            //document.getElementById("sizesanpham").onchange = checksize;
            });
        </script>
</html>