<?php
set_time_limit(0);
session_start();
error_reporting(0);
require_once "../../db.php";
$user = $_REQUEST['username'];
$srv = $_REQUEST['serverId']; 
$selsv2 = "SELECT * FROM s{$srv}.actors WHERE accountname='".$user."'";
$sqlv2 = mysqli_query($conn,$selsv2);
$type = $_REQUEST['type'];
if($type == "get")
{
while($srs = mysqli_fetch_array($sqlv2)) {?>
<option value='<?php echo $srs['actorid']?>'>ID:<?php echo $srs['actorid']." - Tên: ".$srs['actorname'] ?></option>
<?php
	}
}
else 
{
echo "Khong the ket noi den CSDL";
}
?>