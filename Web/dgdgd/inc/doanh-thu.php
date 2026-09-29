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
$status = $_GET['status'];
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Doanh thu</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Danh sách thẻ nạp - Tạm tính: <?=number_format($tongnap);?> VNĐ</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
             <thead>
                <tr>
                  <th>Tài khoản</th>
				  <th>Số Seri</th>
                  <th>Số Pin</th>
                  <th>Mệnh Giá</th>
                  <th>Thời gian</th>
                  <th>Hình Thức</th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  $sel = "SELECT * FROM gc_lognap ORDER BY createTime DESC";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
                <tr class="gradeA">
                  <td><?=$rs['user'];?></td>
                  <td><?=$rs['seri'];?></td>
				  <td><?=$rs['pin'];?></td>
                  <td><?=number_format($rs['menhgia']);?></td>
				  <td><?=$rs['createTime'];?></td>
                  <td><?php if($rs['status'] == 1) { echo "Đã duyệt";} else { echo "Chưa duyệt"; };?></td>
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