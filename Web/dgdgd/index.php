<?php
session_start();
include_once '../db.php';
include_once 'theme.php';
$act = $_GET['gc'];
if(isset($act))
{
	$act = $_GET['gc'];
}
else
{
	$act = "";
}
if(file_exists("inc/".$act.".php"))
{
	include_once("inc/".$act.".php");
}
else
{
	include_once("inc/def.php");
}
?>
