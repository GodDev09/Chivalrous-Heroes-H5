<?php
session_start();
if(isset($_GET['page']))
{
	$page = $_GET['page'];
}
else
{
	$page = '';
}
if(file_exists("user/".$page.".php"))
{
	include ("user/".$page.".php");
}
else
{
	include ("user/def.php");
}
?>