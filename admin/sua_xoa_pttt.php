<?php

include_once ('../connection/connect_database.php');
$sl = "select * from phuongthucthanhtoan where idPTTT='".$_GET['idPTTT']."'";
$kq = mysqli_query($conn,$sl);

$r_gh=mysqli_fetch_array($kq);
if(isset($_POST['xoa']))// thao tác xóa
{if (! $kq) {
    echo "<script language='javascript'>alert('Lỗi truy vấn!');";
    echo "location.href='index_pttt.php';</script>";
}

    $sl = "delete from phuongthucthanhtoan where idPTTT=". $_GET['idPTTT'];
    $kq = mysqli_query($conn, $sl);
    if($kq)
    {
        echo "<script language='javascript'>alert('Xóa thành công!');";
        echo "location.href='index_pttt.php';</script>";
    }
    else
        echo "<script language='javascript'>alert('Xóa không thành công!');";
}
if(isset($_POST['sua']))/// thao tác sửa
{
    if(isset($_POST['TenPhuongThucTT']))
    {
        $check = false; // biến kiểm tra trùng tên
        $sql_gh = "select TenPhuongThucTT from phuongthucthanhtoan WHERE idPTTT <>".$_GET['idPTTT'];
        $kq = mysqli_query($conn,$sql_gh);
        while ($r = $kq->fetch_assoc())
        {
            if($r['TenPhuongThucTT'] == $_POST['TenPhuongThucTT'])
            {
                $check = true;// trùng tên
            }
        }
        if($check == false)
        {
            $query = "UPDATE phuongthucthanhtoan SET TenPhuongThucTT ='". $_POST["TenPhuongThucTT"]."',GhiChu='".$_POST["GhiChu"]."',AnHien=".$_POST["AnHien"]." WHERE idPTTT=".$_GET['idPTTT'];

            $result_gh = mysqli_query($conn, $query);
            if (! $result_gh) {
                echo "<script language='javascript'>alert('Cập nhật không thành công!');";}
            else
            {
                echo "<script language='javascript'>alert('Cập nhật thành công!');";
                echo "location.href='index_pttt.php';</script>";
            }
        }
        else
        {
            echo "<script language='javascript'>alert('Trùng tên Thanh toán!');</script>";

        }

    }
}
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Sửa Thanh toán</title>
    <?php include_once('header2.php');?>
    <style> div.row{ padding-top: 2%;}</style>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">SỬA THANH TOÁN </h3>
<form  method="post" action="" name="SuaGH" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên Thanh toán</strong></div>
        <div class="col-md-9"> <input type="text" name="TenPhuongThucTT" value="<?php  echo $r_gh['TenPhuongThucTT']?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ghi chú</strong></div>
        <div class="col-md-9"><input type="text" name="GhiChu" value="<?php echo $r_gh['GhiChu'] ?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <option value="1"> <strong>1</strong></option>
                <option value="0"> <strong>0</strong></option>
            </select>
        </div>
    </div>

    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input name="sua" type="submit" value="Sửa" />
            <input name="xoa" type="submit" value="Xóa" /> 
            <input type="button" name="trove" value="Trở về" onclick="getConfirmation()";>
        </div>
    </div>

    <script type="text/javascript">
        function getConfirmation()
        {
            var retVal = confirm("Bạn có muốn hủy bỏ thao tác không?");
            if( retVal == true ){
                location.href = 'index_pttt.php'
            }
        }
    </script>


    <?php include_once ('footer.php');?>
</body>
</html>

