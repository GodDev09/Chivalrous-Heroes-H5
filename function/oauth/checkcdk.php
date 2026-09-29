<?php
error_reporting(0);
ini_set('date.timezone','Asia/Bangkok');
$code = trim(strtoupper($_GET['code']));
$uid = $_GET['playerId'];
$usid = $_GET['userId'];
$svid = substr($uid,0,5);
$db = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","account") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($db,"UTF8");
$dbs = $db->query("SELECT * FROM gc_server WHERE id = '".$svid."' LIMIT 1")->fetch_assoc()['db'];
$url = $db->query("SELECT * FROM gc_server WHERE id = '".$svid."' LIMIT 1")->fetch_assoc()['port'];
$conn = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","{$dbs}") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($conn,"UTF8");
//?code=ttq00001&playerId=10000000001&userId=15&signature=2651b47c9fa5cec1ef0fdf50bde92a3a
$ck = $conn->query("SELECT * FROM account.`gc_giftcode` WHERE giftcode = '$code' LIMIT 1");
$x = mysqli_fetch_array($ck);
$uidac = $conn->query("SELECT * FROM account.`account` WHERE `id` = '$usid' LIMIT 1")->fetch_assoc()['id'];
$user = $conn->query("SELECT * FROM account.`account` WHERE `id` = '$usid' LIMIT 1")->fetch_assoc()['username'];
$query = $conn->query("SELECT * FROM `tb_player` WHERE  `userId` = '$uidac' limit 1");
$row = mysqli_fetch_array($query);
$logcode = $conn->query("SELECT * FROM account.`gc_logcode` WHERE user = '$user' AND uid = '$uid' AND logcode = '$code' LIMIT 1")->fetch_assoc()['logcode'];
if(isset($code) && isset($uid) && isset($usid))
{
	if($logcode != $code && $code == $x['giftcode'] && $x['server'] == "all")
	{
		@$up = $conn->query("INSERT INTO account.`gc_logcode`(user,logcode,uid) VALUES ('$user','$code','$uid')");
		$cmd = 3;
		$time = time();
		$title = "GM";
		$content = "Quà tân thủ";
		$data = json_decode($x['item']);
		$postdata = array("cmd" => $cmd, "mails" => json_encode(array(array("type" => 1, "sendId" => 0, "sendName" => "GM", "title" => $title, "context" => $content, "rewards" => $data, "rules" => array("4" => (string)$row['playerId']))), 320));
		$result = get1($url, $postdata);
		if($result == "10001" && $up)
		{
		$json["code"] = 11004;
		$json["message"] = "Nhận thành công!";
		}
	}
	elseif($logcode != $code && $code == $x['giftcode'] && $x['server'] == $svid)
	{
		@$up = $conn->query("INSERT INTO account.`gc_logcode`(user,logcode,uid) VALUES ('$user','$code','$uid')");
		$cmd = 3;
		$time = time();
		$title = "GM";
		$content = "Quà tân thủ";
		$data = json_decode($x['item']);
		$postdata = array("cmd" => $cmd, "mails" => json_encode(array(array("type" => 1, "sendId" => 0, "sendName" => "GM", "title" => $title, "context" => $content, "rewards" => $data, "rules" => array("4" => (string)$row['playerId']))), 320));
		$result = get1($url, $postdata);
		if($result == "10001" && $up)
		{
		$json["code"] = 11004;
		$json["message"] = "Nhận thành công!";
		}
	}
	elseif($x['server'] != $svid && $x['server'] != "all")
	{
		$json["code"] = 11005;
		$json["message"] = "Lỗi kênh gói quà!";
	}
	elseif($code != $x['giftcode'])
	{
		$json["code"] = 11001;
		$json["message"] = "Giftcode không tồn tại!";
	}
	else
	{
		$json["code"] = 11006;
		$json["message"] = "Bạn đã nhận code này rồi!";
	}
}
else
{
	$json["code"] = 11001;
	$json["message"] = "Giftcode không tồn tại!";
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