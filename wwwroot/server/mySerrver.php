<?php
include_once '../global/db.class.php';
$username=$_GET['openid'];
$token=$_GET['sign'];
if($_SESSION['playuser']<>$username){
	$data=array("code"=>4,"msg"=>"error,校验错误1");
	exit(json_encode($data,320));
}
if($_SESSION['token']<>$token){
	$data=array("code"=>4,"msg"=>"error,校验错误2");
	exit(json_encode($data,320));
}
$row=$db->getrow("select * from `account` where `username`='$username' and `token`='$token'");
if($row['id']==''){
	$data=array("code"=>4,"msg"=>"error,请返回首页登陆");
}else{
if($row['lastserver']!=''){
	$serverid=$row['lastserver'];
}else{
	$serverid=10000;
}
$time=time();
$userid=$row['id'];
$qu=$quarr[$serverid];
$data=array(
"msg"=>"操作成功",
"server"=>array(
"serverId"=>$qu['quid'],
"serverName"=>$qu['name'],
"serverIp"=> '127.0.0.1',
"serverPort"=>$qu['port'],
"serverStatus"=>1,
"serverState"=>"open",
"showId"=>1,
"limitCreate"=>1
),
"code"=>1,
"loginTime"=>$time,
"white"=>0,
"sign"=>md5($row['id'].$time."0".$qu['key']),
"history"=>0,
"cdn"=>$qu['cdn'],
"needCreate"=>0,
"userId"=>$userid,
);	
$dbname=$qu['dbname'];
$sql = "SELECT * FROM `$dbname`.`tb_user` WHERE `userName` = '$username'";
$row=$db->getrow($sql);
$datetime = date('Y-m-d h:i:s');
if($row['userName']==""){
	$db->query("INSERT INTO `$dbname`.`tb_user` (`userId`,`userName`,`token`,`channel`,`lastLoginTime`) VALUES ('$userid','$username','$token',1,'$datetime')");
}else{
	$db->query("UPDATE `$dbname`.`tb_user` SET `lastLoginTime`='$datetime' WHERE `userName`='$username' and `token`='$token'");
}
}
exit(json_encode($data,320));
?>