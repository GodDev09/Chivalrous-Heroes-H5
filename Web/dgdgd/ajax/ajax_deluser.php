<?php
session_start();
require_once ("../../db.php");
$user = $_REQUEST['username'];
if(isset($user) && $user != "")
{
	@$qr = mysqli_query($conn,"DELETE FROM gc_user WHERE user = '".$user."'");
	if($qr)
	{
		echo '{"status":1,"msg":" Xóa thành công!"}';
	}
	else
	{
		echo '{"status":1,"msg":" Xóa thất bại!"}';
	}
}
else
{
	echo "No connect database";
}
?>