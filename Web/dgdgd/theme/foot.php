</div>
</div>
<?php
if($_GET['gc'] == "reward" || $_GET['gc'] == "list-item" || $_GET['gc'] == "logcongxu" || $_GET['gc'] == "logxu" || $_GET['gc'] == "logthe" && $_GET['id'] == "" || $_GET['gc'] == "listitem" && $_GET['id'] == "" || $_GET['gc'] == "webshop" && $_GET['id'] == "" || $_GET['gc'] == "server" && $_GET['id'] == "" && $_GET['id'] == "" || $_GET['gc'] == "listcode" && $_GET['id'] == "" || $_GET['gc'] == "doanh-thu" && $_GET['id'] == "" || $_GET['gc'] == "baiviet" && $_GET['id'] == "")
{?>
<script src="<?=$url;?>/js/jquery.ui.custom.js"></script> 
<script src="<?=$url;?>/js/bootstrap.min.js"></script> 
<script src="<?=$url;?>/js/jquery.uniform.js"></script> 
<script src="<?=$url;?>/js/select2.min.js"></script> 
<script src="<?=$url;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?=$url;?>/js/maruti.js"></script> 
<script src="<?=$url;?>/js/maruti.tables.js"></script>
<?php } else { ?>
<script src="<?=$url;?>/js/excanvas.min.js"></script> 
<script src="<?=$url;?>/js/jquery.min.js"></script> 
<script src="<?=$url;?>/js/jquery.ui.custom.js"></script> 
<script src="<?=$url;?>/js/bootstrap.min.js"></script> 
<script src="<?=$url;?>/js/jquery.flot.min.js"></script> 
<script src="<?=$url;?>/js/jquery.flot.resize.min.js"></script> 
<script src="<?=$url;?>/js/jquery.peity.min.js"></script> 
<script src="<?=$url;?>/js/fullcalendar.min.js"></script> 
<script src="<?=$url;?>/js/maruti.js"></script> 
<script src="<?=$url;?>/js/maruti.dashboard.js"></script> 
<script src="<?=$url;?>/js/maruti.chat.js"></script> 
<script src="<?=$url;?>/js/jquery.paginate.js"></script> 
<?php } ?>
<script>
function goBack() {
  window.history.back();
}
function AutoRefresh(t) {
 setTimeout("location.reload(true);", t);
}
</script>
</body>
</html>