<?php include_once (dirname(__DIR__).$heads); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Danh sách máy chủ</a> </div>
  </div>
  <?php
$id = $_GET['id'];
if($_GET['gc'] == "server" && $id != "")
{
$name = $_POST['name'];
$status = $_POST['status'];
$daytime = $_POST['daytime'];
	if(isset($name) && isset($status) && isset($daytime))
	{
		@$sql = mysqli_query($conn,"UPDATE gc_server SET name = '".$name."', status = '".$status."', daytime = '".$daytime."' WHERE id = '".$id."' LIMIT 1");
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
            <h5>Danh sách máy chủ</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>ID</th>
                  <th>NAME</th>
                  <th>Port</th>
                  <th>Status</th>
                  <th>Ngày đăng</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <form action="" method="POST">
			  <?php
			  $sel = "SELECT * FROM gc_server WHERE id = '".$id."'";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><input name="name" value="<?=$rs['name'];?>"/></td>
							  <td><input name="port" value="<?=$rs['port'];?>"/></td>
							  <td><input name="status" value="<?=$rs['status'];?>"/></td>
							  <td><input name="daytime" value="<?=$rs['daytime'];?>"/></td>
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
            <h5>Danh sách code</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>ID</th>
                  <th>NAME</th>
                  <th>Port</th>
                  <th>Status</th>
                  <th>Ngày đăng</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  $sel = "SELECT * FROM gc_server ORDER BY id DESC";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><?=$rs['name'];?></td>
							  <td><?=$rs['port'];?></td>
							  <td><?=$rs['status'];?></td>
							  <td><?=$rs['daytime'];?></td>
							  <td class="center">
							<a style="width: 30px;" href="server-edit-<?=$rs['id'];?>.hga" class="btn btn-primary"> Sửa </a>
							<a style="width: 30px;" href="del-server-id-<?=$rs['id'];?>.hga" class="btn btn-danger"> Xóa </a>
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
<?php include_once (dirname(__DIR__).$foots); ?>