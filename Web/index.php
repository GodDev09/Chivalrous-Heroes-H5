<?php
session_start();
include "db.php";
include "mobile.php";
include "inc/func.php";
$detect = new Mobile_Detect;
header("Location: /user/login");
exit();
?>