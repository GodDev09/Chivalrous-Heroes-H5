<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">
				<div class="col mb-2">
                    <div id="smartwizard" class="sw-main sw-theme-dots stepwizard p-4 border sw-theme-none">
                            <h4><i class="fa fa-money" aria-hidden="true"></i> Deposit qua Momo</h4>
                       
                        <div class="sw-container tab-content" style="min-height: 450px;">
                          
                            <div id="step-2" class="tab-pane step-content" style="display: block;">
                                
                                 <p><b>Bước 1</b>: Bạn hãy  <img width="25" src="" alt=""><b> Quét mã</b> dưới đây bằng ứng dụng <b>Momo</b>.<br>Hoặc chọn mục <b>Chuyển tiền</b> <i class="fa fa-arrow-right"></i> <b>Chuyển tiền đến ví MoMo</b> Nhập số điện thoại:
                                            <span class="badge-warning p-1 font-weight-bold"><?=$momo[0];?></span></p>
                                 <div class="row">
                                  <div class="col-md-12 text-center">
                                      <img src="<?=$momo[1];?>" width="170">
                                      <p><small class="text-muted"></small></p><div class="spinner-border spinner-border-sm text-info"></div><small class="text-muted">
                                            Đang chờ bạn quét ...</small><p></p>
                                 
            </div>
        </div>
        <p><b>Bước 2: Quan trọng</b>:</p>
          <ul style="background-color: #fcf8e3" class="list-group p-3">
                        Nhập Account Info chính xác như sau
                        <li class="list-group-item font-weight-bold">Số tiền : <span id="payment_amount" class="badge-success p-1">Số tiền</span></li>
                        <li class="list-group-item font-weight-bold">Nội dung tin nhắn : <span id="payment_id" class="badge-danger p-1">TTQ-<?=$_SESSION['username'];?></span></li>
                    </ul>
          
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