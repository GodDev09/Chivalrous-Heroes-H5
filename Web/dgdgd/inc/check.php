<?php include_once (dirname(__DIR__).$heads); ?>
<?php
if(!$_SESSION['useradmin'] && $admin != "2205")
{
	echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="/"</script>';
}
else
{
?>
<?php
$user = trim($_POST['user']);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Danh sách tài khoản</a> </div>
  </div>
  <div class="dataTables_filter">
<form action="" method="POST">
<label>Tìm kiếm: <input type="text" name="user"> <button class="btn primary"><i class="icon-search icon-white"></i></button></label>
</form>
</div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Danh sách tài khoản</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>Tài khoản</th>
                  <th>XU</th>
                  <th>Email</th>
                  <th>Ngày tạo</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  $sel = "SELECT * FROM gc_user WHERE user = '".$user."'";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['user'];?></td>
							  <td><?=number_format($rs['xu']);?></td>
							  <td><?=$rs['email'];?></td>
							  <td><?=$rs['createTime'];?></td>
							</tr>
			  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
<?php } ?>
<?php include_once (dirname(__DIR__).$foots); ?>