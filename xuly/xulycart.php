<?php if($no_of_user_products == 0){
                         echo "<h4>No items in the cart!</h4>";   
                        }
                        else {?>
                <form action="../xuly/cart_change.php" method="post">
                    <table id="tablecart" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Brand</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                           <?php 

                            $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
                            $no_of_user_products= mysqli_num_rows($user_products_result);

                            $counter=1;
                           while($row=mysqli_fetch_array($user_products_result)){

                             ?>
                            <tr>
                                <th><?php echo $counter ?></th>
                                <th><?php echo $row['ten']?></th>
                                <th><?php echo $row['ten_nha_cung_cap']?></th>
                                <th><?php echo $row['size']?></th>
                                <th>
                                     <input type="button" value="-" class="btntru tru" onclick="var qtyid = <?php echo $counter;?>;
                                           var val = document.getElementById('qty-' + qtyid).value;
                                           if(val <= 1){
                                               $('#qty-' +qtyid).attr('value',1);
                                           }
                                           else{
                                               val=val-1;
                                               $('#qty-' +qtyid).attr('value',val);
                                           }">
                                     <input name="qty-<?php echo $counter;?>" id="qty-<?php echo $counter;?>" type="text" value="<?php echo $row['so_luong']?>" min="1">

                                     <input type="button" value="+" class="btncong cong" onclick="var qtyid = <?php echo $counter;?>;
                                           var val = document.getElementById('qty-' + qtyid).value;
                                           val=parseInt(val)+1;
                                                 $('#qty-' +qtyid).attr('value',val);" >
                                </th>
                                <th><?php echo $row['don_gia']?></th>
                                <th><a href='../xuly/cart_remove.php?id=<?php echo $row['id_sanpham'] ?>&size=<?php echo $row['size']?>'>Remove</a></th>
                            </tr>
                           <?php $counter=$counter+1;}?>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>Rs <?php echo $sum;
                                        $_SESSION['total'] = $sum;?></th>
                                <th><input id="cfchange" type="submit" name="submit" class="btn btn-primary change" value="Confirm Change"></th>
                                <!--<th><a class ="btn btn-primary" href="../giaodien/success.php?id=<?php //echo $user_id?>">Confirm Order</a></th>-->
                                <th><input type="button" id="createorder" class="btn btn-primary" value="Create Order"></th>
                            </tr>
                        </tbody>
                    </table>
                            <?php }?>
                </form>

