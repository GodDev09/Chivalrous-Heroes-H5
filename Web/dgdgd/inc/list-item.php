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
	<a href="#" class="current">Danh sách Item</a> </div>
  </div>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Danh sách Item</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				<input type="hidden" id="type" name="type">
                  <th>STT</th>
                  <th>Type</th>
                  <th>Item</th>
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  $sql = $conn->query("SELECT * FROM gc_listitem");
			  while($rs = mysqli_fetch_array($sql))
			  {?>
               <tr class="gradeX">
							  <td><?=$rs['id'];?></td>
							  <td><?=$rs['ma'];?></td>
							  <td><?=$rs['item'];?></td>
							  <td><?=$rs['name'];?></td>
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