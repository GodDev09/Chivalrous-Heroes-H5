<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
            
            <div class="content">

                <div class="row ">

                    
                    <div class="col">
                        <div>

                            <ul class="nav nav-tabs">
     
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1"><i class="fa fa-lock" aria-hidden="true"></i> Account Info tài khoản</a></li>
                            </ul>
                            <div class="tab-content">

                                <!-- Tab 3 action -->
                                <div class="tab-pane active border border-top-0 p-3" role="tabpanel" id="tab-1">
                                    <p>XU là gì ? và cách sử dụng.</p>
                                    <p>XU là một loại tiền tệ được quy đổi bằng hình thức Topup thẻ hoặc chuyển khoản Momo Or Bank<br/>
									Tiền tệ này được quy đổi để sử dụng trong GAME.</p>
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