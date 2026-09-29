<?php
session_start();
include 'db.php';
$qer = $conn->query("SELECT * FROM gc_info WHERE id = '1' LIMIT 1");
$rs = mysqli_fetch_array($qer);
$khuyenmai = $rs['khuyenmai'];
$page = $rs['page'];
$title = $rs['title'];
$url = $rs['url'];
$urlgame = $rs['urlgame'];
$data = base64_decode($_GET['token']);
$arr = json_decode($data,true);
$user = $arr['user'];
$token = $arr['token'];
$sgin = $arr['sign'];
$pass = $conn->query("SELECT * FROM account WHERE username = '$user' AND token = '$token' LIMIT 1")->fetch_assoc()['password'];
$signkey = md5("hgavnh".$pass.$token);
$preg = '/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u';
$preg2 = "/^(select|SHOW FULL COLUMNS FROM|SHOW TABLES FROM|SHOW CREATE TABLE|drop|update|DROP|Select|UPDATE|AND|and|update)/i";
if(!preg_match($preg,$token) || preg_match($preg2,$token))
{
	exit ('<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="http://127.0.0.1/user/login"</script>');	
}
if(!preg_match($preg,$user) || preg_match($preg2,$user))
{
	exit ('<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="http://127.0.0.1/user/login"</script>');
}
if(!$user && $sign != $signkey)
{
	exit ('<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="http://127.0.0.1/user/login"</script>');
}
else
{
	$_SESSION['token'] = $token;
	$_SESSION['playuser'] = $user;
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$title;?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="full-screen" content="true" />
    <meta name="screen-orientation" content="portrait" />
    <meta name="x5-fullscreen" content="true" />
    <meta name="360-fullscreen" content="true" />
	<link rel="shortcut icon" href="<?=$url;?>favicon.ico" type="image/x-icon" />
    <style>
        html, body {
            -ms-touch-action: none;
            background: #000000;
            padding: 0;
            border: 0;
            margin: 0;
            height: 100%;
        }
		a{
			text-decoration: none;
			color: #985c16;
			font-weight: bold;
			font-family: arial;
			font-size: 15px;
		}
    </style>
	 <style type="text/css"> 
        html { 
            overflow: auto; 
        } 
          
        html, 
        body, 
        iframe { 
            margin: 0px; 
            padding: 0px; 
            height: 100%; 
            border: none; 
        } 
          
        iframe { 
            display: block; 
            width: 100%; 
            border: none; 
            overflow-y: auto; 
            overflow-x: hidden; 
        } 
    </style> 	<script src="js/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<link rel="stylesheet" href="css/floating.css">
	<script src="js/floating.js"></script>
	<script src="js/gdh5.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	
	


</head>

<body>
    <iframe src="http://127.0.0.1:81/game.php?user=<?=$_SESSION['playuser'];?>&sign=<?=$_SESSION['token'];?>&check=1"
            frameborder="0" 
            marginheight="0" 
            marginwidth="0" 
            width="100%" 
            height="100%" 
            scrolling="auto"> 
  </iframe>
  
</body> 

</html>
<?php } ?>