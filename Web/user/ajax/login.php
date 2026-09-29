<?php
ini_set('date.timezone','Asia/Bangkok');
include "db.php";
$user = $_POST['username'];
$pass = md5($_POST['password']);
$ckus = $conn->query("SELECT * FROM account WHERE username = '".$user."' AND password = '".$pass."'");
$rs = mysqli_fetch_array($ckus);
$reg = date('Y-m-d h:i:s',time());
if($user != "" && $pass != "")
{
	if($rs['username'] == $user && $rs['password'] == $pass)
	{
		@$up = $conn->query("UPDATE account SET lastloginip = '".getip()."', lastlogintime = '$reg' WHERE username = '$user' AND password = '$pass' LIMIT 1");
		if($up)
		{
		$json['status'] = true;
		$_SESSION['username'] = $rs['username'];
		}
	}
	else
	{
		$json['status'] = false;
		$json['msg'] = "Đăng nhập thất bại";
	}
}
else
{
	exit("Không thể kết nối đến CSDL");
}
exit(json_encode($json));
function getip() {
    if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } elseif (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    }
    preg_match("/[\d\.]{7,15}/", isset($ip) ? $ip : NULL, $match);
    return isset($match[0]) ? $match[0] : 'unknown';
}
?>