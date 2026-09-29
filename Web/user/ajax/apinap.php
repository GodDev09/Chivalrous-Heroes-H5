<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
include "db.php";
$key = $conn->query("SELECT keyapi FROM gc_info")->fetch_assoc()['keyapi'];
$url = $conn->query("SELECT url FROM gc_info")->fetch_assoc()['url'];
$apiuser = $_SESSION['username'];
$data['url'] ="https://shopdoithe.com/api/sendCard_v3";
$data['callbackUrl'] = $url."sdt/sdt.php";
$data['key'] = $key;
$data['cardType'] = $_POST['cardType']; // string
$data['cardSeri'] = $_POST['cardSeri']; // string
$data['cardCode'] = $_POST['cardCode']; // string
$data['cardValue'] = $_POST['cardValue']; // interger
$data['refcode'] = 'TQH5';// string
$data['Signature'] = md5($data['key'].$data['cardCode'].$data['cardSeri']);
$url = $data['url'].'?key='.$data['key'].'&cardSeri='.$data['cardSeri'].'&cardType='.$data['cardType'].'&cardValue='.$data['cardValue'].'&cardCode='.$data['cardCode'].'&callbackUrl='.$data['callbackUrl'].'&refcode='.$data['refcode'].'&Signature='.$data['Signature'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$cu = curl_exec($ch);
$result = json_decode($cu, true);
$times = date('d-m-Y H:i:s');
$timed = date('d-m-Y');
if($result['status'] == 1 && isset($_POST['cardSeri']) && isset($_POST['cardCode'])){
	@$qrlog = $conn->query("INSERT INTO gc_lognap SET seri = '{$_POST[cardSeri]}', pin = '{$_POST[cardCode]}', user = '{$apiuser}', menhgia = '{$_POST[cardValue]}', createTime = '{$times}', date = '{$timed}'");
	if($qrlog)
	{
		$json['status'] = 0;
		$json['msg'] = "Nạp thẻ thành công!";
	}
}else{
	$json['status'] = 1;
	$json['msg'] = "Nạp thẻ thất bại!";
}
exit(json_encode($json));
?>