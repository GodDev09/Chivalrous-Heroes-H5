<?php include_once (dirname(__DIR__).$heads); ?>
<?php
$user = $_GET['user'];
$se = "SELECT * FROM gc_user WHERE user = '".$user."'";
$qr = mysqli_query($conn,$se);
$rs = mysqli_fetch_array($qr);
$act = $_GET['gc'];
//var_dump($act);
//exit();
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
	<a href="#" class="tip-bottom">Chỉnh sửa tài khoản</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	<!--
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Thông tin User</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$user = $_POST['user'];
			$pass = md5($_POST['pass']);
			$pass2 = md5($_POST['pass2']);
			$xu = $_POST['xu'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$ban = $_POST['ban'];
			$bantime = $_POST['bantime'];
			$ghichu = $_POST['ghichu'];
			$srv = $_POST['srv'];
			$gm = $_POST['gm'];
			$svgem = $_POST['gem'];
			$blockmail = $_POST['blockmail'];
			if(isset($user) && isset($pass) && isset($xu))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
				if($xu == "" || $ban == "")
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
				elseif($_POST['pass'] != $rs['pass'] && $_POST['pass'] != "")
				{
					@$up = mysqli_query($conn,"UPDATE gc_user SET pass = '".$pass."', pass2 = '".$pass2."' WHERE user = '".$user."'");
					if($up)
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
				elseif($_POST['pass2'] != $rs['pass2'] && $_POST['pass2'] != "")
				{
					@$up = mysqli_query($conn,"UPDATE gc_user SET pass2 = '".$pass2."' WHERE user = '".$user."'");
					if($up)
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
				else
				{
					@$up = mysqli_query($conn,"UPDATE gc_user SET ghichu = '".$ghichu."', srv = '".$srv."', svgem = '".$svgem."', admin = '".$gm."', bantime = '".$bantime."', ban = '".$ban."', blockmail = '".$blockmail."' WHERE user = '".$user."'");
					if($up)
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
                  <input type="text" name="user" value="<?=$rs['user'];?>"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mật khẩu:</label>
                <div class="controls">
                  <input type="text" name="pass" value="<?=$rs['pass'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Mật khẩu cấp 2:</label>
                <div class="controls">
                  <input type="text" name="pass2" value="<?=$rs['pass2'];?>"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Xu:</label>
                <div class="controls">
                  <input type="text" name="xu" value="<?=$rs['xu'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Phone:</label>
                <div class="controls">
                  <input type="text" name="phone" value="<?=$rs['phone'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Email:</label>
                <div class="controls">
                  <input type="text" name="email" value="<?=$rs['email'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">SV Sài GEM:</label>
                <div class="controls">
                  <input type="text" name="gem" value="<?=$rs['svgem'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Active GM: <br/>SRV:</label>
                <div class="controls">
				  <select name="gm">
				  <?php 
				  if($rs['admin'] == "1")
				  {?>
				  <option value="1">Đã kích hoạt</option>
				  <option value="0">Chưa kích hoạt</option>
				  <?php } else { ?>
				  <option value="0">Chưa kích hoạt</option>
				  <option value="1">Đã kích hoạt</option>
				  <?php } ?>
				  </select>
				  <br/>
                  <input type="text" name="srv" value="<?=$rs['srv'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Ghi chú:</label>
                <div class="controls">
                  <input type="text" name="ghichu" value="<?=$rs['ghichu'];?>"/><br/>
				  * Lý do bị khóa tài khoản
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Thời gian mở khóa:</label>
                <div class="controls">
                  <input type="text" name="bantime" value="<?php
				  $time = date('d-m-Y H:i:s');
				  if($rs['bantime'] == "") {echo $time;} else {echo $rs['bantime'];};?>"/><br/>
				  * Thời gian mở khóa
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Khóa tài khoản:</label>
                <div class="controls">
				  <select name="ban">
				  <?php 
				  if($rs['ban'] == 1)
				  {?>
				  <option value="1">Khóa</option>
				  <option value="0">Mở</option>
				  <?php } else { ?>
				  <option value="0">Mở</option>
				  <option value="1">Khóa</option>
				  <?php } ?>
				  </select>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Block Info:</label>
                <div class="controls">
				<select name="blockmail">
                  <?php 
				  if($rs['blockmail'] == "1")
				  {?>
				  <option value="1">Mở</option>
				  <option value="0">Khóa</option>
				  <?php } else { ?>
				  <option value="0">Khóa</option>
				  <option value="1">Mở</option>
				  <?php } ?>
				  </select>
                </div>
              </div>
              <div class="form-actions">
                <button type="reset" name="reset" class="btn btn-success">Làm mới</button>
                <button type="submit" name="submit" class="btn btn-success">Save</button>
              </div>
            </form>
			<?php } ?>
          </div>
		  
        </div>
      </div>
	  -->
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Lịch sử đổi xu</h5>
          </div>
          <div class="widget-content nopadding">
          <div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php
			
			$hist = mysqli_query($conn,"SELECT * FROM gc_logxu WHERE user = '".$_GET['id']."' ORDER BY `createTime` DESC LIMIT 30");
			while($rs = mysqli_fetch_array($hist))
			{?>
				<span>
				❯❯ Tài khoản: <b><?=$rs['user'];?></b> Xu đổi: <b>-<?=number_format($rs['xutru']);?></b> createTime: <b><?=$rs['createTime'];?></b>
				</span><br/>
			<?php } ?>
			</div>
          </div>
        </div>
      </div>
    </div><hr>

  </div>
</div>
<?php } ?>
<?php include_once (dirname(__DIR__).$foots); ?>