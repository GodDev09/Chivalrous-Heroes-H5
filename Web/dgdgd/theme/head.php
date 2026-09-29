<?php
//error_reporting(0);
include "inc/func.php";
$time = date('Y-m-d');
$tongacc = $conn->query("SELECT COUNT(id) AS TONGACC FROM account")->fetch_assoc()['TONGACC'];
$tongpost = $conn->query("SELECT COUNT(id) AS TONGBV FROM gc_post")->fetch_assoc()['TONGBV'];
$tongsv = $conn->query("SELECT COUNT(id) AS TONGSV FROM gc_server")->fetch_assoc()['TONGSV'];
$tongnap = mysqli_query($conn,"SELECT SUM(menhgia) AS GIA FROM gc_lognap WHERE gia = '0'")->fetch_assoc()['GIA'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<title><?=$title;?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?=$url;?>/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?=$url;?>/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?=$url;?>/css/uniform.css" />
<link rel="stylesheet" href="<?=$url;?>/css/select2.css" />
<link rel="stylesheet" href="<?=$url;?>/css/maruti-style.css" />
<link rel="stylesheet" href="<?=$url;?>/css/maruti-media.css" class="skin-color" />
<script src="<?=$url;?>/js/jquery.min.js"></script> 
<script src="<?=$url;?>/js/sweetalert2.all.js"></script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><?=$title;?></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="" ><a title="" href="<?=$url;?>/admin-edit-<?=$_SESSION['useradmin'];?>.hga"><i class="icon icon-user"></i> <span class="text">Thông tin</span></a></li>
    <li class=""><a title="" href="<?=$url;?>/option"><i class="icon icon-cog"></i> <span class="text">Cài đặt</span></a></li>
    <li class=""><a title="" href="<?=$url;?>/thoat"><i class="icon icon-share-alt"></i> <span class="text">Thoát</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Quản lý chung</a><ul>
    <li class="active"><a href="<?=$url;?>/"><i class="icon icon-home"></i> <span>Trang chủ</span></a> </li>
	<li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>Quản lý tài khoản</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?=$url;?>/tai-khoan">Danh sách tài khoản</a></li>
        <li><a href="<?=$url;?>/admin">Tài khoản Admin</a></li>
        <li><a href="<?=$url;?>/add-admin.hga">Thêm Admin</a></li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Doanh thu</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?=$url;?>/doanh-thu">Thẻ nạp</a></li>
        <li><a href="<?=$url;?>/logxu">Log đổi xu</a></li>
        <li><a href="<?=$url;?>/logcongxu">Log cộng xu</a></li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-shopping-cart"></i> <span>Tích nạp</span> <span class="label label-important">2</span></a>
      <ul>
                <li><a href="<?=$url;?>/shop">Chỉnh sửa gói</a></li>
                <li><a href="<?=$url;?>/reward">Kiểm tra phần thưởng</a></li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>MENU GAME</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="<?=$url;?>/menu">Danh sách MENU</a></li>
        <li><a href="<?=$url;?>/addmenu">Thêm MENU</a></li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-plus"></i> <span>Tính năng</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?=$url;?>/addxu">Cộng Xu</a></li>
        <li><a href="<?=$url;?>/addpoint">Cộng điểm nạp MOMO</a></li>
        <li><a href="<?=$url;?>/check">Kiểm tra tài khoản</a></li>
      </ul>
    </li>	
	<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Bài viết</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="<?=$url;?>/bai-viet">Danh sách bài viết</a></li>
        <li><a href="<?=$url;?>/post">Đăng bài mới</a></li>
      </ul>
    </li>
	
	<li class="submenu"> <a href="#"><i class="icon icon-gift"></i> <span>Giftcode</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="<?=$url;?>/giftcode">Tạo Giftcode</a></li>
        <li><a href="<?=$url;?>/codephat">Code đang phát</a></li>
        <li><a href="<?=$url;?>/list-code">Danh sách mã CODE</a></li>
        <li><a href="<?=$url;?>/list-item">Danh sách Item</a></li>
      </ul>
    </li>

	<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Quản lý máy Chủ</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="<?=$url;?>/server">Danh sách máy chủ</a></li>
        <li><a href="<?=$url;?>/addsrv">Thêm máy chủ</a></li>
      </ul>
    </li>
    <li><a href="<?=$url;?>/option"><i class="icon icon-pencil"></i> <span>Cấu hình hệ thống</span></a></li>
  </ul>
</div>