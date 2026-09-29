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
	<a href="#" class="tip-bottom">Thêm MENU</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Thêm MENU</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$name = $_POST['name'];
			$url = $_POST['url'];
			if(isset($url) && isset($name))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
			if($url == "" || $name == "")
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
				@$up = mysqli_query($conn,"INSERT INTO gc_menu(name,url) VALUES('{$name}','{$url}')");
				if($up)
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-success alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Success!</h4>
						 Thêm MENU thành công!
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
						 Thêm MENU thất bại!
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
            <form action="" method="POST" class="form-horizontal">
			  <div class="control-group">
                <label class="control-label">Tên MENU:</label>
                <div class="controls">
                  <input type="text" name="name" value="" style="width:80%;"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Đường dẫn:</label>
                <div class="controls">
                  <input type="text" name="url" value="" style="width:80%;"/>
				  <br/>Ví du: /user/payment
                </div>
              </div>
              <div class="form-actions" align="center">
                <button type="reset" name="reset" class="btn btn-success">Làm mới</button>
                <button type="submit" name="submit" class="btn btn-success">Thêm MENU</button>
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