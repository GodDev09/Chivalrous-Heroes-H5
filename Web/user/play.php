<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: /user/login");
    exit();
}
include "func.php";
$data = '{"user": "'.$_SESSION['username'].'","sign": "'.$signkey.'","token": "'.$token.'"}';
$link = $urlgame[0].'/?username='.$_SESSION['username'].'&token='.base64_encode($data);
header("Location: ".$link);
exit();
?>
