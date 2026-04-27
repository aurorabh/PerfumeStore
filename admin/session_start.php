<?php


session_start();
ob_start();
if(!isset($_SESSION['Username'])||$_SESSION['Username']!='admin') {
    header('location: ../site/DangNhap.php');
}
