<div class="col text-center"><h3>NHẬP KHO</h3></div>
<div class="form-row">
<div class="form-group col-md-3">
      <label style="font-size: 13px;" for="slboxsort">Nhà cung cấp:</label>
      <select style="font-size: 12px;" id="slboxsort" class="form-control">
      
     <option value="--" selected="true">--</option>
 
  <?php 
  require '../../connectdb/connect.php';
  $con= ketnoi();
  $query="select * from nha_cung_cap";
    $result = mysqli_query($con, $query);
                                   
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
    <option value="<?php echo $row['ten_nha_cung_cap']; ?>"><?php echo $row['ten_nha_cung_cap']; ?></option>
                                        <?php 
                                    } 
                                        ?>
       
      </select>
      
</div>
<div class="form-group col-md-1" style="display: flex; align-items:center; justify-content: center; padding-top: 2%;">
        <button class="btn btn-primary" style="width:100%; height:35px; font-size: 13px;" id="khoabtn">Khoá</button>
</div>
</div>


    
        <label style="font-size: 17px; font-weight: bold;">
        Chi tiết đơn:
        </label><br>
<div class="form-row">
    <div class="form-group col-md-4">
      <label style="font-size: 13px;" for="sortsanpham">Sản phẩm</label>
      <select style="font-size: 13px;" id="sortsanpham" class="form-control">
          <option value="--" selected>--</option>
      </select>
    </div>
    <div class="form-group col-md-3">
        <label style="font-size: 13px;" for="dongia">Đơn giá</label><br>
        <input type="text" class="form-control" style="margin:0px;  text-align: left;padding:5px;"id="dongia" disabled="true">
    </div>
    <div class="form-group col-md-1">
        <label style="font-size: 13px;" for="size">Size</label><br>
        <select style="font-size: 13px;" id="size" class="form-control">
            <option value="--" selected>--</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label style="font-size: 13px;" for="soluong">Số lượng</label><br>
        <input type="number" min="0" class="form-control" style="margin:0px; font-size: 13px;"id="soluong">
        
    </div>
    <div class="form-group col-md-1" style="display: flex; align-items:center; justify-content: center; padding-top: 2%;">
            <button class="btn btn-primary" style="width:100%; height:35px; font-size: 13px;" id="thembtn">Thêm</button>
    </div>
</div><br>


<div class="col-md-12">
    <table id="tablenhapkho" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Size</th>
                <th>Số lượng cần nhập thêm</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Hành động</th>
            </tr>
       </thead>
       <tbody>
           
       </tbody>
    </table>
    <div class="row">
        <div class="col text-center">
          <a class="btn btn-success" style="font-size: 15px;" id="getdatatable">Submit</a>
        </div>
    </div>
</div>

