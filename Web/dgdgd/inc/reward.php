<?php include_once (dirname(__DIR__).$heads); ?>
<?php
$id = $_GET['id'];
?>
<?php
if($_GET['gc'] == "reward" && $id != "")
{ ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Duyệt nhận thưởng mốc nạp</a> </div>
  </div>
 <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Duyệt nhận thưởng mốc nạp</h5>
          </div>
          <div class="widget-content nopadding">
            <?php
			$checks = $conn->query("SELECT * FROM gc_mocqualog WHERE id = '".$id."' LIMIT 1")->fetch_assoc()['status'];
			if($checks == 1)
			{
				echo '
				<div class="widget-content">
					<div class="alert alert-error alert-block">
					<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
					  <h4 class="alert-heading">Error!</h4>
					 Bạn đã cập nhật trạng thái rồi!
					 </div>
				</div>';
			}
			else
			{
				@$sql = $conn->query("UPDATE gc_mocqualog SET status = '1' WHERE id = '".$id."' LIMIT 1");
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
		?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
}
else
{?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Lịch sử đổi quà</a> </div>
  </div>
 <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Lịch sử đổi quà</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
             <thead>
                <tr>
                  <th style="width: 80px;">STT</th>
                  <th style="width: 80px;">Tài khoản</th>
                  <th>Mốc quà</th>
                  <th style="width: 80px;">Máy chủ</th>
                  <th style="width: 80px;">Thời gian</th>
                  <th style="width: 80px;">Trạng thái</th>
                  <!--<th style="width: 40px;">Xử lý</th>-->
                </tr>
              </thead>
              <tbody>
			  <form action="" method="POST">
			  <?php
			  $sql = $conn->query("SELECT * FROM gc_mocqualog ORDER BY date ASC");
			  while($rs = mysqli_fetch_array($sql))
			  {?>
                <tr class="gradeA">
                  <td><?=$rs['id'];?></td>
                  <td><?=$rs['user'];?></td>
                  <td>
				  <?php
				  $logid = $rs['logid'];
				  if($logid == 1)
				  {
					  echo "Gói Cơ Bản";
				  }elseif($logid == 2)
				  {
					  echo "Gói Nạp R";
				  }
				  elseif($logid == 3)
				  {
					  echo "Gói Nạp SR";
				  }
				  else
				  {
					  echo "Gói Nạp SSR";
				  }
				  ?>
				  </td>
                  <td><?=$rs['server'];?></td>
                  <td><?=$rs['date'];?></td>
                  <td><?php if($rs['status'] == 1) { echo "Đã duyệt";} else { echo "Chưa duyệt";};?></td>
				 <!-- <td class="center">
				  <a style="width: 40px;" href="reward-<?=$rs['id'];?>.hga" class="btn btn-primary">DUYỆT</a>
				  </td>-->
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
</div>
<?php } ?>
<?php include_once (dirname(__DIR__).$foots); ?>