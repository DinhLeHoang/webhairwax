<?php include_once '../model/product_model.php';
                    $id = intval($_GET['spid']);
                    $product = new product_model();
                    $motaresult = $product->getMotaProductbyid($id);
                    $listqty = $product->getQtyProductbyid($id);
                    $stmt = $product->getProductbyid($id);
                    mysqli_stmt_bind_result($stmt,$ten,$dongia,$hinh1,$hinh2,$hinh3);
                    
                    while (mysqli_stmt_fetch($stmt)) {
                          ?>
        <div class="anh1"  id="a"> 
            <img src="../<?php echo $hinh1;?>" >
        </div>
        <div  class="anhphai" id="a">
            <div class="anh2" >
                <img src="../<?php echo $hinh2;?>" >
            </div>
            <div class="anh3"  id="a">
                <img src="../<?php echo $hinh3;?>" >
            </div>
        </div>
        <div class="chu" id="a">
           <p id="a7"><?php echo $ten;?></p><br>
            <p>Giá bán:<span id="gia"><?php echo $dongia;?></span></p><br>
                    <?php }?>
            <p>Vận chuyển:   
                <select>
                    <option>Nhanh</option>
                    <option>Thông thường</option>
                </select><br>
               <span id="a1"> Miễn Phí Vận Chuyển khi đơn đạt giá trị tối thiểu  </span> 
            </p><br>
               <p id="a2">Size: 
                    
                   <select id="sizesanpham">
                       <?php 
                            $rowcount = mysqli_num_rows($listqty);
                            if($rowcount != 0){
                                while($row = mysqli_fetch_assoc($listqty)){
                            ?>
                                 <option id="<?php echo $row["size"];?>"><?php echo $row["size"];?></option>
                            <?php }
                            
                            }?>
                    </select><br>
               </p>
               <p>Số lượng tồn: <span id="slton"></span></p>
               <br>
               <!--<p id="a2">Màu sắc: <button type="button">�?en</button><button type="button">Trắng</button></p><br>-->
               
                    <p id="a3">Số lượng: 
                        <input onclick="var result = document.getElementById('quantity'); var qty = result.value; if( !isNaN(qty) &amp; qty > 1) result.value--;return false;" type='button' value='-' />
                        <input id='quantity' min='1' name='quantity' type='text' value='1' />
                         <input onclick="var result = document.getElementById('quantity'); var qty = result.value; if( !isNaN(qty)) result.value++;return false;" type='button' value='+' />
                    </p><br><br>
              
                <button id="a4">Thêm vào giỏ hàng</button>
                <p id="addsuccess">Thêm vào giỏ hàng thành công!</p>
                <p id="vuotquasl">Vượt quá số lượng hàng hiện có! Không thể thêm vào giỏ hàng</p>
         </div>
    </div>
    <div class="mota">

        <p id="b2">Mô tả sản phẩm</p><br>
            <p><?php 
                 $rowcountmota = mysqli_num_rows($motaresult);
                            if($rowcountmota != 0){
                                while($row = mysqli_fetch_assoc($motaresult)){
                                    echo $row["mo_ta"];
                                }
                            }
            ?> </p>
            

 
                     
    
  
