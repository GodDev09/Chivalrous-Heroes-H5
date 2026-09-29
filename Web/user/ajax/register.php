<?php
ini_set('date.timezone','Asia/Bangkok');
include "db.php";
$user = $_POST['username'];
$pass = md5($_POST['password']);
$repass = $_POST['password'];
$token = md5("hgavnh".$pass);
$reg = date('Y-m-d h:i:s',time());
$ckus = $conn->query("SELECT * FROM account WHERE username = '$user' LIMIT 1");
$rs = mysqli_fetch_array($ckus);
if($user != "" && $pass != "")
{
	if($rs['username'] == NULL || $rs['username'] < 0)
	{
		@$reg = $conn->query("INSERT INTO account(username,password,ming,token,reg_time) VALUES ('$user', '$pass', '$repass', '$token', '$reg')");
		if($reg)
		{
			$json['status'] = true;
			$json['msg'] = "Đăng ký thành công!";
		}
		else
		{
			$json['status'] = false;
			$json['msg'] = "Đăng ký thất bại!";
		}
	}
	elseif($user == $rs['username'])
	{
		$json['status'] = false;
		$json['msg'] = "Tài khoản này đã được đăng ký rồi!";
	}
	else
	{
		$json['status'] = false;
		$json['msg'] = "Đăng ký thất bại!";
	}
}
else
{
	exit("Không thể kết nối đến CSDL");
}
echo json_encode($json);
?>