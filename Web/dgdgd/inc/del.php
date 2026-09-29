<?php include_once (dirname(__DIR__).$heads); ?>
<?php
$del = $_GET['del'];
$id = $_GET['id'];
$sql = $conn->query("SELECT * FROM gc_option");
$rs = mysqli_fetch_array($sql);
$url = "/admin@@@@/";
if(!$_SESSION['useradmin'] && $_SESSION['admin'] != "2205")
{
	echo '<script type="text/javascript">alert("Vui lòng đăng nhập");window.location="/"</script>';
}
else
{
	
	if($del == "post")
	{
		@$sql = $conn->query("DELETE FROM gc_post WHERE id = '".$id."'");
		if($sql)
		{
			echo '<script type="text/javascript">alert("Bạn đã xóa thành công bài viết có ID là '.$id.' !");window.location="'.$url.'bai-viet"</script>';
		}else
		{
			echo '<script type="text/javascript">alert("Không thể xóa bài viết hiện tại");window.location="'.$url.'bai-viet"</script>';
		}
	}
	elseif($del == "menu")
	{
		@$sql = $conn->query("DELETE FROM gc_menu WHERE id = '".$id."'");
		if($sql)
		{
			echo '<script type="text/javascript">alert("Bạn đã xóa thành công MENU có ID là '.$id.' !");window.location="'.$url.'menu"</script>';
		}else
		{
			echo '<script type="text/javascript">alert("Không thể xóa MENU hiện tại");window.location="'.$url.'menu"</script>';
		}
	}
	elseif($del == "code")
	{
		@$sql = $conn->query("DELETE FROM gc_giftcode WHERE id = '".$id."'");
		if($sql)
		{
			echo '<script type="text/javascript">alert("Bạn đã xóa thành công mã CODE có ID là '.$id.' !");window.location="'.$url.'list-code"</script>';
		}else
		{
			echo '<script type="text/javascript">alert("Không thể xóa CODE hiện tại");window.location="'.$url.'list-code"</script>';
		}
	}
	elseif($del == "server")
	{
		@$sql = $conn->query("DELETE FROM gc_server WHERE id = '".$id."'");
		if($sql)
		{
			echo '<script type="text/javascript">alert("Bạn đã xóa thành công Server có ID là '.$id.' !");window.location="'.$url.'server"</script>';
		}else
		{
			echo '<script type="text/javascript">alert("Không thể xóa Server hiện tại");window.location="'.$url.'server"</script>';
		}
	}
	elseif($del == "admin")
	{
		@$sql = $conn->query("DELETE FROM gc_admin WHERE user = '".$id."'");
		if($sql)
		{
			echo '<script type="text/javascript">alert("Bạn đã xóa thành công tài khoản Admin '.$id.' !");window.location="'.$url.'admin"</script>';
		}else
		{
			echo '<script type="text/javascript">alert("Không thể xóa tài khoản hiện tại");window.location="'.$url.'admin"</script>';
		}
	}
	else
	{
		@$sql = $conn->query("DELETE FROM gc_user WHERE user = '".$id."'");
		if($sql)
		{
			echo '<script type="text/javascript">alert("Bạn đã xóa thành công tài khoản '.$id.' !");window.location="'.$url.'tai-khoan"</script>';
		}else
		{
			echo '<script type="text/javascript">alert("Không thể xóa tài khoản hiện tại");window.location="'.$url.'tai-khoan"</script>';
		}
	}
	
} ?>
<?php include_once (dirname(__DIR__).$foots); ?>