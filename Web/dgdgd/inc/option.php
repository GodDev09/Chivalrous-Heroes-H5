<?php include_once (dirname(__DIR__).$heads); ?>
<?php
if(!$_SESSION['useradmin'] && $_SESSION['admin'] != "2205")
{
	echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="/"</script>';
}
else
{
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a>
	<a href="#" class="tip-bottom">Thông tin máy chủ</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Thông tin máy chủ</h5>
          </div>
          <div class="widget-content nopadding">
			<?php
			$title = $_POST['title'];
			$des = $_POST['des'];
			$url = $_POST['url'];
			$urlgame = $_POST['urlgame'];
			$background = $_POST['background'];
			$ytb = $_POST['ytb'];
			$momo = $_POST['momo'];
			$atmbank = $_POST['atmbank'];
			$keyapi = $_POST['keyapi'];
			$email = $_POST['email'];
			$page = $_POST['page'];
			$tile = $_POST['tile'];
			$khuyenmai = $_POST['khuyenmai'];
			$starttime = $_POST['starttime'];
			$endtime = $_POST['endtime'];
			$acttask = $_POST['acttask'];
			$hide = $_POST['hide'];
			if(isset($url) && isset($urlgame) && isset($email) && isset($title) && isset($momo))
			{?>
			<div class="control-group" style="padding-top:10px;padding-left:10px;">
			<?php 
			if($momo == "" || $atmbank == "" || $page == "" || $url == "")
			{
				echo '
					<div class="widget-content">
						<div class="alert alert-error alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Error!</h4>
						 Một số trường còn bỏ trống!
						 </div>
					</div>';
			}
			else
			{
				@$up = mysqli_query($conn,"UPDATE gc_info SET hide = '{$hide}', starttime = '{$starttime}', endtime = '{$endtime}', acttask = '{$acttask}', ytb = '{$ytb}', background = '{$background}', des = '{$des}', url = '{$url}', keyapi = '{$keyapi}', tile = '{$tile}', urlgame = '{$urlgame}', email = '{$email}', title = '{$title}', page = '{$page}', atmbank = '{$atmbank}', momo = '{$momo}', khuyenmai = '{$khuyenmai}' WHERE id = '1'");
				if($up)
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-success alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Success!</h4>
						  Chỉnh sửa cấu hình thành công!
						 </div>
					</div>';
				}
				else
				{
					echo '
					<div class="widget-content">
						<div class="alert alert-error alert-block">
						<a class="close" data-dismiss="alert" href="javascript:goBack();">×</a>
						  <h4 class="alert-heading">Error!</h4>
						  Chỉnh sửa cấu hình thất bại!
						 </div>
					</div>';
				}
			}
			?>
			</div>
			<?php 
			}
			else
			{
			$slop = mysqli_query($conn,"SELECT * FROM gc_info");
			$op = mysqli_fetch_array($slop);
			?>
            <form action="" method="POST" class="form-horizontal">
			<div class="control-group">
                <label class="control-label"><strong>Tiêu đề web</strong></label>
                <div class="controls">
                  <input type="text" name="title" style="width:80%;" value="<?=$op['title'];?>"/>
                </div>
              </div>
			<div class="control-group">
                <label class="control-label"><strong>Nội dung SEO</strong></label>
                <div class="controls">
                  <input type="text" name="des" style="width:80%;" value="<?=$op['des'];?>"/>
                </div>
              </div>

			<div class="control-group">
                <label class="control-label"><strong>Tên miền chính</strong></label>
                <div class="controls">
                  <input type="text" name="url" style="width:40%;" value="<?=$op['url'];?>"/>
				<strong>Thay đổi Web và Landing: </strong>
                  <select name="hide" type="text" style="width:10%;">
				  <?php if($op['hide'] == 1) {?>
				  <option value="1">Đã kích hoạt</option>
				  <option value="0">Không kích hoạt</option>
				  <?php } else { ?>
				  <option value="0">Không kích hoạt</option>
				  <option value="1">Đã kích hoạt</option>
				  <?php } ?>
				  </select>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Link tải game APK|IPA</strong></label>
                <div class="controls">
                  <input type="text" name="urlgame" style="width:80%;" value="<?=$op['urlgame'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Khuyến mãi</strong></label>
                <div class="controls">
				<textarea type="text" style="width:80%;" name="khuyenmai"><?=$op['khuyenmai'];?></textarea>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Tỉ lệ nạp</strong></label>
                <div class="controls">
                  <input type="text" name="tile" style="width:80%;" value="<?=$op['tile'];?>"/>
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label"><strong>Bật tích nạp theo Tuần, Tháng, Năm</strong></label>
                <div class="controls">
                  Thời gian bắt đầu: <input type="text" name="starttime" style="width:20%;" value="<?=$op['starttime'];?>"/>
                  Thời gian kết thúc: <input type="text" name="endtime" style="width:20%;" value="<?=$op['endtime'];?>"/>
                  Kích hoạt: 
				  <select name="acttask" type="text" style="width:10%;">
				  <?php if($op['acttask'] == 1) {?>
				  <option value="1">Đã kích hoạt</option>
				  <option value="0">Không kích hoạt</option>
				  <?php } else { ?>
				  <option value="0">Không kích hoạt</option>
				  <option value="1">Đã kích hoạt</option>
				  <?php } ?>
				  </select>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Api Nạp Thẻ</strong></label>
                <div class="controls">
                  <input type="text" name="keyapi" style="width:80%;" value="<?=$op['keyapi'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Ảnh nền Web<br/>Và Trang đăng nhập</strong></label>
                <div class="controls">
                  <input type="text" name="background" style="width:80%;" value="<?=$op['background'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Email</strong></label>
                <div class="controls">
                  <input type="text" name="email" style="width:80%;" value="<?=$op['email'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Page</strong></label>
                <div class="controls">
                  <input type="text" name="page" style="width:80%;" value="<?=$op['page'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Youtube</strong></label>
                <div class="controls">
                  <input type="text" name="ytb" style="width:80%;" value="<?=$op['ytb'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>Momo</strong></label>
                <div class="controls">
                  <input type="text" name="momo" style="width:80%;" value="<?=$op['momo'];?>"/>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label"><strong>ATM Bank</strong></label>
                <div class="controls">
				  <textarea type="text" style="width:80%;" name="atmbank"><?=$op['atmbank'];?></textarea>
                </div>
              </div>
		
              <div class="form-actions" align="center">
                <button type="submit" name="submit" class="btn btn-success">LƯU THAY ĐỔI</button>
              </div>
            </form>
			<?php } ?>
          </div>
		  
        </div>
      </div>
	  
    </div><hr>

  </div>
</div>
<?php }  ?>
<?php include_once (dirname(__DIR__).$foots); ?>