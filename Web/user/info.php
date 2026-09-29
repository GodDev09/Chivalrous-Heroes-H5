<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">

                    
                   <div class="col">
                        <div>

                            <ul class="nav nav-tabs">
     
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1"><i class="fa fa-lock" aria-hidden="true"></i> Account Info tài khoản</a></li>
                            </ul>
                            <div class="tab-content">

                                <!-- Tab 2 CHANGE PASSWORD -->
                                <div class="tab-pane active border border-top-0 p-3" role="tabpanel" id="tab-1">
								<label for="inputAddress">Tài khoản: <b><?=$_SESSION['username'];?></b></label><br/>
								<label for="inputAddress">XU: <font color="red"><b><?=number_format($xu);?></b></font></label><br/>
								<label for="inputAddress">GEM: <font color="red"><b>Đang nhập nhật</b></font></label><br/>
								<?php if($email != "") { ?>
								<label for="inputAddress">Email: <font color="red"><?=$email;?></font></label><br/>
								<?php } else {?>
                                    <form method="post" onsubmit="ajaxUpdatePassword();return false;">
                                        <div class="form-group">
                                            <label for="inputAddress">Cập nhật Email</label>
                                            <input type="text" name="email" class="form-control" id="currentPasswordChange" placeholder="Nhập Email">
                                        </div>
                                        <center><button type="submit" class="btn btn-primary">Cập nhật</button></center>
                                    </form>
								<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 order-lg-first">
                       <!-- left bar -->
                       	<div class="leftbar">
	<?php include "mem.php"; ?>
</div>                    </div>
                    
                </div>

            </div>
        </div>
<?php include "user/foot.php"; ?>
<?php } else { header("Location: login"); } ?>