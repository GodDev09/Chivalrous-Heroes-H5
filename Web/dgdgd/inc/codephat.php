<?php include_once (dirname(__DIR__).$heads); ?>
<?php
if(!$_SESSION['useradmin'] && $_SESSION['admin'] != "2205")
{
	echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="/"</script>';
}
else
{
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a>
	<a href="#" class="tip-bottom">Danh sách mã CODE</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Danh sách mã CODE</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$code= $_POST['code'];
			if(isset($code))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
			if($code == "")
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
				@$up = mysqli_query($conn,"UPDATE gc_code SET code = '{$code}' WHERE id = '1'");
				if($up)
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-success alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Success!</h4>
						  Chỉnh sửa mã CODE thành công!
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
						  Chỉnh sửa mã CODE thất bại!
						 </div>
					</div>';
				}
			}
			?>
			</div>
			<?php 
			}
			else
			{
			$slop = mysqli_query($conn,"SELECT * FROM gc_code WHERE id = '1'");
			$op = mysqli_fetch_array($slop);
			?>
            <form action="" method="POST" class="form-horizontal">
			<div class="control-group">
                <label class="control-label"><strong>Danh sách Code</strong></label>
                <div class="controls">
				  <textarea type="text" name="code" style="width:80%;height:350px;"><?=$op['code'];?></textarea>
                </div>
              </div>
			
		
              <div class="form-actions" align="center">
                <button type="submit" name="submit" class="btn btn-success">LƯU THAY ĐỔI</button>
              </div>
            </form>
			<?php } ?>
          </div>
		  
        </div>
      </div>
	  
    </div><hr>

  </div>
</div>
<?php }  ?>
<?php include_once (dirname(__DIR__).$foots); ?>