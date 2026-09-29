<html class="">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" /> 
        <link rel="shortcut icon" href="<?=$url;?>favicon.ico" /> 
        <title><?=$title;?></title> 
        <meta name="google-site-verification" content="" /> 
        <meta name="description" content="<?=$title;?> <?=$des;?>" /> 
        <meta name="keywords" content="Game hay 2018, Game hay, Webgame, webgame hay, Game hot, game hot 2018, webgame hot, webgame hot 2018, game mới, game moi, game mới 2018, game moi 2018, webgame mới, webgame moi, webgame moi 2018, webgame mới 2018, game H5,game đa thiết bị, game H5 Bảo Bối Thần Kỳ, game h5 bao boi than ky, game Bảo Bối Thần Kỳ, game BBTK, webgame BBTK, game h5, game h5 bảo bối, game h5 bao boi, Game MMORPG, chơi bảo bối thần kỳ h5, choi bao boi than ky h5, BBTK 360game, bbtkh5.360game, bbtkh5, webgame hay 2018, game the bai 2018, webgame the bai 2018, h5 the bai" /> 
        <meta name="robots" content="index,follow">
		<meta name="revisit-after" content="1days">
		<meta property="og:title" content="<?=$title;?> <?=$des;?>" /> 
        <meta property="og:description" content="<?=$title;?> <?=$des;?>" /> 
        <meta property="og:image" content="<?=$url;?>banner.jpg" /> 
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
        <style type="text/css">
		html, body 
		{ position: relative; height: 100%; }
		body { background: #eee; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 14px; color:#000; margin: 0; padding: 0; }
		/*------------- Star QR Code-----------*/ 
		.qr-code-box { display: block; position: absolute; bottom: 15px; left: 20px; width: 126px; } 
		.qr-code-box .top { top: -7px; left: -7px; } 
		.qr-code-box .bottom { top: 88px; left: -7px; } 
		.qr-code-box .top,
		.qr-code-box .bottom { position: absolute; float: left; width: 100%; height: 45px; } 
		.qr-code-box .top:after, 
		.qr-code-box .bottom:after { right: -14px; } 
		.qr-code-box .top:before,
		.qr-code-box .top:after,
		.qr-code-box .bottom:before,
		.qr-code-box .bottom:after { content: ""; position: absolute; top: 0; background: #9396cb; float: left; width: 45px; height: 45px; } 
		.qr-code-box .img { position: relative; z-index: 2; margin-bottom: 20px; } 
		.qr-code-box .img img { display: block; width: 126px; height: 126px; } 
		.qr-code-box .txt { position: relative; z-index: 2; margin-bottom: 20px; left: -6px; } 
		.qr-code-box .txt img { display: block; width: 140px; height: 55px; }
		@media (max-width: 767px) { .qr-code-box{ display: none; } } 
		/*------------- End QR Code-----------*/ 
		.fullscreen-bg 
		{
			position: fixed; top: 0; right: 0; bottom: 0; left: 0; overflow: hidden; z-index: -100; margin: auto; 
			background: url('<?=$url;?>banner.jpg');
			} 
		.fullscreen-bg__video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; } 
		.swiper-container{ display: none; margin:0px; position: relative; } 
		@media (min-aspect-ratio: 16/9) { .fullscreen-bg__video { height: 300%; top: -100%; } } 
		@media (max-aspect-ratio: 16/9) { .fullscreen-bg__video { width: 300%; left: -100%; } } 
		.label{ position: absolute; bottom: 0px; left: 0px; z-index: 100; height: 8%; width: auto; } 
		.label img{ height: 100%; } @media (max-width: 768px) { .label{ display: none; } 
		.fullscreen-bg {background: url('<?=$url;?>banner.jpg') center center / cover no-repeat; } 
		.fullscreen-bg__video { display: none; } .swiper-container{ display: block; z-index: 1; } 
		.qr-code-box{ display: none; } } 
		@media (max-width: 800px) { 
		.btn img { transform: scale(0.7); } } 
		.logo{ display: none; width: 10%; left: 50%; top: 20px; position: absolute; transform: translateX(-50%); } 
		.logo img{ width: 100%; } 
        .play {
		position: absolute;
		bottom: 330px;
		left: 750px;
		z-index: 100;
		height: 8%;
		width: auto;}
		.playmb {
		position: absolute;
		bottom: 7%;
		left: 50%;
		margin-left: -210px;
		z-index: 100;
		}
        </style> 
    </head> 
    <body style="overflow: hidden;cursor: pointer;"> 
        <div style="position: fixed;width:100%;height:100%" onclick="landing_entergame()" ontouchstart="landing_entergame();">
	<div class="playmb">
			<a href="<?=$url;?>user/login">
            <img src="<?=$url;?>play.gif"/> 
			</a>
        </div> 
		</div> 
        <div class="logo"> 
            <img src="<?=$url;?>logo.png" /> 
        </div> 
        <div class="label"> 
            <img src="<?=$url;?>logo.png" /> 
        </div>
        <div class="fullscreen-bg"></div> 
        <!--Start Button LP --> 
        <!--Star Sound LP --> 
        <div onclick="disableMute(event)" type="button" style="position:fixed; z-index: 3000; cursor:pointer;right:0.6%; top:1%; width: 74px;height: 50px; font-size: 12px;"> 
            <a href="<?=$url;?>user/login"><img class="btn_sound" src="<?=$url;?>home.png"/ title="Đăng nhập"></a> 
        </div> <script type="text/javascript">
	/**/

	window.landing_entergame = function(){
		window.location = '<?=$url;?>user/login';
	};
	
</script> 
<script type="text/javascript">

    Swal.fire({
  title: '<strong class="text-success">Thông báo từ BQT</strong>',
  icon: 'info',
  html:
    '<?=$danhsachcode;?>',
  showCloseButton: true,
  showCancelButton: false,
  confirmButtonText:
    '<i class="fa fa-thumbs-up"></i> OK!',
  confirmButtonAriaLabel: 'Thumbs up, great!',

})
</script>
    </body>
</html>