<?php 
     class bill_model{
        private $con;
        public function __construct() {
            $this->con = ketnoi();
        }
//        public function insertbill($user,$date,$total){
//            $bill_query = "insert into bill(user,date,total)"
//                . "values(?,?,?)";
//            $stmt = mysqli_prepare($this->con,$bill_query);
//            mysqli_stmt_bind_param($stmt,"isi", $user,$date,$total);
//            mysqli_stmt_execute($stmt);
//        }
          function insertbill($user,$total){
                $sql="INSERT INTO don_hang(user_id,tong_tien,ngay_gio_thanh_toan,tinh_trang,ten_nguoinhan,sdt_nguoinhan,diachi_giaohang)
                          VALUES($user,$total,'','Processing','','','')";
               $result = mysqli_query($this->con,$sql);
               if(mysqli_affected_rows($this->con) != 0){
                    return 1;
                }
                return 0;
            }
        public function gettotalprice(){
            $query ="select SUM(tong_tien) as tong from don_hang";
            $result = mysqli_query($this->con, $query);
            return $result;
        }
        public function getlatestbillbyUserID($userid){
            $query = "select MAX(ma_don_hang) as latestbill from don_hang where user_id=$userid";
            $result = mysqli_query($this->con, $query);
            return $result;
        }
        public function getinfo($userid){
            $res = $this->getlatestbillbyUserID($userid);
            $row = mysqli_fetch_assoc($res);
            $latestbillID = $row['latestbill'];
            $query = "select don.ma_don_hang, ct.id_sanpham, ct.size, ct.so_luong, g.don_gia
                    from chi_tiet_gio_hang as ct 
                    join gio_hang as gio 
                    on ct.id_gio_hang = gio.id_gio_hang
                    join sanpham as g
                    on ct.id_sanpham = g.id_sanpham
                    join don_hang as don
                    on gio.user_id = don.user_id
                    where gio.user_id=$userid and don.ma_don_hang=$latestbillID";
            //$query ="select t.bill_id, t.id_sanpham,t.quantity,s.price from (SELECT b.bill_id, c.id_sanpham,c.quantity 
                    //FROM bill as b join cart as c
                    //on b.user=c.user_id and b.date=c.payment_time
                    //where status='Paid' and payment_time='$payment_time') as t join sp as s
                    //on t.id_sanpham=s.id_sanpham";
            $result = mysqli_query($this->con, $query);
            return $result;
        }
        public function payorder($orderid,$paymentdate,$rcname,$rccontact,$rcadd){
            $query = "update don_hang set tinh_trang='Paid',ngay_gio_thanh_toan='$paymentdate',"
                    . " ten_nguoinhan='$rcname',sdt_nguoinhan='$rccontact',diachi_giaohang='$rcadd'"
                    . "where ma_don_hang=$orderid";
            $result = mysqli_query($this->con, $query);
        }
        public function deleteorderbyID($orderid){
            $query = "delete from don_hang where ma_don_hang=$orderid and tinh_trang='Processing'";
            $result = mysqli_query($this->con, $query);
            if(mysqli_affected_rows($this->con) != 0){
                return 1;
            }
            return 0;
        }
        public function totalpaidorder(){
            $query = "select COUNT(*) as tongdonhang from don_hang where tinh_trang!='Processing'";
            $result = mysqli_query($this->con, $query);
            return $result;
        }
        public function numofpaidorder(){
            $query = "select COUNT(*) as chuaxuly from don_hang where tinh_trang='Paid'";
            $result = mysqli_query($this->con, $query);
            return $result;
        }
        public function numofshippedorder(){
            $query = "select COUNT(*) as daxuly from don_hang where tinh_trang='Shipped'";
            $result = mysqli_query($this->con, $query);
            return $result;
        }
     }
?>

