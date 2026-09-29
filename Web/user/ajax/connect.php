<?php
include "db.php";
$uid = $_POST['uid'];
$user = $_POST['username'];
$pass = $_POST['password'];
$check = $conn->query("SELECT * FROM gc_lienket WHERE user = '{$user}'");
$rs = mysqli_fetch_array($check);
$usrk = $conn->query("SELECT * FROM ddd2_account.`tab_account` WHERE user_name = '{$user}'")->fetch_assoc()['user_name'];
if(isset($uid) && isset($user) && isset($pass))
{
	if($usrk == $user)
	{
		$json['status'] = false;
		$json['msg'] = "Tài khoản này đã được liên kết rồi";
		exit(json_encode($json));
	}
	if($rs['user'] != $user && $rs['uid'] != $uid && $rs['status'] != 1)
	{
		@$up = $conn->query("INSERT INTO gc_lienket(user,pass,uid) VALUES ('{$user}','{$pass}','{$uid}')");
		if($up)
		{
		$json['status'] = true;
		$json['msg'] = "Tài khoản đã được gửi chờ Admin kích hoạt";
		exit(json_encode($json));
		}
	}
	else
	{
		$json['status'] = false;
		$json['msg'] = "Tài khoản đang chờ Admin kích hoạt";
		exit(json_encode($json));
	}
}
else
{
	$json['status'] = false;
	$json['msg'] = "Kết nối đến CSDL thất bại";
	exit(json_encode($json));
}
?>