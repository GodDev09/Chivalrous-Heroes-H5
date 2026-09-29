<?php
//error_reporting(0);
session_start();
include "inc/func.php";
include "../db.php";
$user = $_SESSION['useradmin'];
$admin = $_SESSION['admin'];
if(isset($user) && $admin == "2205")
{
	header("Location: /");
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title><?=$title;?></title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="stylesheet" href="<?=$url;?>/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=$url;?>/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?=$url;?>/css/maruti-login.css" />
		<script src="<?=$url;?>/js/jquery.min.js"></script>
    </head>
    <body>
		<script>
			$(document).ready(function () {
				$("#loginform").submit(function (e) {   
					var firstForm = $("#loginform").serialize();
					$.ajax({
						url: "<?=$url;?>/ajax/login.php",
						type: 'POST',
						data: firstForm,
						dataType: 'json',
						mimeType: "multipart/form-data",
						//contentType: false,
						cache: false,
						processData: false,
						beforeSubmit: function () {
							$("#loading").show();
						},
						success: function (data) {                     
							if (data.code == 0) {
								//$("#msg_dangnhap").html('<div class="alert alert-success" style="margin-bottom: 0;text-align: center;">Lỗi đăng nhập</div>');
								window.location = data.msg;
								$("#loading").hide();                               
							}
							else {
								$("#msg_dangnhap").html('<div class="alert alert-danger" style="margin-bottom: 0;text-align: center;">' + data.msg +'</div>');
								$("#loading").hide();
							}
						},
						error: function (xhr, ajaxOptions, thrownError) {
							$("#msg_dangnhap").html('<div class="alert alert-danger" style="margin-bottom: 0;text-align: center;">Có lỗi trong quá trình thực hiện</div>');
							$("#loading").hide();
						}
					});
					e.preventDefault();
				});
		
			});
		</script>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" method="post">
				<div class="control-group normal_text"> <h3>Login AdminPanel</h3></div>
				<div id="msg_dangnhap"></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" autocomplete="username" name="username" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" autocomplete="current-password" name="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
				<div id="loading" style="display: none; text-align: center; padding: 0 20px;"><img src="<?=$url;?>/img/loading.gif"/> &nbsp;Xin mời chờ...</div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
							<input type="submit" class="btn btn-primary" value="Login" style="width: 250px; height: 35px;">
						</div>
                    </div>
                </div>
            </form>

        </div>
    </body>

</html>

<?php } ?>