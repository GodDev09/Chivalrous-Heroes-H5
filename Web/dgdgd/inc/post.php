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
	<a href="#" class="tip-bottom">Tạo bài viết</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Tạo bài viết mới</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$title = $_POST['tieude'];
			$url = $_POST['url'];
			$act = $_POST['act'];
			$date = date('d-m');
			$noidung = $_POST['noidung'];
			if(isset($title) && isset($url))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
			if($title == "" || $url == "")
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
			@$up = mysqli_query($conn,"INSERT INTO gc_post(tieude,url,noidung,act,date) VALUES('{$title}','{$url}','{$noidung}','{$act}','{$date}')");
				if($up)
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-success alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Success!</h4>
						 Đăng bài viết thành công!
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
						 Đăng bài viết thất bại!
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
                <label class="control-label">Tiêu đề:</label>
                <div class="controls">
                  <input type="text" name="tieude" value="" style="width:80%;"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">URL:</label>
                <div class="controls">
                  <input type="text" name="url" value="" style="width:40%;"/>
				  <select type="text" name="act" style="width:40%;">
				<option value="0">Không kích</option>
				<option value="1">Kích hoạt</option>
				</select>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Nội dung:</label>
                <div class="controls">
				<textarea type="text" name="noidung" style="width:80%;"></textarea>
                </div>
              </div>
              <div class="form-actions" align="center">
                <button type="reset" name="reset" class="btn btn-success">Làm mới</button>
                <button type="submit" name="submit" class="btn btn-success">Đăng bài</button>
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