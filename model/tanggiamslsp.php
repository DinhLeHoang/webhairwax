<?php
class tanggiamsl{
    private $con;
    public function __construct() {
        $this->con = ketnoi();
    }
    public function giam($don,$user_id){
        $sql1 = "select ct.id_sanpham, ct.size, ct.so_luong
                                from don_hang as don 
                                join chi_tiet_don_hang as ct
                                on don.ma_don_hang = ct.ma_don_hang
                                where don.ma_don_hang=$don and don.user_id=$user_id";
        $result = mysqli_query($this->con, $sql1);
        $arridsanpham = array();
        $arrsize = array();
        $arrsoluong = array();
        $dem = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $arridsanpham[$dem] = (int)$row['id_sanpham'];
            $arrsize[$dem] = (int)$row['size'];
            $arrsoluong[$dem] = (int)$row['so_luong'];
            $dem += 1;
        }
        $i = 0;
        while ($i < count($arridsanpham)) {
            $sql2 = "select so_luong_ton_kho_ban from kich_co where id_sanpham=$arridsanpham[$i]"
                    . " and size=$arrsize[$i]";
            $result2 = mysqli_query($this->con, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $slkhoban = (int)$row['so_luong_ton_kho_ban'];
            $slkhobanmoi = $slkhoban - $arrsoluong[$i];
            $sql3 = "update kich_co set so_luong_ton_kho_ban=$slkhobanmoi where id_sanpham=$arridsanpham[$i]"
                    . " and size=$arrsize[$i]";
            $result2 = mysqli_query($this->con, $sql3);
            $sql4 = "select so_luong_ton_kho_ban from sanpham where id_sanpham=$arridsanpham[$i]";
            $result3 = mysqli_query($this->con, $sql4);
            $row1 = mysqli_fetch_assoc($result3);
            $slkhobancusanpham = (int)$row1['so_luong_ton_kho_ban'];
            $slkhobanmoisanpham = $slkhobancusanpham - $arrsoluong[$i];
            $sql4 = "update sanpham set so_luong_ton_kho_ban=$slkhobanmoisanpham where id_sanpham=$arridsanpham[$i]";
            $result4 = mysqli_query($this->con, $sql4);
            $i+=1;
        }
        if(mysqli_affected_rows($this->con) != 0){
            return 1;
        }
        return 0;
    }
    public function tang($don,$user_id){
        $sql1 = "select ct.id_sanpham, ct.size, ct.so_luong
                                from don_hang as don 
                                join chi_tiet_don_hang as ct
                                on don.ma_don_hang = ct.ma_don_hang
                                where don.ma_don_hang=$don and don.user_id=$user_id";
        $result = mysqli_query($this->con, $sql1);
        $arridsanpham = array();
        $arrsize = array();
        $arrsoluong = array();
        $dem = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $arridsanpham[$dem] = (int)$row['id_sanpham'];
            $arrsize[$dem] = (int)$row['size'];
            $arrsoluong[$dem] = (int)$row['so_luong'];
            $dem += 1;
        }
        $i = 0;
        while ($i < count($arridsanpham)) {
            $sql2 = "select so_luong_ton_kho_ban from kich_co where id_sanpham=$arridsanpham[$i]"
                    . " and size=$arrsize[$i]";
            $result2 = mysqli_query($this->con, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $slkhoban = (int)$row['so_luong_ton_kho_ban'];
            $slkhobanmoi = $slkhoban + $arrsoluong[$i];
            $sql3 = "update kich_co set so_luong_ton_kho_ban=$slkhobanmoi where id_sanpham=$arridsanpham[$i]"
                    . " and size=$arrsize[$i]";
            $result2 = mysqli_query($this->con, $sql3);
            $sql4 = "select so_luong_ton_kho_ban from sanpham where id_sanpham=$arridsanpham[$i]";
            $result3 = mysqli_query($this->con, $sql4);
            $row1 = mysqli_fetch_assoc($result3);
            $slkhobancusanpham = (int)$row1['so_luong_ton_kho_ban'];
            $slkhobanmoisanpham = $slkhobancusanpham + $arrsoluong[$i];
            $sql4 = "update sanpham set so_luong_ton_kho_ban=$slkhobanmoisanpham where id_sanpham=$arridsanpham[$i]";
            $result4 = mysqli_query($this->con, $sql4);
            $i += 1;
        }
        if(mysqli_affected_rows($this->con) != 0){
            return 1;
        }
        return 0;
    }
}
?>
