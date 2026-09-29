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
	<a href="#" class="tip-bottom">Thêm máy chủ</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Thêm máy chủ</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$id = $_POST['id'];
			$name = $_POST['name'];
			$port = $_POST['port'];
			$status = $_POST['status'];
			$daytime = $_POST['daytime'];
			$opentime = $_POST['opentime'];
			if(isset($id) && isset($name) && isset($status) && isset($daytime))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
			if($id == "" || $name == "" || $daytime == "")
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
				@$up = mysqli_query($conn,"INSERT INTO gc_server(id,name,status,daytime,open,port) VALUES('{$id}','{$name}','{$status}','{$daytime}','{$opentime}','{$port}')");
				if($up)
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-success alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Success!</h4>
						 Thêm Server thành công!
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
						 Thêm Server thất bại!
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
                <label class="control-label">ID Máy chủ:</label>
                <div class="controls">
                  <input type="text" name="id" value="" style="width:80%;"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Tên máy chủ:</label>
                <div class="controls">
                  <input type="text" name="name" value="" style="width:80%;"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Port:</label>
                <div class="controls">
                  <input type="text" name="port" value="" style="width:80%;"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Tình trạng:</label>
                <div class="controls">
				<select name="status" style="width:81.3%;">
				<option value="1">NEW</option>
				<option value="0">THƯỜNG</option>
				</select>
                </div>
              </div> 
			  <div class="control-group">
                <label class="control-label">Ngày đăng:</label>
                <div class="controls">
                  <input type="text" name="daytime" value="<?=date('d-m-Y H:i:s');?>" style="width:80%;"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Ngày mở:</label>
                <div class="controls">
                  <input type="text" name="opentime" value="<?=date('d-m-Y H:i:s');?>" style="width:80%;"/>
                </div>
              </div>
              <div class="form-actions" align="center">
                <button type="reset" name="reset" class="btn btn-success">Làm mới</button>
                <button type="submit" name="submit" class="btn btn-success">Thêm Máy Chủ</button>
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