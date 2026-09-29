<?php if(isset($_SESSION['username'])){?>
<?php
include "user/head.php";
?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">
                   <div class="col mb-2">
                      
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                       
                       <div class="result"><script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
    <div class="alert alert-info alert-dismissible fade show text-center mb-30 mt-2">
	<span class="alert-close" data-dismiss="alert"></span><i class="fe-icon-award"></i><b> Sự Kiện Tích Lũy Deposit Mừng Máy Chủ Mới</b><br>
	Điểm bạn đang có là: <font color="red"><?=number_format($xunap);?> Điểm</font><br/>
	Bắt đầu: <?=date('d-m-Y H:i:s',strtotime($starttime));?> -
	Kết thúc: <?=date('d-m-Y H:i:s',strtotime($endtime));?><br>
	Thời gian còn lại: <span id="countdown_task"></span>
	
	</div>
	<?php
	$moc = $conn->query("SELECT * FROM gc_mocqua");
	while($rs = mysqli_fetch_array($moc))
	{?>
  	<!-- Event Item-->
    <div class="cart-item d-md-flex justify-content-between">  <div>
            <div class="cart-item-product" href="#">
                <div class="cart-item-product-thumb"><img src="<?=$rs['img'];?>" alt="Tích lũy"></div>
                <div class="cart-item-product-info">
                    <h4 class="cart-item-product-title"><?=$rs['title'];?></h4>
					<p>
					<?=$rs['con'];?>
					</p>
                </div>

            </div>
        </div>
		<div class="text-center">
            <div class="cart-item-label">Đã Topup</div><span class="text-xl font-weight-medium"><b class="text-success"><?=number_format($xunap);?>/<?=number_format($rs['diem']);?></b></span>
        </div>

        <div class=" text-center">
	<div class="cart-item-label">Trạng thái</div><span class="text-xl font-weight-medium">
	<span class="text-info">
	<?php
	$mocqua = $conn->query("SELECT * FROM gc_mocqualog WHERE logid = '".$rs['id']."' AND date = '".$time."' AND user = '".$_SESSION[username]."'")->fetch_assoc()['status'];
	if($mocqua == 1)
	{
		echo "Đã nhận";
	}
	else
	{
	$checkmoc = $conn->query("SELECT * FROM gc_mocqua WHERE id = '".$rs['id']."'")->fetch_assoc()['diem'];
	?>
	<?php if($xunap < $checkmoc)
	{ echo "Chưa đạt"; } else { ?>
	<button href="#server" data-toggle="modal" data-pack="<?=$rs['id'];?>" data-packid="<?=$rs['id'];?>" class="confirm-received btn btn-success text-light">Đạt Mốc</button>
	<?php } } ?>
	</span></span>
	</span>
	</span>
        </div>
    </div>
    	<!-- Event Item-->
	<?php } ?>
	<!-- Choose Server Modal HTML -->
<div id="server" class="modal" tabindex="-1">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">
     
        <h4 class="modal-title">Chọn máy chủ nhận vật phẩm</h4> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
					  <form method="POST">
					  <input type="hidden" id="pack">
					  <input type="hidden" id="packID">
							<div class="form-group p-3">
                                <select onclick="serverselect()" id="server-select" name="server" class="form-control">
								<option value="">- Vui lòng chọn -</option>
							<?php
												$svid = $conn->query("SELECT * FROM gc_server");
												while($rs = mysqli_fetch_array($svid))
												{ ?>
												<option value="<?=$rs['id'];?>"><?=$rs['name'];?></option>
												<?php } ?>
								</select>
                              </div>

							  <div class="form-group pr-3 pl-3">
                                <select id="roleid"  name="roleid" class="form-control">
								 </select>
								<br/>
								<small class="text-muted">* Vui lòng kiểm tra đúng tên nhân vật</small>
                              </div>
							 
							  </form>
							  <div class="text-center mb-3">
							  <button type="submit" href="javascript:;" onclick="sendPack()" class="btn btn-info"> Xác nhận</button>
							  </div><div class="modal-footer">Vui lòng chọn máy chủ                                       </div>
	  
    </div>
  </div>
</div></div>

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
		<script>
function serverselect(){ 
$(document).ready(function(){
    $("#server-select").change(function(){
        var serverId = $(this).children("option:selected").val();
        $(".modal_loading").show();
			$.post("/user/api/role.php","server="+serverId+"&type=get",
			function(result) {
				//if (result.status == '0') {
					//alert(result);
					$("#roleid").html(result);
					$("#roleid").show();
			//	}
				
			},
		//	'JSON'
			
			)
    });
});
}
//
$(document).on("click", ".confirm-received", function () {
			 var pack = $(this).data('pack');
			 var packID = $(this).data('packid');
			 $('#pack').val(pack);
			 $('#packID').val(packID);
			 
		});
//
function sendPack(){
	$(document).ready(function(){
        var server = $("#server-select").val();
        var pack = $('#pack').val();
		var endtime = $('#countdown_task').val();
		var roleid = $('#roleid').val();
        $(".modal_loading").show();
			$.post("/user/ajax/task","server="+server+"&roleid="+ roleid +"&pack="+pack,
			function(result) {
				//if (result.status == '0') {
					alert(result);
			//	}
				
			},
		//	'JSON'
			
			).always(function() {
				setTimeout(function(){ $('#server').modal('hide');},1);
			});
});
}
</script>
<script>
	// Set the date we're counting down to
	var countDownDate_task = new Date("<?=$endtime;?>").getTime();

	// Update the count down every 1 second
	var x_task = setInterval(function() {

	  // Get today's date and time
	  var now_task = new Date().getTime();
		
	  // Find the distance between now and the count down date
	  var distance_task = countDownDate_task - now_task;
		
	  // Time calculations for days, hours, minutes and seconds
	  var days_task = Math.floor(distance_task / (1000 * 60 * 60 * 24));
	  var hours_task = Math.floor((distance_task % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes_task = Math.floor((distance_task % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds_task = Math.floor((distance_task % (1000 * 60)) / 1000);
		
	  // Output the result in an element with id="demo"
	  if(document.getElementById("countdown_task")){
	  document.getElementById("countdown_task").innerHTML =  days_task + " ngày " + hours_task + " giờ "
	  + minutes_task + " phút " + seconds_task + " giây ";
	  }
		
	  // If the count down is over, write some text 
	  if (distance_task < 0) {
		clearInterval(x_task);
		document.getElementById("countdown_task").innerHTML = "EXPIRED";
	  }
	}, 1000);
	</script>
<?php include "user/foot.php"; ?>
<?php } else { header("Location: login"); } ?>