<?php
include_once('../connection/connect_database.php');
$sl_donhang = "select * from donhang order by idDH desc";
$rs_donhang = mysqli_query($conn, $sl_donhang);
if (!$rs_donhang)
    echo "Không thể truy vấn CSDL"; ?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Quản lý đơn hàng </title>
    <?php include_once('header2.php'); ?>
</header>
<body>

<!--Content Start Here -->
<h3 style="text-align: center; margin-top: -40px">ĐƠN HÀNG CỦA TÔI</h3>
<div class="main" style="margin-left:10%; margin-right:10%; height:380px">
<div style="overflow-x: scroll">
    <table class=" table table-bordered hover" style="overflow-x: scroll" border="2">
        <thead class="text-center">
        <tr>
            <td width=""><strong>MĐH</strong></td>
            <td width=""><strong>THỜI GIAN ĐẶT</strong></td>
            <td width=""><strong>TỔNG TIỀN</strong></td>
            <td width=""><strong>TÌNH TRẠNG</strong></td>
            <td width=""><strong>THAO TÁC</strong></td>
        </tr>
        </thead>
        <?php
        if (isset($_SESSION['IDUser'])) {
            $sql_u = "select * from donhang where idUser=" . (int)$_SESSION['IDUser'];
            $query_u = mysqli_query($conn, $sql_u);
            //$r_us = mysqli_fetch_array($query_u);
            $flag = true;/// đã đăng nhập
        }
        while ($r = $query_u->fetch_assoc()) { 
            ?>
            <tbody>         
            <td width=""><strong><?php echo $r['idDH']; ?><strong></td>
            <td width=""><strong><?php echo $r['ThoiDiemDatHang']; ?> </strong></td>
            <td width=""><strong><?php
                    $sl_sp_ctdh="select sum(SoLuong*Gia) as TongTien from sanpham a, donhangchitiet b where a.idSP=b.idSP and idDH=".$r['idDH'];
                    $rs_tt=mysqli_query($conn,$sl_sp_ctdh);
                    $d=mysqli_fetch_array($rs_tt);
                    echo $d['TongTien'];
                    ?> </strong></td>
            <?php
                if($r['DaXuLy']=='0'){
                ?>
                <td><strong><?php echo 'Chờ xác nhận';?></strong></td>
                <?php
                    }elseif($r['DaXuLy']=='1'){
                ?>
                <td><a href="xuly.php?idDH=<?php echo $r['idDH'];?>"><strong> Đang giao/ Đã nhận được hàng </strong></a></td>
                <?php
                    }elseif($r['DaXuLy']=='2'){
                ?>
                    <td><strong><?php echo 'Đã nhận'; ?></strong></td>
                <?php
                    }elseif($r['DaXuLy']=='3'){
                        ?>
                        <td><strong><?php echo 'Đã nhận'; ?></strong></td>
                    <?php
                    }elseif($r['DaXuLy']=='4'){?>
                <td><strong style="color: firebrick"><?php echo 'Đã hủy'; ?></strong></td> <?php
                }else echo "";?>
            <?php
            if($r['DaXuLy']=='0' || $r['DaXuLy']=='1' || $r['DaXuLy']=='2'){
                ?>
                <td><a href="yeucau_huydon.php?idDH=<?php echo $r['idDH'];?>"><strong> Hủy đơn </strong></a></td>
                <!-- <td><strong><a href="yeucau_huydon.php" id="binhluan" name="binhluan"  class="btn btn-info">HỦY ĐƠN</a></strong></td> -->
                <?php
                    }elseif($r['DaXuLy']=='3'){
                ?>
                <td><strong> Đang yêu cầu... </strong></td>
                <!-- <td><strong><a class="btn btn-info" disabled>HỦY ĐƠN</a></strong></td> -->
                <?php
                    }elseif($r['DaXuLy']=='4'){?>
                <td><strong><?php echo 'Đã hủy'; ?></strong></td> <?php
                }else echo "";?>
            </tbody>
        <?php } ?>
    </table>
</div>
<h3 style="margin-right: 10%"><strong style="color: firebrick">Đơn hàng đã nhận vui lòng không hủy đơn !</strong></h2>
</div>


<?php include_once('footer.php'); ?>
</body>
</html>
<!-- -0: chờ xác nhận -1:đang giao/đã nhận được hàng -2:đã nhận -3:đang yêu cầu -4:đã hủy -->
