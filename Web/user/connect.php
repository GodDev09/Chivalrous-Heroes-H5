<?php
include "func.php";
?>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="shortcut icon" href="/assets/img/favicon.png">
    <meta name="description" content="<?=$title;?> đồ họa chibi, lối chơi chiến thuật mới lạ, Community đông đảo, giải trí đích thực. Chơi trên mọi trình duyệt không cần cài đặt." />
    <title>Liên kết tài khoản | <?=$title;?></title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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
    <link href="/assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <script type="text/javascript">
    function ajaxLogin() {
      var uid = $("#uid").val();
      var username = $("#username").val();
      var password = $("#password").val();
      if (!uid) {
        $("#msg").addClass("text-danger ").html('<i class="fa fa-close" aria-hidden="true"></i> Vui lòng nhập ID nhân vật');
        $("#uid").focus();
      }else if (!username) {
        $("#msg").addClass("text-danger ").html('<i class="fa fa-close" aria-hidden="true"></i> Vui lòng nhập tên đăng nhập');
        $("#username").focus();
      } else if (!password) {
        $("#msg").addClass("text-danger").html('<i class="fa fa-close" aria-hidden="true"></i> Vui lòng nhập mật khẩu');
        $("#password").focus();
      }
      else
      {
        $.post('/user/ajax/connect', {uid:uid,username:username,password:password,}, function (result){
            if(result.status){
              $("#msg").html('<i class="fa fa-check" aria-hidden="true"></i>  Tài khoản của bạn đã được gửi kích hoạt thành công!').removeClass("text-danger").addClass("text-success");
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

  <h1 class="h3 m-3 font-weight-normal">Đăng nhập</h1>

  <div class="form-row align-items-center">
    <div class="col-12">
      <label class="sr-only" for="inlineFormInputGroup">Nhập ID Nhân vật</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
        </div>
        <input type="text" id="uid" name="uid" class="form-control" id="inlineFormInputGroup" placeholder="Nhập ID nhân vật">
      </div>
    </div>
	<div class="col-12">
      <label class="sr-only" for="inlineFormInputGroup">Nhập tài khoản</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
        </div>
        <input type="text" id="username" name="username" class="form-control" id="inlineFormInputGroup" placeholder="Nhập tài khoản">
      </div>
    </div>
    <div class="col-12">      
      <label class="sr-only" for="inlineFormInputGroup">Nhập mật khẩu</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
        </div>
        <input type="password" id="password" name="password" class="form-control" id="inlineFormInputGroup" placeholder="Nhập mật khẩu">
      </div>
    </div>
  </div>

    <span id="msg"></span>
  
  <button class="btn btn-lg btn-info btn-block" type="submit">Đăng nhập</button></form>
    <hr>
    <div class="row">

      <div class="col-6"><p class=" text-center"><a href="/user/forgot">Quên mật khẩu?</a></p></div>

      <div class="col-6"><p class=" text-center"><a href="/user/connect"> Liên kết tài khoản</a></p></div>
          </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>