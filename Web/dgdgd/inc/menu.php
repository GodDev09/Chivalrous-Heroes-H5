<?php include_once (dirname(__DIR__).$heads); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Danh sách máy chủ</a> </div>
  </div>
  <?php
$id = $_GET['id'];
if($_GET['gc'] == "menu" && $id != "")
{
$name = $_POST['name'];
$url = $_POST['url'];
	if(isset($name) && isset($url))
	{
		@$sql = mysqli_query($conn,"UPDATE gc_menu SET name = '".$name."', url = '".$url."' WHERE id = '".$id."' LIMIT 1");
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
            <h5>Danh sách MENU</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>ID</th>
                  <th>Tên Chuyên Mục</th>
                  <th>Đường Dẫn</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <form action="" method="POST">
			  <?php
			  $sel = "SELECT * FROM gc_menu WHERE id = '".$id."'";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><input name="name" value="<?=$rs['name'];?>"/></td>
							  <td><input name="url" value="<?=$rs['url'];?>"/></td>
							  <td class="center">
							  <button style="width: 60px;" type="submit" name="submit" class="btn btn-primary">LƯU</button>
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
            <h5>Danh sách MENU</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>ID</th>
                  <th>Tên Chuyên Mục</th>
                  <th>Đường Dẫn</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  $sel = "SELECT * FROM gc_menu ORDER BY id ASC";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><?=$rs['name'];?></td>
							  <td><?=$rs['url'];?></td>
							  <td class="center">
							<a style="width: 30px;" href="menu-edit-<?=$rs['id'];?>.hga" class="btn btn-primary"> Sửa </a>
							<a style="width: 30px;" href="del-menu-id-<?=$rs['id'];?>.hga" class="btn btn-danger"> Xóa </a>
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