<?php

$conn = mysqli_connect('localhost', 'root', '', 'perfumeshopdb')
or die ('Không thể kết nối tới database');
$conn->set_charset("utf8");
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

