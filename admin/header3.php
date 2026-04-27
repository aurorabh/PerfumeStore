<!-- Tổng doanh thu -->
<?php
$tong1 = 0;
$conn = mysqli_connect('localhost', 'root', '', 'perfumeshopdb')
or die ('Không thể kết nối tới database');
$conn->set_charset("utf8");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$sl_tk = "select * from donhang where DaXuLy>0 and DaXuLy<4";
$rs_tk = mysqli_query($conn, $sl_tk);
$tong=0; $soluong=0;
while ($r = $rs_tk->fetch_assoc()) { 
?>
    <?php
    $sl_ctdh="select sum(SoLuong*Gia) as TongTien from sanpham a, donhangchitiet b where a.idSP=b.idSP and idDH=".$r['idDH'];
    $rs=mysqli_query($conn,$sl_ctdh);
    $d=mysqli_fetch_array($rs);
    $sl_sl="select count(SoLuong) as DemSL from sanpham a, donhangchitiet b where a.idSP=b.idSP and idDH=".$r['idDH'];
    $rs_sl=mysqli_query($conn,$sl_sl);
    $c=mysqli_fetch_array($rs_sl);
    ?> 
        <?php  $tong+=$d['TongTien']; 
        $tong1 = number_format($tong);
        $soluong +=$c['DemSL'];?> 
<?php }?>


<?php


echo "
<div class=\"page-container list-menu-view\">

    <!--Leftbar Start Here -->
    <div class=\"left-aside\">
        <div class=\"aside-branding\" style='background-color: whitesmoke; '>
            <a href=\"../admin/index.php\" class=\"logo\" title=\"Home\"><img
                    src=\"../images/logo_ad.png\" alt=\"Home\"
                    class=\"img-responsive hidden-md\" style='margin-bottom: 50px;'></a>
        </div>
        <div id=\"ps_container\" class=\"ps-container ps-theme-default\" data-ps-id=\"\">
            <div class=\"left-navigation\">
                <ul class=\"list-accordion\">
                    <li class=\"mobile-userNav\"></li>
                    
                     <li>
                        <a href=\"../admin/index_ds_sp.php\"><span class=\"nav-icon\" <span class=\"nav-label\"> SẢN PHẨM</span></a>
                    </li>
                    <li>
                        <a href=\"../admin/index_donhang.php\"> ĐƠN HÀNG</a>
                    </li>
                    <li class=\"dcjq-parent-li\">
                        <a href=\"../admin/index_ds_loaisp.php\" class=\"dcjq-parent\">LOẠI SẢN PHẨM </span></span></a>
                        <ul style=\"display: none;\">
                            <li>
                                <a href=\"/\"> <span class=\"glyphicon glyphicon-signal\"></span> Clients Statistics</a>
                            </li>
                            <li>
                                <a href=\"\"> <span class=\"glyphicon glyphicon-asterisk\"></span> Commissions</a>
                            </li>
                            <li>
                                <a href=\"\"> <span class=\"glyphicon glyphicon-list\"></span> My Clients</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href=\"../admin/index_nh.php\"> <span class=\"nav-label\"> NHÃN HIỆU </span></a>
                    </li>
                   
                    <li>
                        <a href=\"../admin/index_sp_comment.php\"><span class=\"nav-label\"> SẢN PHẨM COMMENT</span></a>
                    </li>
                    <li>
                        <a href=\"../admin/baiviet.php\"><span class=\"nav-icon\">BÀI VIẾT </span></a>
                    </li>
                     <li>
                        <a href=\"../admin/index_user.php\"><span class=\"nav-icon\"> TÀI KHOẢN ND </span></a>
                    </li>
                    <li>
                        <a href=\"../admin/index_ptgh.php\"><span class=\"nav-icon\"> PHƯƠNG THỨC GH</span></a>
                    </li>
                    <li>
                        <a href=\"../admin/KhuyenMai.php\"><span class=\"nav-icon\"> KHUYẾN MÃI</span></a>
                    </li>
                    <li>
                        <a href=\"../admin/index_pttt.php\"><span class=\"nav-icon\"> PHƯƠNG THỨC TT</span></a>
                    </li>
                </ul>
            </div>
            <div class=\"ps-scrollbar-x-rail\" style=\"left: 0px; bottom: 0px;\">
                <div class=\"ps-scrollbar-x\" tabindex=\"0\" style=\"left: 0px; width: 0px;\"></div>
            </div>
            <div class=\"ps-scrollbar-y-rail\" style=\"top: 0px; right: 0px;\">
                <div class=\"ps-scrollbar-y\" tabindex=\"0\" style=\"top: 0px; height: 0px;\"></div>
            </div>
        </div>
    </div>

                <div class=\"page-content\">
                    <!--Topbar Start Here -->
                                        <header class=\"top-bar\">
                                            <div class=\"container-fluid top-nav\">
                                                <div class=\"row\">
                                                    <div class=\"col-md-5 col-sm-1 col-xs-2 user-name-main-block\">
                                                    <div>
                                                        <h2 style=\"color:orange\"><marquee direction=\"left\">TỔNG DOANH THU: <strong> $tong1 VNĐ</strong> & đã bán <strong>$soluong</strong> sản phẩm</marquee></h2>
                                                    </div>

                                                        <div class=\"clearfix top-bar-action hidden-md hidden-lg\">
                                                            <span class=\"leftbar-action desktop\"><span class=\"glyphicon glyphicon-chevron-left\"></span></span>
                                                        </div>


                                                    </div>
                                                    <div class=\"col-sm-3 col-xs-8 hidden-md hidden-lg text-center logo-block\">
                                                        <a href=\"\" class=\"logo\" title=\"Home\"><img
                                                                src=\"../images/logo-mob.png\" width=\"185\"
                                                                alt=\"Home\" class=\"img-responsive\"></a>
                                                    </div>
                                                    <div class=\"col-md-7 col-sm-8 col-xs-12 responsive-fix\">
                                                        <div class=\"top-aside-right\">
                                                            <button type=\"button\" class=\"btn-navbar-toggle collapsed visible-xs-block\"
                                                                    data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\"
                                                                    aria-controls=\"navbar\" data-original-title=\"\" title=\"\">
                                                                <span class=\"glyphicon glyphicon-chevron-right\"></span>
                                                            </button>
                                                            <div id=\"navbar\" class=\"user-nav navbar-collapse collapse\">
                                                                <ul>
                                                                   
                                                                    <li><a href=\"\" target=\"_blank\">perpumestore.com</a></li>
                                                                    
                                                                    <li class=\"dropdown\">
                                                                        <a data-toggle=\"dropdown\" href=\"\"
                                                                           class=\"clearfix dropdown-toggle\">
                                                                            Tiếng Việt <span class=\"caret\"></span>
                                                                        </a>
                                                                        <ul role=\"menu\" class=\"dropdown-menu fadeInUp\">
                                                                            <li><a href=\"\">Tiếng Việt</a></li>
                                                                            <li><a href=\"\">English</a></li>
                                                                        </ul>
                                                                    </li>
                                                                    <li><a href=\"../site/index.php?index=1\"> Home page</a></li>
                                                                    <li><a href=\"../site/DangXuat.php\"> Log out</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </header>
                                        
                    <!--Content Start Here -->
                                            <div class=\"main-container\">
                                                <div class=\"container-fluid\">
                                                    <div class=\"row\">

                                                        <div class=\"col-md-12\">

";

