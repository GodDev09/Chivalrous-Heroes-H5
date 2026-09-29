<?php
session_start();
session_destroy();
header('Content-Type: text/html; charset=utf-8');
echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="/"</script>';
?>