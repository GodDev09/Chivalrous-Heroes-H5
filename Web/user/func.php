<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include "db.php";
$query = $conn->query("SELECT * FROM gc_info");
$rs = mysqli_fetch_array($query);
$title = $rs['title'];
$page = $rs['page'];
$background = $rs['background'];
$khuyenmai = $rs['khuyenmai'];
$banks = $rs['atmbank'];
$bank = explode(";",$banks);
$mom = $rs['momo'];
$momo = explode(";",$mom);
$keyapi = $rs['keyapi'];
$urlgame = explode("|",$rs['urlgame']);
$usck = $conn->query("SELECT * FROM account WHERE username = '".$_SESSION['username']."'");
$if = mysqli_fetch_array($usck);
$userif = $if['username'];
$token = $if['token'];
$signkey = md5("hgavnh".$if['password'].$token);
$xu = $if['xu'];
$email = $if['email'];
$time = date("d-m-Y");
$danhsachcode = $conn->query("SELECT * FROM gc_code")->fetch_assoc()['code'];
$starttime = $rs['starttime'];
$endtime = $rs['endtime'];
if($rs['acttask'] == 1 || $rs['acttask'] == "1")
{
	$start = date('d-m-Y',strtotime($starttime));
	$end = date('d-m-Y',strtotime($endtime));
	$xunap = $conn->query("SELECT SUM(menhgia) AS DIEM FROM gc_lognap WHERE user = '$userif' AND date >= '".$start."' AND date <= '".$end."' AND status = '1'")->fetch_assoc()['DIEM'];
}
else
{
	$xunap = $conn->query("SELECT SUM(menhgia) AS DIEM FROM gc_lognap WHERE user = '$userif' AND date = '".$time."' AND status = '1'")->fetch_assoc()['DIEM'];
}
$slitem = $conn->query("SELECT * FROM gc_webshop");
$number = mysqli_num_rows($slitem);
?>