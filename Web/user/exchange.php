<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">

                    
                   <div class="col mb-2">
                        <div>

                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1"><i class="fa fa-list" aria-hidden="true"></i> Chuyển XU vào game</a></li>
             
                            </ul>
                            <div class="tab-content">
                                <!-- Tab 1 Account Info tài khoản -->
                                <div class="tab-pane active border border-top-0 p-3" role="tabpanel" id="tab-1">
								<div class="alert alert-warning alert-dismissible">
								  <button type="button" class="close" data-dismiss="alert">×</button>
								  <strong>Lưu ý!</strong> Chọn đúng máy chủ cần nhận XU, để tránh sai khi chuyển XU vào nhân vật!
								</div>
                                    * Features hoạt động Ingame bạn RECHARGE COIN xong vào trong game mua gói mà bạn cần mua.<br/>
									* Mọi thắc mắc bạn có thể Inbox Fanpage để được hỗ trợ<br/>
									* Fanpage: <a href="<?=$page;?>"><?=$page;?></a>
									<br/>
									* Các mốc đổi xu hiện có.<br/>
									<?php
									$queryx = $conn->query("SELECT * FROM gc_shop ORDER BY name DESC");
									while($s = mysqli_fetch_array($queryx)) {
										echo "<b>+ ".$s['name']."</b><br/>";
									}
									?>
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