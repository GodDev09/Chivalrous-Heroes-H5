<?php
session_start();
include "../../db.php";
$user = trim($_POST['username']);
$pass = md5($_POST['password']);
$select = "SELECT * FROM gc_admin WHERE user = '{$user}' and pass = '{$pass}'";
$sql = mysqli_query($conn,$select);
$rw = mysqli_num_rows($sql);
$rs = mysqli_fetch_array($sql);
if($rw > 0 && $rs['admin'] == "2205" && isset($user) && isset($pass))
{
	echo '{"code":0, "msg":"/admin@@@@/"}';
	$_SESSION['useradmin'] = $rs['user'];
	$_SESSION['admin'] = $rs['admin'];
}
elseif($rs['pass'] != $pass)
{
	echo '{"code":1, "msg":"Nhập sai mật khẩu"}';
}
else
{
	echo '{"code":1, "msg":"Đăng nhập thất bại!"}';
}
?>