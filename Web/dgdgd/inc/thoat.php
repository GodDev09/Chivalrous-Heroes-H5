<html>
<meta charset="utf8">
<?php
session_start();
session_destroy();
echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="/"</script>';
?>
</html>