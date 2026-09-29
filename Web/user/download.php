<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">
				<div class="col mb-2">
                    <div id="smartwizard" class="sw-main sw-theme-dots stepwizard p-4 border sw-theme-none">
                            <h4><i class="fa fa-money" aria-hidden="true"></i> Download Game</h4>
                       
                        <div class="sw-container tab-content" style="min-height: 450px;">
                          
                            <div id="step-2" class="tab-pane step-content" style="display: block;">
                                
                              *. Hình thức 1 dành cho IOS: vào link sau: https://tantamquoc.com<br/>
							  *. File APK dành cho máy Android: <a href="http://play.tantamquoc.com/tamquoch5.apk" download="http://play.tantamquoc.com/tamquoch5.apk">Tân Tam Quốc H5</a>
							  
          
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
<?php } else { header("Location: /user/login"); } ?>