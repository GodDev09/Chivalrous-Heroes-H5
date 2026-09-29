<?
include_once '../global/db.class.php';
$userId=$_GET['userId'];
$serverId=$_GET['serverId'];
$db->query("update `account` set `lastserver`='$serverId' where `id`='$userId'");
$data=array("msg"=>"ok","code"=>1);
exit(json_encode($data,320));
?>