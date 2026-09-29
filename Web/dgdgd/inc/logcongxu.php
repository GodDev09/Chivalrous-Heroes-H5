<?php include_once (dirname(__DIR__).$heads); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Lịch sử cộng xu</a> </div>
  </div>
 <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Lịch sử cộng xu</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
             <thead>
                <tr>
                  <th>STT</th>
                  <th>Quản trị viên</th>
                  <th>Tài khoản</th>
                  <th>Xu cộng</th>
                  <th>Thời gian</th>
                </tr>
              </thead>
              <tbody>
			  <form action="" method="POST">
			  <?php
			  $sel = "SELECT * FROM gc_logcongxu ORDER BY createTime ASC";
			  $sql = mysqli_query($conn,$sel);
			  while($rs = mysqli_fetch_array($sql))
			  {?>
                <tr class="gradeA">
                  <td><?=$rs['id'];?></td>
                  <td><?=$rs['admin'];?></td>
                  <td><?=$rs['user'];?></td>
                  <td><?=number_format($rs['xucong']);?></td>
                  <td><?=$rs['createTime'];?></td>
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
<?php include_once (dirname(__DIR__).$foots); ?>
