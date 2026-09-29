<?php include_once (dirname(__DIR__).$heads); ?>
<?php
if(!$_SESSION['useradmin'] && $admin != "2205")
{
	echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="/"</script>';
}
else
{
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a>
	<a href="#" class="tip-bottom">Cộng điểm nạp qua MOMO</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Thông tin User</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$user = $_POST['user'];
			$time = date('d-m-Y H:i:s');
			$times = date('d-m-Y');
			$diem = $_POST['diem'];
			$mocnap = $tile*1.3;
			$diemcong = $diem*$mocnap;
			if(isset($user) && isset($diem))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
			if($user == "" || $diem == "")
			{
				echo '
					<div class="widget-content">
						<div class="alert alert-error alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Error!</h4>
						 Một số trường còn bỏ trống!
						 </div>
					</div>';
			}
			else
			{
				@$log = $conn->query("INSERT INTO gc_logcongxu(admin,user,xucong,createTime) VALUES ('{$_SESSION[useradmin]}','{$user}', '{$diemcong}' ,'{$time}')");
				@$up = mysqli_query($conn,"INSERT gc_lognap(user,menhgia,pin,seri,createTime,date,status,gia) VALUES ('{$user}','{$diem}','MOMO','MOMO','{$time}','{$times}','1','1')");
				@$upxu = mysqli_query($conn,"UPDATE account SET xu = xu + '{$diemcong}' WHERE username = '".$user."'");
				if($up && $log && $upxu)
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-success alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Success!</h4>
						 Cập nhật tài khoản thành công!
						 </div>
					</div>';
				}
				else
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-error alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Error!</h4>
						 Cập nhật tài khoản thất bại!
						 </div>
					</div>';
				}
				
			}
			?>
			</div>
			<?php 
			}
			else
			{?>
            <form action="" method="post" class="form-horizontal">
              <div class="control-group">
                <label class="control-label">Tài khoản:</label>
                <div class="controls">
                  <input type="text" name="user" value="" style="width:80%;"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Thêm điểm:</label>
                <div class="controls">
                  <input type="text" name="diem" value="0" style="width:80%;"/>
                </div>
              </div>
			 
              <div class="form-actions" align="center">
                <button type="reset" name="reset" class="btn btn-success">Làm mới</button>
                <button type="submit" name="submit" class="btn btn-success">Save</button>
              </div>
            </form>
			<?php } ?>
          </div>
		  
        </div>
      </div>
	  
    </div><hr>

  </div>
</div>
<?php } ?>
<?php include_once (dirname(__DIR__).$foots); ?>