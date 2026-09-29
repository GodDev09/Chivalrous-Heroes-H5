<?php
//error_reporting(0);
ini_set('date.timezone','Asia/Bangkok');
$db = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","account") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($db,"UTF8");
$dbs = $db->query("SELECT * FROM gc_server WHERE id = '".$_GET['serverId']."' LIMIT 1")->fetch_assoc()['db'];
$url = $db->query("SELECT * FROM gc_server WHERE id = '".$_GET['serverId']."' LIMIT 1")->fetch_assoc()['port'];
$conn = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","{$dbs}") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($conn,"UTF8");
//
$usid = $_GET['playerId'];
$query = $conn->query("SELECT * FROM `tb_player` where  `playerId` = '$usid' limit 1");
$row = mysqli_fetch_array($query);
$ids = isset($_GET['id'])?(string)(int)$_GET['id']:false;
$checkxu = $conn->query("SELECT * FROM account.`account` WHERE id = '".$row['userId']."' LIMIT 1");
$rs = mysqli_fetch_array($checkxu);
$rmb = $conn->query("SELECT * FROM account.`gc_shop` WHERE id = '".$ids."' LIMIT 1");
$xl = mysqli_fetch_array($rmb);
$x = explode("|",$xl['data']);
$con = json_decode($xl['con']);
$playerId = $row['playerId'];
$userId = $row['userId'];
$chargename = "XxSG_SecretKey_2024";
$signkey = "5Jqxjo10Yl2ElQCwJm";
//
$num = $x[1]; // Số tiền theo ID
$subject = $x[0];
$cmd = 5;
$cmds = 3;
$orderNum = date('YmdHis') . md5(uniqid(microtime(true) . mt_rand()));
$time = time();
$date = date('d-m-Y H:i:s');
//Check Nạp đầu
$cknd = $conn->query("SELECT * FROM account.`gc_napdau` WHERE user = '".$rs['username']."' AND uid = '".$playerId."' LIMIT 1");
$checknapxu = $conn->query("SELECT * FROM account.`account` WHERE username = '".$rs['username']."' LIMIT 1")->fetch_assoc();
$xuch = $checknapxu['xu'];
//var_dump($xuch);exit;
if($xuch <= 0){
	$json['status'] = 0;
	$json['msg'] = "XU không đủ nạp thêm XU tại<br/>http://127.0.0.1";
	exit(json_encode($json));
}
if($xuch < $_GET['money']){
	$json['status'] = 0;
	$json['msg'] = "XU không đủ nạp thêm XU tại<br/>http://127.0.0.1";
	exit(json_encode($json));
}
$napdau = mysqli_num_rows($cknd);
$ckmoney = $_GET['money'];
if($rs['xu'] == NULL || $rs['xu'] == 0 || $xl['xu'] == NULL || $xl['xu'] == 0)
{
	$json['status'] = 0;
	$json['msg'] = "XU không đủ nạp thêm XU tại<br/>http://127.0.0.1";
	exit(json_encode($json));
}
if($ckmoney == 0 || $ckmoney == 1 || $ckmoney == 2 || $ckmoney == 3 || $ckmoney == 4 || $ckmoney == 5)
{
	$json['status'] = 0;
	$json['msg'] = "Lỗi dữ liệu!";
	exit(json_encode($json));
}
if($rs['xu'] >= $xl['xu'])
{
	$up = $conn->query("UPDATE account.`account` SET xu = xu - '".$xl['xu']."' WHERE username = '".$rs['username']."' LIMIT 1");
	$uplog = $conn->query("INSERT INTO account.`gc_logxu`(user,xutru,goi,createTime) VALUES ('".$rs['username']."','".$xl['xu']."','".$xl['data']."','".$date."')");
	$sign = md5($playerId . $num . $time . $subject . $signkey);
	$postdata = array("cmd" => $cmd, "playerId" => $playerId, "num" => $num, "orderNum" => $orderNum, "time" => $time, "sign" => $sign, "subject" => $subject);
	$result = get($url, $postdata);
	if($result == 1 || $result == "-1")
	{
		$json['status'] = 0;
		$json['msg'] = "Đổi XU thất bại!";
	}
	else
	{
		if($napdau == 0 || $napdau == NULL)
		{
			$mailnap = array("cmd" => $cmds, "mails" => json_encode(array(array("type" => 1, "sendId" => 0, "sendName" => "GM", "title" => "Gói nạp", "context" => "Gói nạp {$xl['xu']} XU", "rewards" => $con, "rules" => array("4" => (string)$playerId))), 320));
			$rslnap = get1($url, $mailnap);
			$itemnd = json_decode('[{"type":2,"id":2602,"num":1},{"type":1,"id":2,"num":1000},{"type":2,"id":30000613,"num":10}]'); //Quà Nạp đầu
			$qua = array("cmd" => $cmds, "mails" => json_encode(array(array("type" => 1, "sendId" => 0, "sendName" => "GM", "title" => "Quà nạp đầu", "context" => "Quà nạp đầu", "rewards" => $itemnd, "rules" => array("4" => (string)$playerId))), 320));
			$quand = get1($url, $qua);
			$uplognd = $conn->query("INSERT INTO account.`gc_napdau`(user,uid,server,act) VALUES ('".$rs['username']."','".$playerId."','".$_GET['serverId']."','1')");
			if($rslnap == "10001" && $quand == "10001")
			{
				$json['status'] = 1;
				$json['msg'] = "Đổi XU thành công!";
			}
			else
			{
				$json['status'] = 0;
				$json['msg'] = "Đổi XU thất bại!";
			}
		}
		else
		{
			$mailnap = array("cmd" => $cmds, "mails" => json_encode(array(array("type" => 1, "sendId" => 0, "sendName" => "GM", "title" => "Gói nạp", "context" => "Gói nạp {$xl['xu']} XU", "rewards" => $con, "rules" => array("4" => (string)$playerId))), 320));
			$rslnap = get1($url, $mailnap);
			if($rslnap == "10001" && $xl['con'] != 0)
			{
				$json['status'] = 1;
				$json['msg'] = "Đổi XU thành công!";
			}
			else
			{
				$json['status'] = 1;
				$json['msg'] = "Đổi XU thành công!";
			}
		}
	}
}
else
{
	$json['status'] = 0;
	$json['msg'] = "XU không đủ nạp thêm XU tại<br/>http://127.0.0.1";
}
exit(json_encode($json));
//Function
$getfilter="'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq){
	if(is_array($StrFiltValue)){
		$StrFiltValue=implode($StrFiltValue);
	}
	if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){
		print "非法操作!";
		exit();
	}
}
foreach($_GET as $key=>$value){
	StopAttack($key,$value,$getfilter);
}
foreach($_POST as $key=>$value){
	StopAttack($key,$value,$postfilter);
}
foreach($_COOKIE as $key=>$value){
	StopAttack($key,$value,$cookiefilter);
}
function poststr($str){
 if(isset($_POST[$str])){
  return $_POST[$str];
 }
die("您提交的参数非法！");
}
function get($url,$postdata){
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($postdata)); 
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$output = curl_exec($ch);
		$errorCode = curl_errno($ch);
		curl_close($ch);
		if(0 !== $errorCode){
			return '1';
		}
		$return = json_decode($output,true);
		if($return["errorCode"]=='0'){
			return '0';
		}else{
			return '-1'.$return["errorCode"];
		}
	}
function get1($url,$postdata){
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($postdata)); 
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$output = curl_exec($ch);
		$errorCode = curl_errno($ch);
		curl_close($ch);
		return $output;
	}//更多手游下载 w ww.z gym w.com
?>