<?php if(isset($_SESSION['username'])){?>
<?php
include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">

                    
                   <div class="col mb-2">
                        <div>

                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1"><i class="fa fa-list" aria-hidden="true"></i> Topup thẻ cào</a></li>
             
                            </ul>
                            <div class="tab-content">
                                <!-- Tab 1 Account Info tài khoản -->
                                <div class="tab-pane active border border-top-0 p-3" role="tabpanel" id="tab-1">
								<div class="alert alert-warning alert-dismissible">
								  <button type="button" class="close" data-dismiss="alert">×</button>
								  <strong>Lưu ý!</strong> Vui lòng chọn đúng mệnh giá, seri thẻ và nhà mạng nếu không sẽ bị mất thẻ (không hỗ trợ), thẻ Topup có thể bị trễ, chờ trong ít phút hoặc liên hệ admin để được trợ giúp!<br/>
								  Tỉ lệ qui đổi: 10.000 Card = 10.000 XU<br/>
								  Qui đổi: 20k Xu = 50.000 KNB
								</div>
                   
                                    <form id="napform" method="post">
                                        <div class="form-group">
										<input name="username" value="<?=$_SESSION['username'];?>" hidden>
                                            <label for="inputAddress2">Loại thẻ</label>
                                            <select id="cardType" name="cardType" class="form-control">
												<option value=""> - Chọn loại thẻ -</option>
												<option value="VTT">Viettel</option>
												<option value="VNP">Vinaphone</option>
												<option value="VMS">Mobifone</option>
												<option value="ZING">Zing</option>
                                                
                                            </select>
											<small class="text-muted">Các thẻ ưu tiên sẽ được +10% giá trị thẻ Topup (VD: 100k sẽ nhận được 110k xu)</small>
                                        </div>
					
                                         <div class="form-group">
                                            <label for="inputAddress2">Mệnh giá</label>
                                            <select id="cardValue" name="cardValue" class="form-control">
                                                    <option value="">- Chọn mệnh giá -</option>
                                                    <option value="10000">10.000 VNĐ</option>
                                                    <option value="20000">20.000 VNĐ</option>
                                                    <option value="30000">30.000 VNĐ</option>
                                                    <option value="50000">50.000 VNĐ</option>
                                                    <option value="100000">100.000 VNĐ</option>
                                                    <option value="200000">200.000 VNĐ</option>
                                                    <option value="300000">300.000 VNĐ</option>
                                                    <option value="500000">500.000 VNĐ</option>
                                                    <option value="1000000">1.000.000 VNĐ</option>
                                                </select>
                                            </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFullname">Số seri</label>
                                                <input id="cardSeri" name="cardSeri" type="text" class="form-control" placeholder="Nhập số seri">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Mã thẻ</label>
                                                <input id="cardCode" name="cardCode" type="text" class="form-control" placeholder="Nhập mã thẻ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <span id="msg_nap"></span>
                                        </div>
                                       
                                        <center><button type="submit" class="btn btn-info">Topup thẻ</button></center>
                                    </form>
                                </div>
                               <!-- list game -->
<script>
			$(document).ready(function () {
				$("#napform").submit(function (e) {   
					var firstForm = $("#napform").serialize();
					$.ajax({
						url: "/user/ajax/apinap",
						type: 'POST',
						data: firstForm,
						dataType: 'json',
						mimeType: "multipart/form-data",
						//contentType: false,
						cache: false,
						processData: false,
						beforeSubmit: function () {
							$("#loading").show();
						},
						success: function (data) {                     
						if (data.code == 0) {
								window.location = data.msg;
								$("#loading").hide();                               
							}
							else {
								$("#msg_nap").html('<div class="alert alert-danger" style="margin-bottom: 0;text-align: center;">' + data.msg + '</div>');
								$("#loading").hide();
							}
						},
						error: function (xhr, ajaxOptions, thrownError) {
							$("#msg_nap").html('<div class="alert alert-danger" style="margin-bottom: 0;text-align: center;">Có lỗi trong quá trình thực hiện</div>');
							$("#loading").hide();
						}
					});
					e.preventDefault();
				});
		
			});
		</script>
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