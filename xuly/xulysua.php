<script>
    function check_size(id_sanpham){
         
        
        alert("Size này đã tồn tại");  
      
              window.location='../giaodien/a.php?layout=sua&id='+id_sanpham;
      
    }
                      function success(id_sanpham) {
            alert ("Thêm size thành công");
               window.location='../giaodien/a.php?layout=sua&id='+id_sanpham;
}
    </script>
<?php
require '../connectdb/connect.php';
include "../model/product_model.php";
$b = new product_model();
$con = ketnoi();
if (isset($_POST['sub'])) {
    $id = $_POST['id'];
    $name = $_POST['ipname'];
    $price = $_POST['ipprice'];
    $ma_ncc = $_POST['ma_ncc'];
    $the_loai = $_POST['the_loai'];
    $mo_ta = $_POST['mo_ta'];
    

    //     if($_FILES['image']['name']==''){
    //        $file_name=$row_up['image'];
    //     }
    
     $sql1 = "SELECT ten_nha_cung_cap from nha_cung_cap WHERE ma_nha_cung_cap= '" . $ma_ncc . "'";
    $query1 = mysqli_query($con, $sql1);
        $row= mysqli_fetch_assoc($query1);
      $ten_nha_cung_cap=$row['ten_nha_cung_cap']; 
  
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        if($file_name != null){
   //         move_uploaded_file($file['tmp_name'], '../img/' . $ten_nha_cung_cap . '/' . $file_name);
            $b->suahinh1($file_name, $ten_nha_cung_cap,$id);
            
        }
        
    }
    if (isset($_FILES['image2'])) {
        $file2 = $_FILES['image2'];
        $file_name2 = $file2['name'];
        if($file_name2 != null){
         //   move_uploaded_file($file2['tmp_name'], '../img/' . $ten_nha_cung_cap . '/' . $file_name2);
            $b->suahinh2($file_name2, $ten_nha_cung_cap,$id);
           
        }
        
    }
    if (isset($_FILES['image3'])) {
        $file3 = $_FILES['image3'];
        $file_name3 = $file3['name'];
        if($file_name3 != null){
     //       move_uploaded_file($file3['tmp_name'], '../img/' . $ten_nha_cung_cap . '/' . $file_name3);
            $b->suahinh3($file_name3, $ten_nha_cung_cap,$id);
           
        }
        
    }
    
    header('location:../giaodien/admin.php');
    $b->Sua($name, $price, $ma_ncc, $id,$the_loai,$mo_ta);
    
}

if (isset($_POST['sub2'])) {
    $id = $_POST['id'];
    //$user_id = $_POST['user_id'];
    $email = $_POST['email'];
    //$pass = $_POST['pass'];
    $sdt = $_POST['phone'];
    $role=$_POST['role'];    
    $b->Sua_user($email, $sdt, $id,$role);
    header('location:../giaodien/qlkh2.php');
}
if (isset($_POST['sub3'])) {
    $tam=0;
    $id_sanpham = $_POST['id'];
    $size = $_POST['size'];
    $sl_size = $_POST['sl_size'];
     $where = "SELECT * from kich_co WHERE size='".$size."'";
    $product = mysqli_query($con, $where);  
    if (mysqli_num_rows($product)== 0) {
        $tam=1;
      $b->Them_size($id_sanpham,$size,$sl_size);
     $sql="SELECT SUM(so_luong_ton_kho_tong) from kich_co where id_sanpham=$id_sanpham";
           $query = mysqli_query($con, $sql);
        $row= mysqli_fetch_assoc($query);
        $sum_tongsl=$row['SUM(so_luong_ton_kho_tong)']; 
     $b->update_sl($id_sanpham,$sum_tongsl);
      echo '<script type="text/javascript">','success('.$id_sanpham.');','</script>';
    // echo $tam;
 //  header("location:../giaodien/a.php?layout=sua&id='$id_sanpham'");
    }
    else{
     
        echo '<script type="text/javascript">','check_size('.$id_sanpham.');','</script>';
         //  echo $tam;
     //   header("location:../giaodien/a.php?layout=sua&id='$id_sanpham'");
    }
    }

?>