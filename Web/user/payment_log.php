<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">

                    
                   <div class="col mb-2">
                        <div class="container pt-3">
            <div class="content ">
                <div class="row">                  
                    <div class="col">
                        <div>

                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1"><i class="fa fa-list" aria-hidden="true"></i> Lịch sử Deposit</a></li>
                                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2"><i class="fa fa-question" aria-hidden="true"></i> Trợ giúp</a></li>
             
                            </ul>
                            <div class="tab-content">
                                <!-- Log -->
                               <div class="tab-pane active border border-top-0 p-3" role="tabpanel" id="tab-1">
                                      <div class="table-responsive">  
                                        <table id="memListTable" class="table table-striped table-bordered">


                                              <thead>  
                                                   <tr>  
                                                        <th>ID</th>
                                                        <th>Tài khoản</th>
                                                        <th>Seri</th>
                                                        <th>Mã Pin</th>
                                                        <th>Mệnh giá</th>
                                                        <th>Trạng thái</th>
                                                   </tr>  
                                              </thead>
												<?php
												$i = 1;
												$logx = $conn->query("SELECT * FROM gc_lognap WHERE user = '{$_SESSION[username]}' ORDER BY date LIMIT 10");
												while($rs = mysqli_fetch_array($logx)) { ?>
												<tr>
                                              <td><?=$i++;?></td>
                                              <td><?=$rs['user'];?></td>
                                              <td><?=$rs['seri'];?></td>
                                              <td><?=$rs['pin'];?></td>
                                              <td><?=$rs['menhgia'];?></td>
                                              <td><?php if($rs['status'] == 1) { echo "Đã duyệt"; } elseif($rs['status'] == "-1") { echo "Thẻ lỗi"; } else {echo "Chưa duyệt";};?></td>
											  </tr>
												<?php } ?>
                                         </table>  
                                    </div>
                                </div>
                            
                                <div class="tab-pane border border-top-0 p-3" role="tabpanel" id="tab-2">
                                     <ul class="list-group list-group-flush">
                                    <li class="list-group-item font-weight-bold">Nếu chưa thanh toán hoặc muốn thanh toán lại vui lòng:</li>
                                    <li class="list-group-item">1. Thực hiện chuyển tiền bằng hình thức chọn từ trước (VD Momo, Bank,...)</li>
                                    <li class="list-group-item">2. Chuyển tiền với Số tiền và Nội dung trong phần lịch sử giao dịch</li>
                                    <li class="list-group-item">3. Chờ 2-3 phút để hệ thống kiểm tra và chuyển xu</li>
                                  </ul>
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item font-weight-bold">Mọi thắc mắc vui lòng liên hệ:</li>
                                    <li class="list-group-item">Fanpage: <a target="_blank" href="<?=$page;?>"> <?=$title;?></a></li>
                                    <li class="list-group-item">Email: hgavnh@gmail.com</li>
                                  </ul>

                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item font-weight-bold">Chú thích các trạng thái:</li>
                                    <li class="list-group-item">Chờ thanh toán: hệ thống đang kiểm tra các bạn đã thanh toán chưa</li>
                                    <li class="list-group-item">Đã thanh toán: thanh toán thành công chờ hệ thống thêm xu</li>
                                    <li class="list-group-item">Hoàn thành: giao dịch thành công kiểm tra xu trong tài khoản</li>
                                    <li class="list-group-item">Bị hủy: giao dịch thất bại</li>
                                  </ul>

                                  </div>

                            </div>

                            
                            </div>
                        </div>
                        <div class="col-lg-3 order-lg-first">
                       <!-- left bar -->
					   <?php include "mem.php"; ?>
                    </div>
                    </div>
                </div>
            </div>
                    </div>
  
                    
                </div>

            </div>
        </div>
<?php include "user/foot.php"; ?>
<?php } else { header("Location: login"); } ?>