<?php
        //include_once '../model/product_model.php';
        require_once '../model/paginator.php';
        $limit = ( isset($_GET['limit']) ) ? $_GET['limit'] : 8;
        $page = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
        $links = ( isset($_GET['links']) ) ? $_GET['links'] : 7;
        $query = "select * from sanpham as g join nha_cung_cap as ncc on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap";
        $Paginator = new Paginator($query);
        $results = $Paginator->getData($limit, $page);
                    //$product = new product_model();
                    //$list = $product->getAllProducts();
                    $row_count = ceil($Paginator->_totalpage/4);
                    $bieni=0;
                    while($row_count != 0){
                       $biendong=0;
                    ?>
                        <div class="row line">
                            <?php 
                                for ($i = $bieni; $i < count($results->data); $i++) :
                                $biendong+=1;
                                //$row = mysqli_fetch_assoc($list);
                                //if(!empty($row)){
                            ?>
                            <div class="col-md-3 col-sm-6 box">
                                <?php 
                                if(isset($_SESSION['useraccount'])){?>
                                    <a href="../giaodien/thongtinsp.php?spid=<?php echo $results->data[$i]['id_sanpham'];//$row["id_sanpham"]?>">
                                        <img src="../<?php echo $results->data[$i]['hinh1']; //$row["hinh1"];?>" >
                                    </a>
                                    <center>
                                        <div class="caption">
                                            <h3><?php echo $results->data[$i]['ten']; //$row["ten"];?></h3>
                                            <p>Price: <?php echo $results->data[$i]['don_gia']; //$row["don_gia"];?> Brand: <?php echo $results->data[$i]['ten_nha_cung_cap'];//$row["ten_nha_cung_cap"]?></p>

                                            <?php /*if(!isset($_SESSION['email'])){  ?>
                                            <p><a href="../giaodien/login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                                <?php
                                                }
                                                else{
                                                    if(check_if_added_to_cart(1)){
                                                        echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
                                                    }else{
                                                        ?>
                                                        <a href="../giaodien/cart_add.php?id=1" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                        <?php
                                                    }
                                                }*/
                                                ?>

                                        </div>
                                    </center>
                                <?php }
                                else {?>
                                    <a href="../giaodien/thongtinsp.php?spid=<?php echo $results->data[$i]['id_sanpham'];//$row["id_sanpham"]?>">
                                        <img src="../<?php echo $results->data[$i]['hinh1']; //$row["hinh1"];?>" >
                                    </a>
                                    <center>
                                        <div class="caption">
                                            <h3><?php echo $results->data[$i]['ten']; //$row["ten"];?></h3>
                                            <p>Price: <?php echo $results->data[$i]['don_gia']; //$row["don_gia"];?> Brand: <?php echo $results->data[$i]['ten_nha_cung_cap'];//$row["ten_nha_cung_cap"]?></p>

                                        </div>
                                    </center>
                                <?php }?>
                            </div>

                                <?php if($biendong == 4){
                                            $bieni=$i+1;
                                            break;
                                       }
                                    endfor;?>
                        </div>
                    <?php $row_count--;
                    }
                    ?>

    <div style="display: flex; justify-content: center;">
        <?php echo $Paginator->createLinks( $links, 'pagination' ); ?>
    </div>

