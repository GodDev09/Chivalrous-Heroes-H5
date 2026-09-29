<?php if(isset($_SESSION['username'])){?>
<?php include "user/head.php"; ?>
<div class="container">
            	<div class="row mb-3 "></div>
            <div class="content">
			
                <div class="row ">
				<div class="col mb-2">
				<ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1"><i class="fa fa-list" aria-hidden="true"></i> News</a></li>
             
                            </ul>
                    <div id="smartwizard" class="sw-main sw-theme-dots stepwizard p-4 border sw-theme-none">
                       
                        <div class="sw-container tab-content" style="min-height: 450px;">
                          
                            <div id="step-2" class="tab-pane step-content" style="display: block;">
                                <?php
								$queryb = $conn->query("SELECT * FROM gc_post LIMIT 10");
								$i = 1;
								while($rs = mysqli_fetch_array($queryb))
								{?>
                               <p><a href="<?=$rs['url'];?>"><b><?=$i;?>. <?=$rs['tieude'];?></b></a></p>
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