<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include "../db.php";
$tranid = $_GET['transaction_id'];
$status = $_GET['status'];
$received_value = $_GET['received_value'];
$real_value = $_GET['real_value'];
$sign = $_GET['sign'];
$key = $conn->query("SELECT keyapi FROM gc_info")->fetch_assoc()['keyapi'];
$signatureencode = md5($key.$tranid);
$real_value = $_GET['real_value'];
$card_seri = $_GET['card_seri'];
$card_code = $_GET['card_code'];

$ktc = $conn->query("SELECT * FROM gc_lognap WHERE seri = '{$card_seri}' AND pin = '{$card_code}' LIMIT 1");
$rs = mysqli_fetch_array($ktc);
$usrnap = $rs['user'];
$kttile = $conn->query("SELECT * FROM gc_info WHERE id = '1' LIMIT 1");
$rsl = mysqli_fetch_array($kttile);
$tile = $rsl['tile'];
$xucong = $received_value*$tile;
if(isset($tranid))
{
	if($signatureencode == $sign)
	{
		if($rs['status'] == 0 && $status == 1)
		{
				@$quer = $conn->query("UPDATE account SET xu = xu + '{$xucong}' WHERE username = '{$usrnap}' LIMIT 1"); 
				@$quers = $conn->query("UPDATE `gc_lognap` SET status = '1' WHERE user = '{$usrnap}' AND seri = '{$card_seri}' LIMIT 1"); 
					  if($quer && $quers)
					  {
						  echo "Thành công với mệnh giá ".$real_value;
					  }
					  else
					  {
						  echo "Thất bại!";
					  }
		}
		else
		{
				@$quers = $conn->query("UPDATE `gc_lognap` SET status = '-1', menhgia = '{$received_value}' WHERE user = '{$usrnap}' AND seri = '{$card_seri}' AND pin = '{$card_code}' LIMIT 1"); 
					  if($quers)
					  {
						  echo "Cập nhật trạng thái thẻ thành công!";
					  }
					  else
					  {
						  echo "Thất bại!";
					  }
		}
	}
	else
	{
		echo "Chữ ký số không đúng";
	}
}
else
{
	echo "Không kết nối được CSDL";
}
?>