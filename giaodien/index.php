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
            require '../giaodien/header.php';
           ?>
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent">
                       <h1>We sell .</h1>
                       <p>Flat 40% OFF on all premium brands.</p>
                       <a href="products.php" class="btn btn-danger">Shop Now</a>
                   </div>
                   </center>
               </div>
           </div>
           <div class="container">
               <div class="line row">
                   
                       <div class="col-lg-4 col-sm-4 box">
                           <a href="../giaodien/pdbybrand.php?brand=MorrisMotley">
                               <img src="../img/download.jpg" alt="Morris Motley">
                           </a>
                           <center>
                                <div class="caption">
                                        <p id="autoResize">Morris Motley</p>
                                        <p>Choose among the best available in the world.</p>
                                </div>
                           </center>
                       </div>
                   
                   
                       <div class="col-lg-4 col-sm-4 box">
                           <a href="../giaodien/pdbybrand.php?brand=Osis">
                               <img src="../img/osis-logo.jpg" alt="Osis">
                           </a>
                           <center>
                                <div class="caption">
                                    <p id="autoResize">Osis</p>
                                    <p>Original from Osis brand.</p>
                                </div>
                           </center>
                       </div>
                  
                   
                       <div class="col-lg-4 col-sm-4 box">
                           <a href="../giaodien/pdbybrand.php?brand=KenvinMurphy">
                               <img src="../img/kevin-murphy-logo.jpg" alt="Kenvin Murphy">
                           </a>
                           <center>
                               <div class="caption">
                                   <p id="autoResize">Kenvin Murphy</p>
                                   <p>Original from Kenvin Murphy brand.</p>
                               </div>
                           </center>
                       </div>
                   
               </div>
           </div>
            <br><br> <br><br><br><br>
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
</html>