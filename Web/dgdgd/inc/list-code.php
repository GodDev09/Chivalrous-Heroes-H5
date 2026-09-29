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
	<a href="#" class="current">Danh sách GiftCode đã tạo</a> </div>
  </div>
<?php
$id = $_GET['id'];
if($_GET['gc'] == "list-code" && $id != "")
{
$giftcode = $_POST['giftcode'];
$item = $_POST['item'];
	if(!empty($giftcode) && !empty($item))
	{
		@$sql = mysqli_query($conn,"UPDATE gc_giftcode SET giftcode = '".$giftcode."', item = '".$item."' WHERE id = '".$id."' LIMIT 1");
		if($sql)
		{
		echo '
		<div class="widget-content">
            <div class="alert alert-success alert-block">
			<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
              <h4 class="alert-heading">Success!</h4>
             Sửa bài viết thành công!
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
            <h5>Danh sách GiftCode</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>STT</th>
                  <th>Mã Code</th>
                  <th>Item</th>
                </tr>
              </thead>
              <tbody>
			  <form action="" method="POST">
			   <?php
			  $sel = "SELECT * FROM gc_giftcode WHERE id = '".$id."'";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><input name="giftcode" value="<?=$rs['giftcode'];?>"/></td>
							  <td><input name="item" value="<?=$rs['item'];?>"/></td>
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
            <h5>Danh sách GiftCode</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>STT</th>
                  <th>Mã Code</th>
                  <th>Item</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  $sql = $conn->query("SELECT * FROM gc_giftcode");
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><?=$rs['giftcode'];?></td>
							  <td><?=$rs['item'];?></td>
							  <td><a style="width: 30px;" href="edit-code-id-<?=$rs['id'];?>.hga" class="btn btn-danger"> Xóa </a></td>
							  <td><a style="width: 30px;" href="del-code-id-<?=$rs['id'];?>.hga" class="btn btn-danger"> Xóa </a></td>
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
<?php } ?>
<?php include_once (dirname(__DIR__).$foots); ?>