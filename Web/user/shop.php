<?php
include "func.php";
?>
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
	<span class="alert-close" data-dismiss="alert"></span><i class="fe-icon-award"></i><b> STORE vật phẩm giới hạn</b><br>
	</div>
	<div id="baiviet"></div>
	<ul class="list-inline" id="pagination" align="center">
	<?php
	$num = $number/7;
	$is = 1;
	do {?>
	<a href="javascript:;" onclick="getItem(<?=$is;?>)"><span class="btn btn-success"><?=$is;?></span></a>
	<?php $is++;} while ($is <= $num)?>
	</ul>
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
$(document).ready(function(){getItem("all");});function  getItem(page){$.get( "/user/api/shop.php?p="+page+"&type=get", function( data ) {$("#baiviet").html(data);});}function serverselect(){ $(document).ready(function(){$("#server-select").change(function(){var serverId = $(this).children("option:selected").val();
$(".modal_loading").show();$.post("/user/api/role.php","server="+serverId+"&type=get",function(result) {$("#roleid").html(result);$("#roleid").show();},)});});}$(document).on("click", ".confirm-received", function () {var pack = $(this).data('pack');var packID = $(this).data('packid');$('#pack').val(pack);$('#packID').val(packID);});
function sendPack(){$(document).ready(function(){var server = $("#server-select").val();var pack = $('#pack').val();var endtime = $('#countdown_task').val();var roleid = $('#roleid').val();$(".modal_loading").show();$.post("/user/ajax/buy","server="+server+"&roleid="+ roleid +"&pack="+pack,function(result) {alert(result);	},).always(function() {setTimeout(function(){ $('#server').modal('hide');},1);});});}
</script>
<?php include "user/foot.php"; ?>
<?php } else { header("Location: login"); } ?>
