<?php include_once (dirname(__DIR__).$heads); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Danh sách mốc quà</a> </div>
  </div>
  <?php
$id = $_GET['id'];
if($_GET['gc'] == "shop" && $id != "")
{
$title = $_POST['title'];
$con = $_POST['con'];
$diem = $_POST['diem'];
$item = $_POST['item'];
	if(!empty($title) && !empty($con) && !empty($diem))
	{
		@$sql = mysqli_query($conn,"UPDATE gc_mocqua SET title = '".$title."', con = '".$con."', diem = '".$diem."', soluong = '".$item."' WHERE id = '".$id."' LIMIT 1");
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
            <h5>Danh sách mốc quà</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>ID</th>
                  <th>Tiêu đề</th>
                  <th>Nội dung</th>
                  <th>Vật phẩm</th>
                  <th>Điểm</th>
                  <th style="width:70px;">Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <form action="" method="POST">
			   <?php
			  $sel = "SELECT * FROM gc_mocqua WHERE id = '".$id."'";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><input name="title" value="<?=$rs['title'];?>"/></td>
							  <td><textarea name="con" style="width:90%;height:150px;"><?=$rs['con'];?></textarea></td>
							  <td><textarea name="item" style="width:90%;height:150px;"><?=$rs['soluong'];?></textarea></td>
							  <td><input name="diem" value="<?=$rs['diem'];?>"/></td>
							  <td class="center">
							 <button style="width: 70px;" type="submit" name="submit" class="btn btn-primary">SAVE</button>
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
            <h5>Danh sách bài viết</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>ID</th>
                  <th>Tiêu đề</th>
                  <th>Nội dung</th>
                  <th>Điểm</th>
                  <th style="width:40px;">Tác vụ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  $sel = "SELECT * FROM gc_mocqua";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><?=$rs['title'];?></td>
							  <td><?=$rs['con'];?></td>
							  <td><?=number_format($rs['diem']);?></td>
							  <td class="center">
							<a style="width: 40px;" href="shop-<?=$rs['id'];?>.hga" class="btn btn-primary"> Sửa </a>
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