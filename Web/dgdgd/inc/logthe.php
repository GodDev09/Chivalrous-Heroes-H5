<?php
include "../db.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Danh sách thẻ nạp sai</a> </div>
  </div>
 <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Danh sách thẻ nạp sai</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
             <thead>
                <tr>
                  <th>Tài khoản</th>
                  <th>Số Pin</th>
                  <th>Số Seri</th>
                  <th>Mệnh Giá</th>
                  <th>Mạng</th>
                  <th>Máy chủ</th>
				  <th>Trạng thái</th>
                  <th>Duyệt thẻ</th>
                </tr>
              </thead>
              <tbody>
			  <form action="" method="POST">
			  <?php
			  $sel = "SELECT * FROM gc_log";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
                <tr class="gradeA">
                  <td><?=$rs['user'];?></td>
                  <td><?=$rs['sopin'];?></td>
                  <td><?=$rs['seri'];?></td>
                  <td><?=number_format($rs['menhgia']);?></td>
                  <td><?=$rs['mang'];?></td>
                  <td><?=$rs['srv'];?></td>
                  <td><?php if($rs['status'] == 0) {echo "Chưa duyệt";} ;?></td>
				  <td class="center"><a style="width: 60px;" href="duyet-the-seri-<?=$rs['seri'];?>.html" class="btn btn-primary">Duyệt thẻ</a></td>
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