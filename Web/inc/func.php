<?php
$ip = $conn->query("SELECT * FROM gc_info");
$rs = mysqli_fetch_array($ip);
$title = $rs['title'];
$link = $rs['urlgame'];
$down = explode("|",$link);
$page = $rs['page'];
$ytb = $rs['ytb'];
$url = $rs['url'];
$background = $rs['background'];
$des = $rs['des'];
$hide = $rs['hide'];
$app_id = $rs['app_id'];
$danhsachcode = $conn->query("SELECT * FROM gc_code")->fetch_assoc()['code'];
$summenu = $conn->query("SELECT * FROM gc_menu");
?>