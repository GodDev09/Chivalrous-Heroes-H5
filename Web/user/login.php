<?php
include "func.php";
if(isset($_SESSION['username']))
{
	header("Location: /user/");
}
else
{
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="shortcut icon" href="../favicon.ico">
    <meta name="description" content="<?=$title;?> Chibi graphics, new tactical gameplay, large community, true entertainment. Play on any browser without installation." />
    <title>Account Login | <?=$title;?></title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
	html,
		body {
		  height: 100%;
		  background-image: url('../banner2.jpg');
		  background-position: center;
		}

		body {
		  display: -ms-flexbox;
		  display: flex;
		  -ms-flex-align: center;
		  align-items: center;
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #f5f5f5;
		}

		.form-signin {
		  width: 100%;
		  max-width: 430px;
		  margin: auto;
		}
		.form-signin .checkbox {
		  font-weight: 400;
		}
		.form-signin .form-control {
		  position: relative;
		  box-sizing: border-box;
		  height: auto;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-signin .form-control:focus {
		  z-index: 2;
		}


		.form-signup {
		  width: 100%;
		  max-width: 330px;
		  padding: 15px;
		  margin: auto;
		}
		.form-signup .checkbox {
		  font-weight: 400;
		}
		.form-signup .form-control {  
		  position: relative;
		  box-sizing: border-box;
		  height: auto;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-signup .form-control:focus {
		  z-index: 2;
		}

		.avatar {
			margin-top: -75px;
			margin-left: auto;
			margin-right: auto;
			left: 0;
			right: 0;
			width: 95px;
			height: 95px;
			border-radius: 50%;
			z-index: 9;
			background: #70c5c0;
			padding: 15px;
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
		}
		.avatar img {
			width: 100%;
		  } 
		.btn {
			color: #fff;
			border-radius: 4px;
			background: #60c7c1;
			text-decoration: none;
			transition: all 0.4s;
			line-height: normal;
			border: none;
		}
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
    </style>
    <!-- Custom styles for this template -->
  </head>
  <body class="text-center">
    <script type="text/javascript">
    function ajaxLogin() {
      var username = $("#username").val();
      var password = $("#password").val();
      if (!username) {
        $("#msg").addClass("text-danger ").html('<i class="fa fa-close" aria-hidden="true"></i> Please enter username');
        $("#username").focus();
      } else if (!password) {
        $("#msg").addClass("text-danger").html('<i class="fa fa-close" aria-hidden="true"></i> Please enter password');
        $("#password").focus();
      }
      else
      {
        $.post('/user/ajax/login', {username:username,password:password,}, function (result){
            if(result.status){
              $("#msg").html('<i class="fa fa-check" aria-hidden="true"></i>  Login successful!').removeClass("text-danger").addClass("text-success");
              setTimeout(function(){
                window.location.href = '/user/';
              }, 1000);
            }
            else{
              $("#msg").addClass("text-danger").html('<i class="fa fa-close" aria-hidden="true"></i> '+result.msg);
            }
          },
          'JSON'
        );
      }
    }
  </script>
  <form method="post" onsubmit="ajaxLogin();return false;" class="form-signin">
    <div class="bg-light border rounded p-4 m-3">
      <div class="avatar">
          <img src="/assets/img/avatar.png" alt="Avatar">
        </div>

  <h1 class="h3 m-3 font-weight-normal">Login</h1>

  <div class="form-row align-items-center">
    <div class="col-12">
      <label class="sr-only" for="inlineFormInputGroup">Enter username</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
        </div>
        <input type="text" id="username" name="username" class="form-control" id="inlineFormInputGroup" placeholder="Enter username">
      </div>
    </div>
    <div class="col-12">

      
      <label class="sr-only" for="inlineFormInputGroup">Enter password</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
        </div>
        <input type="password" id="password" name="password" class="form-control" id="inlineFormInputGroup" placeholder="Enter password">
      </div>
    </div>
  </div>

    <span id="msg"></span>
  
  <button class="btn btn-lg btn-info btn-block" type="submit">Login</button></form>
    <hr>
    <div class="row">

      <div class="col-12"><p class=" text-center">Don't have an account? <a href="/user/register"> Register</a></p></div>
          </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>
<?php } ?>