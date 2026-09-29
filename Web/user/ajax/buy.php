<?php
include "db.php";
//server=1&pack=1&packID=1
$sid = $_POST['server'];
$user = $_SESSION['username'];
$roleid = $_POST['roleid'];
$pack = isset($_POST['pack'])?(string)(int)$_POST['pack']:false;
//Check XU
$chkxu = $conn->query("SELECT * FROM gc_webshop WHERE id = '{$pack}'");
$rs = mysqli_fetch_array($chkxu);
$xutru = $rs['xu'];
$date = date("d-m-Y H:i:s");
//Truy vấn XU user
$uid = $conn->query("SELECT * FROM account WHERE username = '$user'")->fetch_assoc()['id'];
$xu = $conn->query("SELECT * FROM account WHERE username = '$user'")->fetch_assoc()['xu'];
// Xử lý
if($sid != "" && $pack != "")
{

	if($xu < $rs['xu'] || $xu < 0)
	{
		exit("Bạn không đủ XU Vui lòng nạp thêm XU");
	}
	if($pack != $rs['id'])
	{
		exit("Vật phẩm này không tồn tại!");
	}
	if($pack == $rs['id'] && $xu >= $rs['xu'])
	{
			$url = "http://127.0.0.1:8080/buy/?playerId=".$roleid."&user=".$user."&pack=".$pack;
			$html = file_get_contents($url);
			echo $html;
	}
	else
	{
			echo "Ý bạn đang làm gì đó lỗi kìa ^^!";
	}
}
else
{
	echo "Mua vật phẩm thất bại";
}
//Function
function poststr($str){
 if(isset($_POST[$str])){
  return $_POST[$str];
 }
die("this link server do not exist".$str);
}
function http_post($url, $data_string) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-AjaxPro-Method:ShowList',
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'Content-Length: ' . strlen($data_string))
    );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>