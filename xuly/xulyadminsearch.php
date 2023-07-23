<?php
$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 5;
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$links = (isset($_GET['links'])) ? $_GET['links'] : 7;
$con = ketnoi();
if (isset($_POST['submit'])) {

    $key = $_POST['keyword'];
    //$query = "select * from sanpham where (name like '%".$key."') or (name like '".$key."') or (id_sanpham=".$key.") or (brand like '".$key."')";
    $query = "select *
                        from sanpham as g join nha_cung_cap as ncc
                        on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap
                        where (ten like '% $key') or (ncc.ten_nha_cung_cap='$key') or (ten like '$key') or (ten like '$key %') or (ten like '% $key %') or (ten like '%$key%') or (id_sanpham='$key')";
    $Paginator = new Paginator($query);
    if ($Paginator->_total != 0) {
        $results = $Paginator->getData($limit, $page);
        $j = 1;
?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Hãng</th>
                    <th>Giá</th>
                    <?php if (isset($_SESSION['role_id'])) {
                        if ($_SESSION['role_id'] == '2' or $_SESSION['role_id'] == '3') { ?>
                            <th>Sửa</th>
                            <th>Xóa</th>
                    <?php }
                    } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                //while ($row = mysqli_fetch_assoc($result)) {
                for ($i = 0; $i < count($results->data); $i++) :
                ?>
                    <tr id="a1">

                        <td><?php echo $j++; ?></td>
                        <td><?php echo $results->data[$i]['ten']; ?></td>
                        <td><img src="../<?php echo $results->data[$i]["hinh1"]; ?>"></td>
                        <td><?php echo $results->data[$i]['ten_nha_cung_cap']; ?></td>
                        <td><?php echo $results->data[$i]['don_gia']; ?></td>
                        <?php if (isset($_SESSION['role_id'])) {
                            if ($_SESSION['role_id'] == '2' or $_SESSION['role_id'] == '3') { ?>
                                <td><a href="../giaodien/a.php?layout=sua&id=<?php echo $results->data[$i]['id_sanpham']; ?>">Sửa</a></td>
                                <td><a onclick="return Del('<?php echo $results->data[$i]['ten']; ?>')" href="../giaodien/a.php?layout=xoa&id=<?php echo $results->data[$i]['id_sanpham']; ?>">Xóa</a></td>
                        <?php }
                        } ?>
                    </tr>
                <?php
                //}   
                endfor;
                ?>
            </tbody>
        </table>
    <?php
        echo $Paginator->createLinks($links, 'pagination');
    } else {
        echo "<br><br><div style=\"display: flex; justify-content: center;\"><h4>Không tìm thấy kết quả!</h4></div>";
    }
} else {

    $sql = "";
    if (isset($_POST['submitfilter']) && isset($_POST['selectedbrand'])) {
        $keyfilter = $_POST['selectedbrand'];
        if (strcmp($keyfilter, "All") == 0) {
            $sql = "select *
                                from sanpham as g join nha_cung_cap as ncc
                                on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap";
        } else {
            //$query = "select * from sanpham where (ten like '%".$key."') or (ten like '".$key."') or (id_sanpham=".$key.") or (brand like '".$key."')";
            $sql = "select *
                                from sanpham as g join nha_cung_cap as ncc
                                on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap
                                where ncc.ten_nha_cung_cap='$keyfilter'";
        }
    } else {
        $sql = "select * from sanpham as g join nha_cung_cap as ncc on g.ma_nha_cung_cap = ncc.ma_nha_cung_cap";
    }
    $Paginator = new Paginator($sql);
    $results = $Paginator->getData($limit, $page);
    $j = 1;

    ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Hãng</th>
                <th>Giá</th>
                <?php if (isset($_SESSION['role_id'])) {
                    if ($_SESSION['role_id'] == '2' or $_SESSION['role_id'] == '3') { ?>
                        <th>Sửa</th>
                        <th>Xóa</th>
                <?php }
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            //while ($row = mysqli_fetch_assoc($result)) {
            for ($i = 0; $i < count($results->data); $i++) :
            ?>
                <tr id="a1">

                    <td><?php echo $j++; ?></td>
                    <td><?php echo $results->data[$i]['ten']; ?></td>
                    <td><img src="../<?php echo $results->data[$i]["hinh1"]; ?>"></td>
                    <td><?php echo $results->data[$i]['ten_nha_cung_cap']; ?></td>
                    <td><?php echo $results->data[$i]['don_gia']; ?></td>
                    <?php if (isset($_SESSION['role_id'])) {
                        if ($_SESSION['role_id'] == '2' or $_SESSION['role_id'] == '3') { ?>
                            <td><a href="../giaodien/a.php?layout=sua&id=<?php echo $results->data[$i]['id_sanpham']; ?>">Sửa</a></td>
                            <td><a onclick="return Del('<?php echo $results->data[$i]['ten']; ?>')" href="../giaodien/a.php?layout=xoa&id=<?php echo $results->data[$i]['id_sanpham']; ?>">Xóa</a></td>
                    <?php }
                    } ?>
                </tr>
            <?php
            //}   
            endfor;
            ?>
        </tbody>
    </table>
<?php
    echo $Paginator->createLinks($links, 'pagination');
}
