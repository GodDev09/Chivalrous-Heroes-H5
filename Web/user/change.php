<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">

                    
                   <div class="col">
                        <div>

                            <ul class="nav nav-tabs">
     
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1"><i class="fa fa-lock" aria-hidden="true"></i> CHANGE PASSWORD</a></li>
                            </ul>
                            <div class="tab-content">

                                <!-- Tab 2 CHANGE PASSWORD -->
                                <div class="tab-pane active border border-top-0 p-3" role="tabpanel" id="tab-1">
								<?php
								$oldpass = md5($_POST['oldpass']);
								$newpass = md5($_POST['newpass']);
								$repass = $_POST['repass'];
								$chpass = $conn->query("SELECT * FROM account WHERE username = '".$_SESSION['username']."' AND password = '$oldpass' LIMIT 1");
								$rs = mysqli_fetch_array($chpass);
								$token = md5("hgavnh".$newpass);
								if(isset($_POST['submit']))
								{
									if($oldpass != $rs['password'])
									{
										exit ('<script type="text/javascript">alert("Mật khẩu cũ không chính xác");window.location="/user/change"</script>');
									}
									if($oldpass != $repass)
									{
										exit ('<script type="text/javascript">alert("Xác nhận mật khẩu mới không giống nhau");window.location="/user/change"</script>');
									}
									if($oldpass == $rs['password'])
									{
										@$up = $conn->query("UPDATE account SET password = '$newpass', ming = '$repass', token = '$token' WHERE username = '".$_SESSION['username']."' LIMIT 1");
										if($up)
										{
											exit ('<script type="text/javascript">alert("CHANGE PASSWORD thành công!");window.location="/user/change"</script>');
										}
										else
										{
											exit ('<script type="text/javascript">alert("CHANGE PASSWORD thất bại");window.location="/user/change"</script>');
										}
									}
								}
								else
								{
								?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="inputAddress">Mật khẩu hiện tại</label>
                                            <input type="password" id="oldpass" class="form-control" name="oldpass" placeholder="Mật khẩu hiện tại">
                                        </div>
										<div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress2 ">Mật khẩu mới</label>
                                            <input type="password" id="newpass" class="form-control" name="newpass" placeholder="Mật khẩu mới">
                                        </div>
                                        
                                            <div class="form-group col-md-6">
                                                <label for="inputFullname">Xác nhận mật khẩu mới</label>
                                                <input type="password" id="repass" class="form-control" name="repass" placeholder="Nhập mật khẩu mới của bạn">
                                            </div>
                                            <div class="form-group col-md-6">
                                            </div>

                                        </div>
										<span id="msg"></span>
                                        <center><button type="submit" name="submit" class="btn btn-primary">Cập nhật</button></center>
                                    </form>
								<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 order-lg-first">
                       <!-- left bar -->
                       	<div class="leftbar">
	<?php include "mem.php"; ?>
</div>                    </div>
                    
                </div>

            </div>
        </div>
		
<?php include "user/foot.php"; ?>
<?php } else { header("Location: login"); } ?>