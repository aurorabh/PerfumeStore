<!DOCTYPE html>
<html>

<header>
    <?php include_once("header.php"); ?>
    <title>Thanh toán</title>
    <?php include_once("header1.php"); ?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <style>
        .dancach {
            margin-bottom: 2%;
        }
    </style>

</header>
<body>
<?php include_once("header2.php"); ?>
<?php include '../connection/connect_database.php';
if (isset($_SESSION['IDUser'])) {
    $sql_u = "select * from users where idUser=" . (int)$_SESSION['IDUser'];
    $query_u = mysqli_query($conn, $sql_u);
    $r_us = mysqli_fetch_array($query_u);
    $flag = true;/// đã đăng nhập
} else {
    $flag = false;
}/// chưa đăng nhập
$sql_pttt = 'select * from phuongthucgiaohang where AnHien =1';
$rs = mysqli_query($conn, $sql_pttt);
$phivc = 0;
if (isset($_POST['PTGH'])) {
    while ($r_phi = $rs->fetch_assoc()) {
        if ($r_phi['idGH'] == $_POST['PTGH'])
            $phivc = $r_phi['Phi'];
    }
}?>

<!---- Nội dung---->
<div class="indexh3 text-center">
    <?php if (isset($_SESSION['Username'])) echo "<h3>Thông tin đặt hàng</h3>"; else echo "<h3>Đặt hàng không cần đăng ký</h3>" ?>
   <div class='row' align='center'><img src="../images/thanks.gif"></div>
    <div class="sep-wrap center nz-clearfix">
        <div class="nz-separator solid"
             style="margin-top:10px; border-bottom-color:#ddd;width:40%;border-bottom-width:2px;">&nbsp;</div>
    </div>
    <div class="sep-wrap center nz-clearfix">
        <div class="nz-separator solid"
             style="margin-top:1px;margin-left:40%; border-bottom-color:#f1f1f1;width:40%;border-bottom-width:2px;">
            &nbsp;</div>
    </div>
</div>


<div class="row">
    <div class="row">
    <form action="" method="post" name="x">
        <?php if ($flag == true) { ?><!-------------Đã đăng nhập------------>
        <div class="col-md-8">
            <div class="row dancach"><b>Thông tin giao hàng</b></div>
            <div class="row dancach"><b>Tên khách hàng:<b><i><?php if ($flag == true) echo $r_us['HoTenK']; ?></i></b>
                </b></div>
            <div class="row dancach"><b>Địa chỉ:</b><b><?php if ($flag == true) echo $r_us['DiaChi']; ?></b></div>
            <div class="row dancach"><b>Điện thoại:</b><b> <?php if ($flag == true) echo $r_us['DienThoai']; ?></b>
            </div>
            <div class="row dancach"><b>Email:</b><b><?php if ($flag == true) echo $r_us['Email']; ?></b></div>
        </div>
        <?php } else { ?><!-------------Chua đang nhập------------>
        <div class="col-md-8">
            <div class="row center-block">

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-3 dancach">Họ tên người nhận:</div>
                        <div class="col-md-9 dancach"><input type="text" class="form-control" name="HoTen"></div>
                        <div class="col-md-3 dancach">Email:</div>
                        <div class="col-md-9 dancach"><input type="email" class="form-control" name="email"
                                                             placeholder="abc@gmail.com"></div>
                        <div class="col-md-3 dancach">Địa chỉ nhận hàng:</div>
                        <div class="col-md-9 dancach"><textarea class="form-control" rows="5" id="DiaChi" name="DiaChi"
                                                                placeholder="Vui lòng nhập chính xác địa chỉ nhận hàng!"></textarea>
                        </div>
                        <div class="col-md-3 dancach">Số điện thoại người nhận:</div>
                        <div class="col-md-9 dancach"><input type="tel" class="form-control" name="SDT"
                                                             placeholder="Vui lòng nhập số điện thoại"></div>
                    </div>
                </div>
                <?php } ?><!----------enđ---CHua đang nhập------------>
                <div class="col-md-8">
                    <div class="row center-block">
                        <div class="row">
                            <div class="col-md-10 dancach"><p>Chúng tôi sẽ liên hệ quý khách theo số điện thoại hoặc
                                    email này để xác nhận hoặc thông báo giao hàng</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 dancach">Chọn phương thức nhận hàng:</div>
                            <div class="col-md-4 dancach">
                                <select name="PTGH" class="check" id="PTGH">
                                    <?php

                                    while ($r = $rs->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $r['idGH']; ?>"
                                                selected='selected'><?php echo $r['TenGH'] . '-' . $r['Phi'] . 'VNĐ'; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input type="submit" class="form-control col-md-2" value="Đặt hàng" name="OK"></div>
            </div>

    </form>
</div>

<!----------------------------------------------------->
<div class="row"
">
<div class="col-md-4" style="background-color: #f5f3f1;">
    <div class="row dancach"><h4><b>Thông tin đơn hàng</b></h4></div>
    <div class="row dancach" style="border: dashed; background-color: #effdff; border-color: #3ea2b2;"></div>
    <div class="row dancach">
        <div class="col-md-5"><b>Sản phẩm</b></div>
        <div class="col-md-2"><b>Số lượng</b></div>
        <div class="col-md-5"><b>Giá</b></div>
    </div>
    <div class="row dancach" style="border: dashed; background-color: #effdff; border-color: #3ea2b2;"></div>
    <?php $tongtien = 0; ?>
    <?php if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $list) {
            $tongtien += (int)$list['qty'] * $list['GiaBan']; ?>
            <div class="row dancach">
                <div class="col-md-6"><b><?php echo $list['TenSP']; ?></b></div>
                <div class="col-md-2"><b><?php echo $list['qty']; ?></b></div>
                <div class="col-md-4"><b><?php echo number_format($list['GiaBan'], 0); ?></b></div>
            </div>
            <div class="row dancach" style="border: groove; border-color: #3ea2b2;"></div>
        <?php }
    } ?>

    <div class="row dancach">
        <div class="col-md-7">PHÍ VẬN CHUYỂN (tạm tính):</div>
        <div class="col-md-5" style=" text-align: right;">
            <h4><b style="color: red;">
                    Miễn phí        
                </b>
            </h4>
        </div>
    </div>
    <div class="row dancach" style="border: dashed; background-color: #effdff; border-color: #3ea2b2;"></div>
    <div class="row dancach">
        <div class="col-md-5"><h4><b style="color: red;">TỔNG TIỀN:</b></h4></div>
        <div class="col-md-7" style=" text-align: right;"><h4><b
                        style="color: red;"><?php echo number_format($tongtien, 0) . '' . 'VNĐ' ?></b></h4></div>
    </div>
