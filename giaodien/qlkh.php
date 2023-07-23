    <?php 
    session_start();
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
        <?php require '../giaodien/admin_menu.php';?>
        <div class="main">
            
            <div class="aa">
                <h3 class="a0">Quản lý tài khoản </h3>
                
              <button type="button" id="them_tk" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Thêm tài khoản</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
           <h4 class="modal-title">Thêm tài khoản</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
        
        <div >
    <form method="POST" enctype="multipart/form-data" action="../xuly/xulythem.php">
        <div class="themsp">
       
            <input  style="display: none;" type="text" name="user_id"  class="form-controll" ><br>
         <label >email</label><br>
        <input type="text" name="email"  required="true">  <br>
        <label >password</label><br>
        <input type="password" name="pass"  required="true"> <br><br>
        <label >Nhập lại password</label><br>
        <input type="password" name="pass2" required="true" > <br><br>
         <label >SDT</label><br>
         <input type="text" name="sdt" required="true" > <br>
         <label >Role</label><br>
         <select name='role' >
       <option>admin</option> 
       <option>kho</option>
         </select><br>   <br>  
         <button type="submit" class="sub" name="sub2">Thêm</button>
         </div>
       
    </form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
                
                
          
                <div class="header_search">
                    <form action="qlkh.php" method="post" id="header-search-form">
                        <input type="text" name="keyword" class="form-control searchbar" id="searchbox" placeholder="Search..">
                          <button type="submit" name="submit">
                             <i class="fa fa-search" aria-hidden="true"></i>
                          </button>
                    </form>
                </div>
                <table class="table"  >
                    <thead class="thead-dark">
                        <tr>
                        <th>STT</th>
                        <th>user_id</th>
                        <th>Email</th>  
                        <th>SDT</th>
                        <th>Role</th>
                         <th>Sửa</th>
                        <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        include '../connectdb/connect.php';
                        $con = ketnoi();
                        
            
                        if(isset($_POST['keyword'])){
                            $search=$_POST['keyword'];
                            $regex = '/[^a-zA-Z0-9@_.\/]|(@.*@)/';
                            if (preg_match($regex, $search)) {
                                echo "<p style='display:block;color:red;font-size:15px;'>Email không hợp lệ, hãy nhập lại</p><br>";
                                $sql = "SELECT user_id,email,phone,role_name FROM user_new,account,role where user_new.user_key=account.username and account.role_id=role.role_id ";
                                $query = mysqli_query($con, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr id="a1">     

                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['user_id']; ?></td>

                                        <td>
                                            <?php 
                                                
                                                echo $row['email']; 
                                            ?>
                                        </td>  
                                        <td><?php 
                                            
                                                echo $row['phone']; 
                                                ?>
                                        </td>  
                                         <td><?php echo $row['role_name']; ?></td>
                                        <td><a href="../giaodien/sua_user.php?user_id=<?php echo $row['user_id']; ?>">Sửa</a></td>
                                        <td><a onclick="return Del('<?php echo $email; ?>')" href="../giaodien/xoa_user.php?user_id=<?php echo $row['user_id']; ?>">Xóa</a></td>
                                    </tr>
                                <?php 
                                }
                            }
                            else{

                                $sql1 = "SELECT user_id,email,phone,role_name FROM user_new,account,role where user_new.user_key=account.username and account.role_id=role.role_id and user_new.email='$search'";
                                $query = mysqli_query($con, $sql1);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr id="a1">     

                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['user_id']; ?></td>

                                        <td>
                                            <?php 
                                                
                                                echo $row['email']; 
                                            ?>
                                        </td> 
                                        <td><?php
                                               
                                                echo $row['phone'];
                                        ?></td>  
                                           <td><?php echo $row['role_name']; ?></td>
                                        <td><a href="../giaodien/sua_user.php?user_id=<?php echo $row['user_id']; ?>">Sửa</a></td>
                                        <td><a onclick="return Del('<?php echo $email; ?>')" href="../giaodien/xoa_user.php?user_id=<?php echo $row['user_id']; ?>">Xóa</a></td>
                                    </tr>
                            <?php }
                        
                            }
                        } else {
                            $sql = "SELECT user_id,email,phone,role_name FROM user_new,account,role where user_new.user_key=account.username and account.role_id=role.role_id";
                            $query = mysqli_query($con, $sql);
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr id="a1">     

                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['user_id'];?>  </td>
                                        
                                    <td>
                                        <?php 
                                        
                                            echo $row['email']; 
                                        ?>
                                    </td>  
                                    <td><?php 
                                            
                                            echo $row['phone']; 
                                            ?>
                                    </td>  
                                       <td><?php echo $row['role_name']; ?></td>
                                       <td>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $row['user_id']?>">Sửa</button></td>
                                       <td><a onclick="return Del('<?php echo $email; ?>')" href="../giaodien/xoa_user.php?user_id=<?php echo $row['user_id']; ?>"><button class="btn btn-primary"> Xóa</button></a></td>
                                </tr>
                        <?php 
                            }
                         }
                        ?>

                    </tbody>  
                </table>
            </div>


        </div>
        
        <div>
            <footer class="footer">
               <div class="container">
                <center>
                   <p style="padding-top: 20px;">Copyright &copy Store. All Rights Reserved.</p>
                   <br><br><br>
                   <!--<p>This website is developed by Yugesh Verma</p>-->
               </center>
               </div>
           </footer>
        </div>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   <div >
    <form method="POST" enctype="multipart/form-data" action="../xuly/xulysua.php">
        <input type="text" name="id" id="id" class="id" style="display: none" class="form-controll" required ><br>
        <div class="themsp">
            User ID: <span id="user_id"></span><br><br>
          <label >Email</label><br>
          
           <input type="text" name="email" id="email"  >  <br><br>
     
         <label >SDT</label><br>
         
         <input type="text" name="sdt" id="sdt"  > <br><br>
         <div id="phan_bac">
             <label >Role</label><br>
             <select name="role">
                 <option id="admin"> admin</option>
                  <option id="kho">kho</option>              
             </select><br>
         </div>
    
   <br> <button type="submit" class="btn btn-primary" name="sub2">Sửa</button>
         </div>
    </form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      
        <script type="text/javascript">
              function Del(name) {
                    return confirm("Bạn có chắc chắn muốn xóa user có email là: " + name + " ?");
                }
                $.extend({
                    xResponse: function(url, data) {
                    var arrayObj = null;
                    $.ajax({
                            method: 'post',
                            url: url,
                            datatype: "JSON",
                            data: data,
                            async: false,
                            success: function(response){
                                arrayObj = JSON.parse(response);
                            }   
                        });
                        return arrayObj;
                    }
                }); 
                
                $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this)
  modal.find('.modal-title').text('Sửa thông tin tài khoản');
    var xArrayObj = $.xResponse('../model/ajax_sua_user.php',{id: recipient});
       xArrayObj.forEach(function (item,index){   
         modal.find('#user_id').text(item.user_id);
         modal.find('#id').val(item.user_id);
        modal.find('#email').val(item.email);
        modal.find('#sdt').val(item.sdt);
            if(item.role == "admin"){
            document.getElementById("phan_bac").style.display = "block";
            document.getElementById("admin").selected = true;
            }
            else if(item.role == "kho"){
                 document.getElementById("phan_bac").style.display = "block";
                  document.getElementById("kho").selected = true;
            }
            else{
                 document.getElementById("phan_bac").style.display = "none"
            }
          
    
                    });
    })
    
    
        </script>
    </body>

</html>