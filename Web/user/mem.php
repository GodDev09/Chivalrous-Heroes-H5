<div class="list-group mb-2">
	  <li class="list-group-item ">
	  <b><i class="fa fa-lg fa-bars" aria-hidden="true"></i> Account Info</b>
	  </li>
	  <li class="list-group-item"><i class="fas fa-user fa-lg" aria-hidden="true"></i>
	  <b class="niceUsername"><?=$userif;?></b></li>
	  <li class="list-group-item"><i class="fas fa-coins fa-lg"></i>
	  <b id="ggcoin"><?=number_format($xu);?> XU</b> <a data-toggle="tooltip" data-html="true" data-placement="right" title="" data-original-title="Xu là gì?" target="_blank" href="/user/xu-la-gi">
	  <i class="text-muted fa fa-question-circle" aria-hidden="true"></i></a>
	<a href="/user/payment">Topup</a></li>
	</div>
<ul class="list-group mb-2">
		<li class="list-group-item"><b><i class="fa fa-lg fa-bars" aria-hidden="true"> </i> Menu</b></li>
		<a href="<?=$urlgame[0];?>/?username=<?=$_SESSION['username'];?>&token=<?php
					$data = '{"user": "'.$_SESSION['username'].'","sign": "'.$signkey.'","token": "'.$token.'"}';
					echo base64_encode($data);
					?>" class="list-group-item list-group-item-action "><i class="fa fa-lg fa-gamepad" aria-hidden="true"></i> Play Game <span class="badge badge-warning">APK</span></span></a>
		<a href="/user/new" class="list-group-item list-group-item-action "><i class="fa fa-lg fa-newspaper" aria-hidden="true"></i> News</a>		
		<a href="/user/pay" class="list-group-item list-group-item-action "><i class="fa fa-lg fa-credit-card" aria-hidden="true"></i> Deposit</a>		
		<a href="/user/exchange" class="list-group-item list-group-item-action "><i class="fas fa-lg fa-exchange-alt" aria-hidden="true"></i> Đổi XU ra <span class="badge badge-warning">KNB</span></a>
		<a href="/user/giftcode" class="list-group-item list-group-item-action "><i class="fa fa-lg fa-gift" aria-hidden="true"></i> Giftcode</a>
		<!--<a href="/user/shop" class="list-group-item list-group-item-action "><i class="fas fa-store" aria-hidden="true"></i> STORE</a>-->
		<a href="/user/task" class="list-group-item list-group-item-action "><i class="fa-lg fas fa-crosshairs" aria-hidden="true"></i> ACCUMULATED TOPUP <span class="badge badge-danger">HOT</span></a>
		<a href="/user/payment_log" class="list-group-item list-group-item-action "><i class="fa fa-lg fa-history" aria-hidden="true"></i> Topup History</a>
	</ul>