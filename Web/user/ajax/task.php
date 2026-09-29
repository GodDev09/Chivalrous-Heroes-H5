<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include "db.php";
//server=1&pack=1&packID=1
$dbs = $conn->query("SELECT * FROM gc_server WHERE id = '".$_POST['server']."' LIMIT 1")->fetch_assoc()['db'];
$db = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","{$dbs}") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($db,"UTF8");
$server = $_POST['server'];
$roleid = $_POST['roleid'];
$user = $_SESSION['username'];
$pack = isset($_POST['pack'])?(string)(int)$_POST['pack']:false;
$time = date("d-m-Y");
$times = time();
$date = date("d-m-Y H:i:s");
$chklog = $conn->query("SELECT * FROM gc_mocqualog WHERE user = '{$user}' AND logid = '{$pack}' AND date ='{$time}'");
$rs = mysqli_fetch_array($chklog);
$qrmoc = $conn->query("SELECT * FROM gc_mocqua WHERE id = '".$pack."'");
$xl = mysqli_fetch_array($qrmoc);
$item = explode(";",$xl['soluong']);
$query = $conn->query("SELECT * FROM gc_info");
$tm = mysqli_fetch_array($query);
$starttime = $tm['starttime'];
$endtime = $tm['endtime'];
if($tm['acttask'] == 1)
{
	$start = date('d-m-Y',strtotime($starttime));
	$end = date('d-m-Y',strtotime($endtime));
	$xunap = $conn->query("SELECT SUM(menhgia) AS DIEM FROM gc_lognap WHERE user = '".$_SESSION['username']."' AND date >= '".$start."' AND date <= '".$end."' AND status = '1'")->fetch_assoc()['DIEM'];
}
else
{
	$xunap = $conn->query("SELECT SUM(menhgia) AS DIEM FROM gc_lognap WHERE user = '".$_SESSION['username']."' AND date = '".$time."' AND status = '1'")->fetch_assoc()['DIEM'];
}
if($server != "" & $user != "" && $pack != "")
{
	if(strtotime($date) > strtotime($tm['endtime']) && $tm['acttask'] == 1)
	{
		exit("Sự kiện tích nạp đã kết thúc");
	}
	if($rs['logid'] == $pack && $rs['status'] == 1)
	{
		exit("Bạn đã nhận thưởng mốc này rồi");
	}
	if($rs['logid'] != $pack && $xunap < $xl['diem'])
	{
		exit("Gói bạn chọn không có hoặc chưa đủ điểm");
	}
	if($xl['id'] == $pack && $rs['status'] != 1 && $xunap >= $xl['diem'])
	{
			$url = "http://127.0.0.1:8080/task/?playerId=".$roleid."&user=".$user."&pack=".$pack;
			$html = file_get_contents($url);
			echo $html;
	}
	else
	{
			echo "Ý bạn đang làm gì đó lỗi kìa ^^!";
	}
}
else
{
	echo "Nhận quà thất bại";
}

?>