<?php
include "func.php";
?>
<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Tài khoản - <?=$title;?></title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/user-style.css">
        <link rel="shortcut icon" href="/assets/img/favicon.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    </head>
<body class="">
        <div></div>
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
              <a class="navbar-brand navbar-brand-centered" href="/">
<img src="/assets/img/mong69.png" width="140px"></a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">
          <i class="fa fa-home"></i>
          Home
          <span class="sr-only">(current)</span>
          </a>
      </li>
      
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-credit-card">
          </i>
          RECHARGE COIN
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/user/paymomo">Topup MoMo</a>
          <a class="dropdown-item" href="/user/paybank">Topup ngân hàng</a>
          <a class="dropdown-item" href="/user/payment">Topup thẻ cào</a>
        </div>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="/user/exchange">
          <i class="fa fa-lg fa-exchange-alt">
          </i>
          Topup Game
        </a>
      </li>
    </ul>
      <ul class="navbar-nav ">
  
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-users"></i>
          Community
        </a>
        <div class="dropdown-menu" aria-labelledby="accountDropdown">
       
          <a target="_blank" href="<?=$page;?>" class="dropdown-item "><i class="fab fa-facebook fa-lg"></i> Fanpage</a>
          <a target="_blank" href="<?=$page;?>" class="dropdown-item "><i class="fab fa-facebook fa-lg"></i> Group</a>

        </div>
      </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-list">
          </i>
          Features
        </a>
        <div class="dropdown-menu" aria-labelledby="accountDropdown">
       
          <a href="/user/payment_log" class="dropdown-item "><i class="fa fa-lg fa-history" aria-hidden="true"></i> Topup History</a>
          <a href="/user/giftcode" class="dropdown-item "><i class="fa fa-lg fa-gift" aria-hidden="true"></i> Giftcode</a>
          <a href="/user/task" class="dropdown-item "><i class="fa fa-lg fa-crosshairs" aria-hidden="true"></i> Tích lũy</a>

        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user">
          </i>
          <span class="niceUsername"><?=$userif;?></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="accountDropdown">
          <a class="dropdown-item" href="/user/change"><i class="fas fa-lg fa-lock"></i> CHANGE PASSWORD</a>
          <a class="dropdown-item" href="/user/info"><i class="fas fa-info fa-lg"></i> Account Info tài khoản</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/user/logout"><i class="fas fa-sign-out-alt fa-lg"></i>
           Logout</a>
        </div>
      </li>
    </ul>

  </div>
</div>
</nav>
<div class="container">
            	<div class="row mb-3 ">
                    	<div class="col-lg-12 col-md-12 mb-lg-0">
					      <!--Card-->
					      <div class="card testimonial-card blue-gradient border-0">
					        <!--Background color-->
					        <div class="card-up"></div>
					        <!--Avatar-->
					        <div class="avatar mx-auto white">
					          <img id="avatar" src="../assets/img/avatar_2x.png" class="rounded-circle img-fluid">
					        </div>
					        <div class="card-body text-center">
					          <!--Name--><div class="verifyShow" id="verifyShow"></div>
					          <h4 class="font-weight-bold mb-4 fullname_txt text-light"><?=$userif;?></h4>
					        </div>
					      </div>
					      <!--Card-->
					    </div>
                       

            </div>