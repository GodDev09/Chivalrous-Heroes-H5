<?php
ini_set('date.timezone','Asia/Bangkok');
$uid = $_GET['playerId'];
$user = $_GET['user'];
$pack = isset($_GET['pack'])?(string)(int)$_GET['pack']:false;
$svid = substr($uid,0,5);
$time = date("d-m-Y");
$db = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","account") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($db,"UTF8");
$dbs = $db->query("SELECT * FROM gc_server WHERE id = '".$svid."' LIMIT 1")->fetch_assoc()['db'];
$url = $db->query("SELECT * FROM gc_server WHERE id = '".$svid."' LIMIT 1")->fetch_assoc()['port'];
$qrmoc = $db->query("SELECT * FROM gc_mocqua WHERE id = '".$pack."'");
$xl = mysqli_fetch_array($qrmoc);
$chklog = $db->query("SELECT * FROM gc_mocqualog WHERE user = '{$user}' AND logid = '{$pack}' AND date ='{$time}'");
$rs = mysqli_fetch_array($chklog);
$query = $db->query("SELECT * FROM gc_info");
$tm = mysqli_fetch_array($query);
$starttime = $tm['starttime'];
$endtime = $tm['endtime'];
if($tm['acttask'] == 1)
{
	$start = date('d-m-Y',strtotime($starttime));
	$end = date('d-m-Y',strtotime($endtime));
	$xunap = $db->query("SELECT SUM(menhgia) AS DIEM FROM gc_lognap WHERE user = '".$user."' AND date >= '".$start."' AND date <= '".$end."' AND status = '1'")->fetch_assoc()['DIEM'];
}
else
{
	$xunap = $db->query("SELECT SUM(menhgia) AS DIEM FROM gc_lognap WHERE user = '".$user."' AND date = '".$time."' AND status = '1'")->fetch_assoc()['DIEM'];
}
$item = json_decode($xl['soluong']);
//DB Game
$conn = mysqli_connect("localhost","root","X7kR9mP2qN5wL8jZ","{$dbs}") or die ("Không thể kết nối đến CSDL");
mysqli_set_charset($conn,"UTF8");
//
$cmd = 3;
if($pack == "" || $pack != $xl['id'])
{
	echo "Gói quà không tồn tại";
	exit();
}
if($xunap == NULL && $pack == 1)
{
	if($rs['logid'] != $pack)
	{
		$up = $conn->query("INSERT INTO account.`gc_mocqualog`(user,logid,date,server,status) VALUES ('{$user}','{$pack}','{$time}','$svid','1')");
		$qua = array("cmd" => $cmd, "mails" => json_encode(array(array("type" => 1, "sendId" => 0, "sendName" => "GM", "title" => "Quà tích nạp", "context" => "Quà tích nạp", "rewards" => $item, "rules" => array("4" => (string)$uid))), 320));
		$quand = get1($url, $qua);
		if($quand == "10001")
		{
			echo "Nhận quà tích nạp thành công";
		}
		else
		{
			echo "Nhận quà thất bại";
		}
	}
	else
	{
		echo "Bạn đã nhận mốc quà này rồi!";
	}
}
elseif($xunap >= $xl['diem'] && $pack == $xl['id'])
{
	if($rs['logid'] != $pack)
	{
		$up = $conn->query("INSERT INTO account.`gc_mocqualog`(user,logid,date,server,status) VALUES ('{$user}','{$pack}','{$time}','$svid','1')");
		$qua = array("cmd" => $cmd, "mails" => json_encode(array(array("type" => 1, "sendId" => 0, "sendName" => "GM", "title" => "Quà tích nạp", "context" => "Quà tích nạp", "rewards" => $item, "rules" => array("4" => (string)$uid))), 320));
		$quand = get1($url, $qua);
		if($quand == "10001")
		{
			echo "Nhận quà tích nạp thành công";
		}
		else
		{
			echo "Nhận quà thất bại";
		}
	}
	else
	{
		echo "Bạn đã nhận mốc quà này rồi!";
	}
}
else
{
	echo "Không thể kết nối đến CSDL";
}
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