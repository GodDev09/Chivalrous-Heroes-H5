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
	<a href="#" class="tip-bottom">Tạo mã GiftCode</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Thông tin mã GiftCode</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$code = $_POST['code'];
			$sid = $_POST['sid'];
			$item = $_POST['item'];
			if(isset($code) && isset($sid) && isset($item))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
			if($code == "" || $sid == "" || $item == "")
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
				@$up = mysqli_query($conn,"INSERT gc_giftcode(giftcode,server,item) VALUES ('{$code}','{$sid}','{$item}')");
				if($up)
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-success alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Success!</h4>
						 Tạo mã GiftCode thành công!
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
						 Tạo mã GiftCode thất bại!
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
                <label class="control-label">Mã GiftCode:</label>
                <div class="controls">
                  <input type="text" name="code" value="" style="width:80%;"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Máy chủ:</label>
                <div class="controls">
				<select name="sid" type="text" style="width:80%;">
				<option value=""> -- Chọn máy chủ -- </option>
				<?php
				$quer = $conn->query("SELECT * FROM gc_server");
				while($rs = mysqli_fetch_array($quer))
				{?>
				<option value="<?=$rs['id'];?>"><?=$rs['name'];?></option>
				<?php } ?>
                 </select>
                </div>
              </div>
			 <div class="control-group">
                <label class="control-label">Vật phẩm:</label>
                <div class="controls">
                  <input type="text" name="item" value="" style="width:80%;"/><br/><br/>
				  Ví dụ: <strong>[{"type":1,"id":2,"num":99999},{"type":1,"id":30001007,"num":30},{"type":1,"id":30001201,"num":50}] ~> đổi số lượng y vậy không được hơn</strong>
                </div>
              </div>
              <div class="form-actions" align="center">
                <button type="reset" name="reset" class="btn btn-success">Làm mới</button>
                <button type="submit" name="submit" class="btn btn-success">Tạo Mã Code</button>
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