<?php
ini_set('date.timezone','Asia/Bangkok');
$uid = $_GET['playerId'];
$user = $_GET['user'];
$pack = isset($_GET['pack'])?(string)(int)$_GET['pack']:false;
$svid = substr($uid,0,5);
$time = date("d-m-Y");
$times = date("d-m-Y H:i:s");
$db = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","account") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($db,"UTF8");
$dbs = $db->query("SELECT * FROM gc_server WHERE id = '".$svid."' LIMIT 1")->fetch_assoc()['db'];
$url = $db->query("SELECT * FROM gc_server WHERE id = '".$svid."' LIMIT 1")->fetch_assoc()['port'];
$qrmoc = $db->query("SELECT * FROM gc_webshop WHERE id = '".$pack."'");
$xl = mysqli_fetch_array($qrmoc);
$xutru = $xl['xu'];
$item = json_decode($xl['item']);
//DB Game
$conn = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","{$dbs}") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($conn,"UTF8");
//Check User
$usrck = $db->query("SELECT * FROM account WHERE username = '$user' LIMIT 1")->fetch_assoc()['id'];
$xunap = $db->query("SELECT * FROM account WHERE username = '$user' LIMIT 1")->fetch_assoc()['xu'];
$chuid = $conn->query("SELECT * FROM tb_player WHERE userId = '$usrck' LIMIT 1")->fetch_assoc()['playerId'];
$cmd = 3;
if($pack == "" || $pack != $xl['id'])
{
	echo "ID Vật phẩm không tồn tại";
	exit();
}
if($xunap < 9000 || $xunap < 0)
{
	echo "Vui lòng nạp thêm XU";
	exit();
}
if($xunap > 9999 && $xunap != "")
{
		$up = $conn->query("INSERT INTO account.`gc_logxu`(user,goi,xutru,createTime) VALUES ('{$user}','".$xl['name']."','".$xl['xu']."','{$times}')");
		$qua = array("cmd" => $cmd, "mails" => json_encode(array(array("type" => 1, "sendId" => 0, "sendName" => "GM", "title" => "Webshop", "context" => "Webshop", "rewards" => $item, "rules" => array("4" => (string)$chuid))), 320));
		$quand = get1($url, $qua);
		$xutru = $db->query("UPDATE account SET xu = xu - '{$xutru}' WHERE id = '$usrck' LIMIT 1");
		if($quand == "10001")
		{
			echo "Mua vật phẩm thành công!";
		}
		else
		{
			echo "Mua vật phẩm thất bại";
		}
}
//var_dump($xunap);
//exit();
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