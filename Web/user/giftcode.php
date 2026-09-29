<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">

                    
                   <div class="col mb-2">
                        <div>

                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1"><i class="fa fa-list" aria-hidden="true"></i> Trang nhận Quà</a></li>
             
                            </ul>
                            <div class="tab-content">
                                <!-- Tab 1 Account Info tài khoản -->
                                <div class="tab-pane active border border-top-0 p-3" role="tabpanel" id="tab-1">
								<div class="alert alert-warning alert-dismissible">
								  <button type="button" class="close" data-dismiss="alert">×</button>
								  <strong>Lưu ý!</strong> Copy mã copy bên dưới vào mục nhận Code trong game để nhận
								</div>
									 <strong>Danh sách CODE có thể sử dụng</strong><br/>
									 <?=$danhsachcode;?>
                                </div>
                               <!-- list game -->
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