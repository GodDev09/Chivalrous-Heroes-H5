<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">

                    
                   <div class="col mb-2">
                       <div id="smartwizard" class="sw-main sw-theme-dots stepwizard p-4 border sw-theme-none">
                            <h4><i class="fa fa-money" aria-hidden="true"></i> Deposit qua Ngân hàng 
</h4>
                        <div class="sw-container tab-content" style="min-height: 457px;">
                            <div id="step-2" class="tab-pane step-content" style="display: block;">
                              
        <p><b>Thực hiện chuyển tiền (Quan trọng)</b>:</p>
          <ul style="background-color: #fcf8e3" class="list-group p-3">
                        Chuyển tiền tới tài khoản ngân hàng sau
                        <li class="list-group-item font-weight-bold">Ngân hàng: <?=$bank['0'];?></li>
                        <li class="list-group-item font-weight-bold">Tên chủ khoản: <span class="badge-info p-1"><?=$bank['1'];?></span></li>
                        <li class="list-group-item font-weight-bold">Chi nhánh: <span class="badge-info p-1"><?=$bank['2'];?></span></li>
                        <li class="list-group-item font-weight-bold">Số tài khoản: <span class="badge-info p-1"><?=$bank['3'];?></span></li>
                        <li class="list-group-item font-weight-bold">Số tiền: <span id="payment_amount" class="badge-success p-1">Số tiền</span></li>
                        <li class="list-group-item font-weight-bold">Nội dung: <span id="payment_id" class="badge-danger p-1">DK-<?=$_SESSION['username'];?></span></li>
                    </ul>
                            </div>
                            <div id="step-1" class="tab-pane step-content" style="display: none;">
                                <div class="alert alert-info" style="margin:10px 0 15px 0; /*padding:5px 5px 5px 15px;*/">
                                <i class="fa fa-info-circle"></i> <a target="_blank" href="#">Topup qua Ngân hàng được hưởng thêm 30% giá trị.</a>
                                 </div>
                                                           <div class="row">

                               

                              </div>
                               

    
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