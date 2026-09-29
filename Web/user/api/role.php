<?php
session_start();
include "../../db.php";
$type = $_POST['type'];
$user = $_SESSION['username'];
$server = $_POST['server'];
$dbs = $conn->query("SELECT * FROM gc_server WHERE id = '".$server."' LIMIT 1")->fetch_assoc()['db'];
$url = $conn->query("SELECT * FROM gc_server WHERE id = '".$server."' LIMIT 1")->fetch_assoc()['port'];
$uid = $conn->query("SELECT * FROM account WHERE username = '".$user."' LIMIT 1")->fetch_assoc()['id'];
$db = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","{$dbs}") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($db,"UTF8");
if(isset($server))
{
	$usck = $db->query("SELECT * FROM `tb_player` WHERE userId = '$uid'");
	while($rs = mysqli_fetch_array($usck))
	{?>
	<option value="<?=$rs['playerId'];?>"><?=$rs['playerName'];?></option>
<?php 
	}
}
else
{
	$json['status'] = false;
	$json['msg'] = "Không có nhân vật!";
	exit(json_encode($json));
}
?>