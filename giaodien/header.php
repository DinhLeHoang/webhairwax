<nav class="navbar navbar-inverse navabar-fixed-top">
    <link rel="stylesheet" href="../css/slidebar.css" type="text/css">
               <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="../giaodien/index.php" class="navbar-brand">Shop</a>
                       
                       <!--<img  id="logoshop" src="../img/logoshop.png"/>-->
                   </div>
                   
                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                           <?php
                           ob_start();
                           if(isset($_SESSION['username'])){
                              if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == '0'){
                            ob_end_flush();
                           ?>
                           <li>
                               <li class="header_search">
                                   <form action="../giaodien/result.php" method="post" id="header-search-form">
                                        <input type="text" name="keyword" class="form-control" placeholder="Search..">
                                    
                                        <button type="submit" name="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </li>
                           </li>
                           <li class="brand">
                               <a href="#">Brand</a>
                               <div class="dropdown-content">
                                   <div>
                                       <a class="text-cl" href="../giaodien/pdbybrand.php?brand=MorrisMotley">Morris Motley</a>
                                       <a class="text-cl" href="../giaodien/pdbybrand.php?brand=Osis">Osis</a>
                                       <a class="text-cl" href="../giaodien/pdbybrand.php?brand=KenvinMurphy">Kenvin Murphy</a>
                                       
                                   </div>     
                                </div>
                                   
                           </li>
                           <li><a href="../giaodien/dsdonhang.php">Orders</a></li>
                           <li><a href="../giaodien/hoadon.php">Bill</a></li>
                           <li><a href="../giaodien/lichsu.php"><span class="glyphicon glyphicon-time"></span> History</a></li>
                           <li><a href="../giaodien/cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                           <li class="brand">
                               <a href="#"><span class="glyphicon glyphicon-cog"></span>User Information</a>
                               <div class="dropdown-content">
                                   <div>
                                       <a class="text-cl" href="../giaodien/suattcanhan.php">Change information</a>
                                       
                                       <a class="text-cl" href="../giaodien/settings.php">Change password</a>
                                   </div>     
                               </div>
                               
                           </li>
                           <li><a href="../giaodien/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                           <?php
                           }}else{
                            ?>
                           
                           <li><a href="../giaodien/signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                           <li><a href="../giaodien/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                           <?php
                           }
                           ?>
                           
                       </ul>
                   </div>
               </div>
</nav>