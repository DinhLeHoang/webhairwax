<?php 
    class cart_model1{
        private $con;
        public function __construct() {
            $this->con = ketnoi();
        }
        public function getnumrowcart($user_id){
            $query0 = "select user_id from user_new,account where user_new.user_key=account.username and account.username='$user_id'";
            $result0 = mysqli_query($this->con, $query0);   
            $row= mysqli_fetch_assoc($result0);
            $userid=$row['user_id'];
            $query = "select *
                    from chi_tiet_gio_hang as ct join gio_hang as gio
                    on ct.id_gio_hang = gio.id_gio_hang
                    where gio.user_id=$userid";
            $result = mysqli_query($this->con, $query);
            $num = mysqli_num_rows($result);
            return $num;
        }
        public function getallidsanphambyuser($user_id){
            $query0 = "select user_id from user_new,account where user_new.user_key=account.username and account.username='$user_id'";
            $result0 = mysqli_query($this->con, $query0);
            $row= mysqli_fetch_assoc($result0);
            $userid=$row['user_id'];
            $query = "select ct.id_sanpham,g.ten, ncc.ten_nha_cung_cap,ct.size,ct.so_luong,g.don_gia
                        from chi_tiet_gio_hang as ct 
                        join sanpham as g
                        on ct.id_sanpham = g.id_sanpham
                        join nha_cung_cap as ncc
                        on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap
                        join gio_hang as gio
                        on ct.id_gio_hang = gio.id_gio_hang
                        where gio.user_id =$userid";
            $result = mysqli_query($this->con, $query);
            $data = array();
            $dem=0;
            while($row = mysqli_fetch_assoc($result)){
                $data[$dem] = $row['id_sanpham'];
                $dem+=1;
            }
            return $data;
        }
        public function getallsizesanphambyuser($user_id){
            $query0 = "select user_id from user_new,account where user_new.user_key=account.username and account.username='$user_id'";
            $result0 = mysqli_query($this->con, $query0);
            $row0= mysqli_fetch_assoc($result0);
            $userid=$row0['user_id'];
            $query = "select ct.id_sanpham,g.ten, ncc.ten_nha_cung_cap,ct.size,ct.so_luong,g.don_gia
                        from chi_tiet_gio_hang as ct 
                        join sanpham as g
                        on ct.id_sanpham = g.id_sanpham
                        join nha_cung_cap as ncc
                        on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap
                        join gio_hang as gio
                        on ct.id_gio_hang = gio.id_gio_hang
                        where gio.user_id =$userid";
            $result = mysqli_query($this->con, $query);
            //$counter = $this->getfirstidbyuser($user_id);
            $data = array();
            $dem=0;
            while($row = mysqli_fetch_assoc($result)){
                $data[$dem] = $row['size'];
                $dem+=1;
            }
            return $data;
        }
        public function getIDgiohangbyUsername($userid){
                $con = ketnoi();
                $query0 = "select user_id from user_new,account where user_new.user_key=account.username and account.username='$userid'";
                $result0 = mysqli_query($con, $query0);
                $row0= mysqli_fetch_assoc($result0);
                $userid=$row0['user_id'];
                $query = "select id_gio_hang from gio_hang where user_id='$userid'";
                $result = mysqli_query($con, $query);
                $num_row = mysqli_num_rows($result);
                if($num_row!= 0){
                    while($row = mysqli_fetch_assoc($result)){
                       $idgiohang = $row["id_gio_hang"];
                       return $idgiohang;
                    }
                }
                return 0;
        }
        public function emptycart($user_id){
            $idgiohang = $this->getIDgiohangbyUserID($user_id);
            $query = "delete from chi_tiet_gio_hang where id_gio_hang=?";
            $stmt = mysqli_prepare($this->con, $query);
            mysqli_stmt_bind_param($stmt, "i", $idgiohang);
            mysqli_stmt_execute($stmt);
            /*if(mysqli_stmt_affected_rows($stmt) != 0){
                return true;
            }
            else{
                return false;
            }*/
        }
    }
?>

