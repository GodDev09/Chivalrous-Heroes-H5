<?php
session_start();
include "../db.php";
$sel = $conn->query("SELECT * FROM gc_info");
$rs = mysqli_fetch_array($sel);
$tile = $rs['tile'];
$title = "Admin Panel";
$url = $rs['url']."admin@@@@";
?>