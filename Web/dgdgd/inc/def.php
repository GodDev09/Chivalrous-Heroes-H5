<?php
$time = date('Y-m-d');
$se = mysqli_query($conn,"SELECT * FROM gc_user");
$see = mysqli_query($conn,"SELECT * FROM gc_post");
$seee = mysqli_query($conn,"SELECT * FROM gc_server");
$seees = mysqli_query($conn,"SELECT SUM(menhgia) AS GIA FROM gc_log WHERE gia = '0'");
$sl = mysqli_num_rows($se);
$sb = mysqli_num_rows($see);
$srv = mysqli_num_rows($seee);
$dtt = mysqli_fetch_array($seees);
if(!$_SESSION['useradmin'] && $admin != "2205")
{
	echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="login"</script>';
}
else
{
?>
<?php include_once (dirname(__DIR__).$heads); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a></div>
  </div>
  <div class="container-fluid">
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Thông tin chung</h5>
          <div class="buttons"><a href="javascript:location.reload(true)" class="btn btn-mini btn-success"><i class="icon-refresh"></i> Cập nhật</a></div>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span7">
              <div>
			  <strong>
			  <p>* THẰNG GÀ CON LÀ 1 THẰNG RẺ RÁCH</p>
			  <p>- Một Thằng chuyên lừa gà để moi tiền - AE Mua API nó cẩn thận khi đem ONLINE</p>
			  <p>Thay Đổi Cổng nạp thẻ, Đổi pass mặc định của game, khóa kết nối Mysql từ xa. Tuyệt đối không được cho nó thông tin máy chủ</p>
			  </strong>
			  </div>
            </div>
            <div class="span5">
              <ul class="stat-boxes2">
				<li>
                  <div class="left peity_bar_neutral" style="width:30%;"><strong>Tài khoản</strong></div>
                  <div class="right"> <strong><?=$sl;?></strong></div>
                </li>
				<li>
                  <div class="left peity_bar_neutral" style="width:30%;"><strong>Tổng bài viết</strong></div>
                  <div class="right"> <strong><?=$sb;?></strong></div>
                </li>
				<li>
                  <div class="left peity_line_good" style="width:30%;"><strong>Tổng máy chủ</strong></div>
                  <div class="right"> <strong><?=$srv;?></strong></div>
                </li>
                <li>
                  <div class="left peity_bar_bad" style="width:30%;"><strong>Tổng Doanh Thu</strong></div>
                  <div class="right"> <strong><button id="viewtotal" class="btn btn-primary">XEM DOANH THU</button></strong></div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </div>
</div>
<script>
$("#viewtotal").click(function() {
	alert("Doanh thu chưa trừ % CK: <?php echo number_format($dtt['GIA']);?>");
});
</script>
<?php include_once (dirname(__DIR__).$foots); ?>
<?php } ?>
