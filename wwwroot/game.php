<?php
include_once './global/db.class.php';
$preg = '/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u';
$preg2 = "/^(select|SHOW FULL COLUMNS FROM|SHOW TABLES FROM|SHOW CREATE TABLE|drop|update|DROP|Select|UPDATE|AND|and|update)/i";
if(!preg_match($preg,$_SESSION['token']) || preg_match($preg2,$_SESSION['token']))
{
	exit ('<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="http://127.0.0.1/user/login"</script>');
}
if(!preg_match($preg,$_SESSION['playuser']) || preg_match($preg2,$_SESSION['playuser']))
{
	exit ('<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="http://127.0.0.1/user/login"</script>');
}
if(isset($_SESSION['token']) && isset($_SESSION['playuser']))
{
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo WEBNAME;?></title>
    <!-- 搜狗强制全屏 -->
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no,minimal-ui"
    />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes">
    <!-- UC强制全屏 -->
    <meta name="full-screen" content="true" />
    <meta name="browsermode" content="application">
    <meta name="screen-orientation" content="portrait" />
    <!-- QQ强制全屏 -->
    <meta name="x5-orientation" content="portrait" />
    <meta name="x5-fullscreen" content="true" />
    <meta name="x5-page-mode" content="app">
    <!-- 360强制全屏 -->
    <meta name="360-fullscreen" content="true" />
    <link rel="stylesheet" type="text/css" href="index.css" />
	<script src="js/jquery.min.js"></script>

	<script src="layer/layer.js"></script>
	<style type="text/css">
    
        @font-face{
            font-family: '方正艺黑简体';
            src: url('TUV-Prime-Regular.ttf') format('truetype');
            /*src: url('./svnres/default/assets/TUV-Prime-Regular.ttf') format('truetype');*/
            font-weight: normal;
            font-style: normal
        }
        
        div {
            font-family: "方正艺黑简体";
        }
    </style>
</head>

<body>
    <div class="loading g1" id='loadingUi' style='overflow: hidden; margin: auto;width: 100%;height: 100%;position:absolute;z-index:2;background-color: white;'>
<div class="pic1"></div>
<div id="prossDiv" style="display: block;width: 100%;height: 100%;position:relative;top:-30%;">
<div class="loading-progress">
    <div class="loading-progress-bar">
        <div class="loading-progress-finish" id='loadingBar'></div>
    </div>
</div>
<div class="t1" style="position:relative;bottom:8%;">
<p class="006eff">Đang tải dữ liệu trò chơi vui lòng đợi……</p>
</div>
<div class="loading-into-info">
    <div class="loading-into-info-list">
    </div>
</div>
</div>
</div>
<div id="mainDiv" style="margin: auto;width: 100%;height: 100%;background-color: black;" class="egret-player" data-entry-class="Main" data-orientation="auto" data-scale-mode="showAll" data-frame-rate="30" data-content-width="672"
data-content-height="1120" data-show-paint-rect="false" data-multi-fingered="2" data-show-fps="false" data-show-log="false"
data-show-fps-style="x:0,y:0,size:12,textColor:0xffffff,bgAlpha:0.9">
</div>
<script src="index.js?v=<?=time();?>"></script>
<script src="hgavnh.js?v=<?=time();?>"></script>
</body>

</html>
<?php 
}
else
{
	echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="http://127.0.0.1/user/login"</script>';	
}
?>