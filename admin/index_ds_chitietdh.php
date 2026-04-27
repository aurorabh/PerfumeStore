<?php
include_once('../connection/connect_database.php');
$sl_ctdonhang = "select * from donhangchitiet where idDH =" . $_GET['idDH'];
$rs_ctdonhang = mysqli_query($conn, $sl_ctdonhang);
if (!$rs_ctdonhang)
    echo "Không thể truy vấn CSDL"; ?>
<?php
    if(isset($_POST['capnhatdonhang'])){
        $xuly = $_POST['xuly'];
        $mahang = $_POST['mahang_xuly'];
        $sql_update_donhang = mysqli_query($conn, "UPDATE donhang SET DaXuLy='$xuly' WHERE idDH='$mahang'");
        $sql_update_donhangchitiet = mysqli_query($conn, "UPDATE donhangchitiet SET DaXuLy='$xuly' WHERE idDH='$mahang'");
        $sql_chitietdh= mysqli_query($conn, "SELECT * FROM `donhangchitiet` WHERE idDH='$mahang'");
        while($row = mysqli_fetch_array($sql_chitietdh)){
            $soluong=$row['SoLuong'];
            $idSP=$row['idSP'];
            if($xuly==1){
                mysqli_query($conn, "UPDATE sanpham SET SoLuongTonKho=SoLuongTonKho-'$soluong' WHERE idSP='$idSP' and SoLuongTonKho>='$soluong'");
            }elseif($xuly==4){
                mysqli_query($conn, "UPDATE sanpham SET SoLuongTonKho=SoLuongTonKho+'$soluong' WHERE idSP='$idSP'");
            }
        }
    }
?>
<!--  -->
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Chi tiết đơn hàng </title>
    <?php include_once('header2.php'); ?>
</header>
<body>
<?php include_once('header3.php'); ?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">CHI TIẾT ĐƠN HÀNG</h3>
<form method="post" action="" name="ChiTietSP" enctype="multipart/form-data">
    <div style="overflow-x: scroll">
        <table class=" table table-bordered hover" style="overflow-x: scroll" border="2">
            <thead class="text-center">
            <tr>
                <td width=""><strong> ID ĐƠN HÀNG</strong></td>
                <td width=""><strong> ID SẢN PHẨM </strong></td>
                <td width=""><strong> TÊN SẢN PHẨM</strong></td>
                <td width=""><strong> SỐ LƯỢNG </strong></td>
                <td width=""><strong> TÌNH TRẠNG </strong></td>
                <td width=""><strong> GIÁ</strong></td>
                <td width=""><strong> GIẢM GIÁ</strong></td>
                <td width=""><strong> THÀNH TIỀN</strong></td>
            </tr>
            </thead>
            <?php $tong = 0;
            while ($r = $rs_ctdonhang->fetch_assoc()) { ?>
                <tbody>
                    <td width=""><strong> <?php echo $r['idDH']; ?> </strong></td>
                    <td width=""><strong><?php echo $r['idSP']; ?> </strong></td>
                    <td width=""><strong><?php echo $r['TenSP']; ?> </strong></td>
                    <td width=""><strong><?php echo $r['SoLuong']; ?> </strong></td>
                    <td width=""><strong>
                    <?php if($r['DaXuLy'] ==1 ) echo "Đã xử lý"; 
                        if($r['DaXuLy'] ==0) echo "Chưa xử lý"; 
                        if($r['DaXuLy'] ==2) echo "Đã giao"; 
                        if($r['DaXuLy'] ==3) echo "Yêu cầu hủy"; 
                        if($r['DaXuLy'] ==4) echo "Bị hủy"; ?>
                    <td width=""><strong><?php echo $r['Gia']; ?> </strong></td>
                    <td width=""><strong><?php echo $r['GiaKhuyenMai']; ?> </strong></td>
                    <td width=""><strong><?php echo $tong += $r['Gia'] * $r['SoLuong'] - $r['GiaKhuyenMai']; ?> </strong></td>
                    <input type="hidden" name="mahang_xuly" value="<?php echo $r['idDH'] ?>">
                </tbody>
            <?php } ?>
        </table>
        
    </div>
    <div class="row">
        <div class="col-lg-offset-3" style="margin-left:75%"><h2>Tổng tiền: <strong><?php echo $tong; ?> </strong></h2></div>
    </div>
    
    <table>
        <tr>
            <td width="150px">
                <select class="form-control" name="xuly">
                    <option value="">--Chọn--</option>
                    <option value="1" width="50px">Đã xử lý</option>
                    <option value="4" width="50px">Hủy đơn</option>
                </select> 
            </td>
            <td>
                <input type="submit" value="Xác nhận đơn hàng" name="capnhatdonhang" id="capnhatdonhang" class="btn btn-info" style="margin:15px">
                
            </td>
            <td>
                <input type="submit" name="trove" value="Trở về" onclick="getConfirmation()">
            </td>
        </tr>
    </table>
</form>
<?php
    if(isset($_POST['trove']))
    {
        echo "<script type=\"text/javascript\">
        
                location.href='index_donhang.php';
        </script>";
    }
?>

<?php include_once('footer.php'); ?>

</body>
</html>
