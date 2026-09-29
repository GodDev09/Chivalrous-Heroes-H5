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
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Danh sách tài khoản ADMIN</a> </div>
  </div>
  <?php
$id = $_GET['id'];
if($_GET['gc'] == "admin" && $_GET['add'] == "admin")
{
	?>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Thêm tài khoản ADMIN</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$user = $_POST['username'];
			$pass = md5($_POST['password']);
			$admin = $_POST['admin'];
			if(isset($user) && isset($pass) && isset($admin))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
			if($user == "" || $pass == "" || $admin == "")
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
				@$up = mysqli_query($conn,"INSERT INTO gc_admin(user,pass,admin) VALUES('{$user}','{$pass}','{$admin}')");
				if($up)
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-success alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Success!</h4>
						 Tạo tài khoản thành công!
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
						 Tạo tài khoản thất bại!
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
                <label class="control-label">Tài khoản:</label>
                <div class="controls">
                  <input type="text" name="username" value="" style="width:80%;"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Mật khẩu:</label>
                <div class="controls">
                  <input type="text" name="password" value="" style="width:80%;"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Quyền:</label>
                <div class="controls">
				<select type="text" name="admin" style="width:81%;">
				<option value="0">Member</option>
				<option value="1">Mod</option>
				<option value="2205">Admin</option>
				</select>
                </div>
              </div> 
              <div class="form-actions" align="center">
                <button type="reset" name="reset" class="btn btn-success">Làm mới</button>
                <button type="submit" name="submit" class="btn btn-success">Thêm Admin</button>
              </div>
            </form>
			<?php } ?>
          </div>
		  
        </div>
      </div>
	  
    </div><hr>

  </div>

<?php }
elseif($_GET['gc'] == "listadmin" && $id != "")
{
$user = $_POST['user'];
$pass = md5($_POST['pass']);
$admin = $_POST['admin'];
	if(!empty($user) && !empty($_POST['pass']) && !empty($admin))
	{
		@$sql = mysqli_query($conn,"UPDATE gc_admin SET pass = '".$pass."', admin = '".$admin."' WHERE user = '".$id."' LIMIT 1");
		if($sql)
		{
		echo '
		<div class="widget-content">
            <div class="alert alert-success alert-block">
			<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
              <h4 class="alert-heading">Success!</h4>
             Cập nhật thành công!
			 </div>
		</div>';
		} else
		{
			echo '
		<div class="widget-content">
            <div class="alert alert-error alert-block">
			<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
              <h4 class="alert-heading">Error!</h4>
             Cập nhật thất bại!
			 </div>
		</div>';
		}
	}
	else
	{
	?>
	<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Danh sách code</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>ID</th>
                  <th>Tài khoản</th>
                  <th>Mật khẩu (Chuẩn Md5)</th>
                  <th>Quyền</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <form action="" method="POST">
			  <?php
			  $sel = "SELECT * FROM gc_admin WHERE user = '".$id."'";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><input name="user" value="<?=$rs['user'];?>"/></td>
							  <td><input type="text" name="pass" value="<?=$rs['pass'];?>"/></td>
							  <td><input name="admin" value="<?=$rs['admin'];?>"/></td>
							  <td class="center">
							  <button style="width: 60px;" type="submit" name="submit" class="btn btn-primary">SAVE</button>
							</td>
							</tr>
			  <?php } ?>
			  </form>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
	<?php } ?>
	
<?php } else {?>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Danh sách tài khoản Admin</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>ID</th>
                  <th>Tài khoản</th>
                  <th>Mật khẩu (Chuẩn Md5)</th>
                  <th>Quyền</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  $sel = "SELECT * FROM gc_admin";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><?=$rs['user'];?></td>
							  <td><?=$rs['pass'];?></td>
							  <td><?php if($rs['admin'] == "2205") {echo "Admin";}else {echo "Member";};?></td>
							  <td class="center">
							<a style="width: 30px;" href="admin-edit-<?=$rs['user'];?>.hga" class="btn btn-primary"> Sửa </a>
							<a style="width: 30px;" href="del-admin-id-<?=$rs['user'];?>.hga" class="btn btn-danger"> Xóa </a>
							</td>
							</tr>
			  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div>
<?php
}
?>
<?php include_once (dirname(__DIR__).$foots); ?>