</div>
<?php

$sl_donhang = "select  idDH  from donhang ORDER By  idDH DESC ";
$rs_donhang = mysqli_query($conn, $sl_donhang);
$sodh = 0;
$date = date('Y-m-d H:m:s');
while ($rsodh = $rs_donhang->fetch_assoc()) {
    $sodh = $rsodh['idDH'];
    break;
}
$sodh = (int)$sodh + 1;
if ($flag != true && isset($_SESSION['cart'])) {
    if (isset($_POST['OK']) && isset($_POST['HoTen']) && isset($_POST['email']) && isset($_POST['DiaChi']) && isset($_POST['SDT'])) {
        $sql_dh1 = "insert into donhang values (" . $sodh . ",0,'" . $date . "','" . $_POST['HoTen'] . "','" . $_POST['DiaChi'] . "'," . $_POST['SDT'] . ",0," . $_POST['PTGH'] . ",0,0,'" . $_POST['email'] . "')";
        $rs_dh1 = mysqli_query($conn, $sql_dh1);
        if (!$rs_dh1) {

            echo "<script language='JavaScript'> alert('Thêm  không thành công1!');</script>";

        } else {
            foreach ($_SESSION['cart'] as $pro) {
                $sql_ctdh = "INSERT INTO donhangchitiet(idDH, idSP, TenSP, SoLuong, Gia) VALUES (" . $sodh . "," . $pro['idSP'] . ",N'" . $pro['TenSP'] . "'," . $pro['qty'] . "," . $pro['GiaBan'] . ")";
                $rs_ctdh = mysqli_query($conn, $sql_ctdh);
                $sql_sanpham = "UPDATE sanpham SET SoLuongTonKho = SoLuongTonKho - " . (int)$pro['qty'] . " WHERE idSP = " . $pro['idSP'];
                $rs_sanpham = mysqli_query($conn, $sql_sanpham);
                if (!$rs_ctdh) {
                    echo "<script language='JavaScript'> alert('Thêm  không thành công2!');</script>";
                } else {
                    echo "<script language='JavaScript'> alert('Đơn hàng của bạn đã được ghi nhận');";
                    unset($_SESSION['cart']);
                    echo " location.href='../site/index.php?index=1';</script>";
                }
            }


        }


    }
} else {

    if (isset($_POST['OK']) && isset($_SESSION['cart'])) {
        $sql_dh2 = "insert into donhang VALUES (" . $sodh . "," . $_SESSION['IDUser'] . ",'" . $date . "',N'" . $_SESSION['HoTenK'] . "',N'" . $_SESSION['DC'] . "',
                 " . $_SESSION['SDT'] . ",0," . $_POST['PTGH'] . ",0,0,'" . $_SESSION['Email'] . "'
                 ) ";
        $rs_dh2 = mysqli_query($conn, $sql_dh2);
        if (!$rs_dh2) {
            echo "<script language='JavaScript'> alert('Thêm  không thành công3!');</script>";
        } else {
            foreach ($_SESSION['cart'] as $pro) {
                $sql_ctdh = "INSERT INTO donhangchitiet(idDH, idSP, TenSP, SoLuong, Gia) VALUES (" . $sodh . "," . $pro['idSP'] . ",N'" . $pro['TenSP'] . "'," . $pro['qty'] . "," . $pro['GiaBan'] . ")";
                $rs_ctdh = mysqli_query($conn, $sql_ctdh);
                $sql_sanpham = "UPDATE sanpham SET SoLuongTonKho = SoLuongTonKho - " . (int)$pro['qty'] . " WHERE idSP = " . $pro['idSP'];
                $rs_sanpham = mysqli_query($conn, $sql_sanpham);
                if (!$rs_ctdh) {
                    echo "<script language='JavaScript'> alert('Thêm  không thành công4!');</script>";
                } else {
                    echo "<script language='JavaScript'> alert('Đơn hàng của bạn đã được ghi nhận');";
                    unset($_SESSION['cart']);
                    echo " location.href='../site/index.php?index=1';</script>";
                }

            }


        }
    }
}
?>
<?php include_once("footer.php"); ?>

</body>
</html>