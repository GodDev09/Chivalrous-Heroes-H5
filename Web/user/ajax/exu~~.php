<?php
include "db.php";
$user = $_SESSION['username'];
$sid = "xntg".$_POST['server'];
$xu = $_POST['xu'];
$x = explode("|",$xu);
//Check UID
$xuuser = $conn->query("SELECT * FROM gc_user WHERE user = '$user'")->fetch_assoc()['xu'];
//Check Shop
$shop = $conn->query("SELECT * FROM gc_shop WHERE id = '{$x[0]}'");
$xl = mysqli_fetch_array($shop);
$xutru = $xl['xu'];
$time = time();
$timedoi = date('d-m-Y H:i:s');
$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
if($xu == "")
{
	$json['status'] = false;
	$json['msg'] = "Vui lòng chọn mệnh giá đổi";
	exit(json_encode($json));
}
if($x[0] != $xl['id'])
{
	$json['status'] = false;
	$json['msg'] = "Mã ID này không tồn tại";
	exit(json_encode($json));
}
if($xuuser < 0 || $xuuser < $xutru)
{
	$json['status'] = false;
	$json['msg'] = "Số XU của bạn không đủ";
	exit(json_encode($json));
}
if ($x[0] == $xl['id'] && $xuuser > $xutru) {
	//Đổi xu
	@$uplog = $conn->query("INSERT INTO gc_logxu(user,xutru,createTime) VALUES ('".$user."','".$xutru."','".$timedoi."')");
	@$up = $conn->query("UPDATE gc_user SET xu = xu - '{$xutru}' WHERE user = '{$user}'");
	if($up && $uplog)
	{
		$oid = time();
		$goodsid = $xl['data'];
		$date = date('Y-m-d H:i:s');
		$name = $conn->query("SELECT * FROM $sid.players WHERE account = '$user'")->fetch_assoc()['name'];
		$roleid = $conn->query("SELECT * FROM $sid.players WHERE account = '$user'")->fetch_assoc()['dbid'];
		$serverid = $conn->query("SELECT * FROM $sid.players WHERE account = '$user'")->fetch_assoc()['serverid'];
		
		$query1 = $conn->prepare("insert into $sid.`pay` (`dbid`,`playerid`,`serverid`,`goodsid`) values (?,?,?,?)");
		$query1->bind_param('ssss', $oid, $roleid, $serverid, $goodsid);
		$query1->execute();
		$json['status'] = true;
		$json['msg'] = "Đổi xu thành công";
		exit(json_encode($json));
		
	}
}
else
{
	$json['status'] = false;
	$json['msg'] = "Đổi XU thất bại";
}
exit(json_encode($json));
?>