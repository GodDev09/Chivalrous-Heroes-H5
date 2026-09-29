<?php
session_start();
include "db.php";
$user = $_SESSION['username'];
$sid = "xntg".$_POST['server'];
$server = $_POST['server'];
$giftcode = trim(strtoupper($_POST['giftcode']));
$ckcode = $conn->query("SELECT * FROM gc_giftcode WHERE giftcode = '".$giftcode."'");
$rs = mysqli_fetch_array($ckcode);
$item = explode(";",$rs['item']);
$time = time();
$logcode = $conn->query("SELECT * FROM gc_logcode WHERE user = '".$user."' AND logcode = '".$giftcode."'");
$rl = mysqli_fetch_array($logcode);
$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
if($giftcode == "")
{
	$json['status'] = false;
	$json['msg'] = "Bạn chưa nhập mã GiftCode";
	exit(json_encode($json));
}
if($giftcode == $rs['giftcode'] && $server != $rs['server'])
{
	$json['status'] = false;
	$json['msg'] = "GiftCode này không sài cho Server này";
	exit(json_encode($json));
}
if($giftcode == $rl['logcode'] && $server == $rl['server'])
{
	$json['status'] = false;
	$json['msg'] = "Bạn đã nhận GiftCode này rồi";
	exit(json_encode($json));
}
if($giftcode != $rs['giftcode'])
{
	$json['status'] = false;
	$json['msg'] = "Mã GiftCode không tồn tại";
	exit(json_encode($json));
}
if(isset($server) && isset($giftcode) && $giftcode == $rs['giftcode'] && $giftcode != $rl['logcode'])
{
	@$up = $conn->query("INSERT INTO gc_logcode(user,logcode,server) VALUES ('{$user}','{$giftcode}','{$server}')");
	if($up) {
	$name = $conn->query("SELECT * FROM $sid.players WHERE account = '$user'")->fetch_assoc()['name'];
	$roleid = $conn->query("SELECT * FROM $sid.players WHERE account = '$user'")->fetch_assoc()['dbid'];
	$serverid = $conn->query("SELECT * FROM $sid.players WHERE account = '$user'")->fetch_assoc()['serverid'];
	$query1 = $conn->prepare("INSERT INTO $sid.gmcmd (serverid, cmd, param1, param2, param3, param4) values (?,'mail',?,?,?,?)");
	$query1->bind_param('sssss', $serverid, $roleid, '1','[1000002;1000006]','[1;1]');
	$query1->execute();
	$json['status'] = true;
	$json['msg'] = "Nhận Code thành công";
	}
	exit(json_encode($json));
}
else
{
	$json['status'] = false;
	$json['msg'] = "Có lỗi trong quá trình nhận GiftCode";
	echo json_encode($json);
}

?>