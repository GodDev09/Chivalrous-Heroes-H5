<?php
require_once "../../db.php";
$page =  trim($_POST['page']);
$line =  trim($_POST['line']);
$type =  trim($_POST['type']);
$search = '';
if(isset($_POST['search'])) {
	$search .= "WHERE
	`user` LIKE '%".$_POST['search']."%'";
}
if($type == "") {
	$orderby = "`time` DESC";
} else {
	switch($type) {
		case "money_1":$orderby = "`menhgia` ASC";break;
    	case "money_0":$orderby = "`menhgia` DESC";break;		
    }
}
if($page<1)$page=1;
$i = 0;
$offset = ($page - 1) * 10;
$row_count = $line;
$result1 = mysqli_query($conn,"SELECT * FROM `gc_log` $search");
//$conn_web->query("SELECT Count(*) AS totalrows FROM `account` $search");
//$result = $conn_web->query("SELECT * FROM `account` $search ORDER BY $orderby LIMIT $offset, $row_count");
$result = mysqli_query($conn,"SELECT * FROM `gc_log` $search ORDER BY $orderby LIMIT $offset, $row_count");
$json['items'] = array();
$num = mysqli_num_rows($result1);
if ($num > 0){
	while ($data = mysqli_fetch_array($result)){
		$userstr = "'".$data['user']."'";
		$json['items'][$i] = '
		<tr class="gradeX">
			<td>'.$data['user'].'</td>
			<td>'.($data['menhgia'] > 0 ? "<font color='blue'>".number_format($data['menhgia'])."</font>" : number_format($data['menhgia'])).'</td>
			<td>'.$data['seri'].'</td>
			<td>'.$data['pin'].'</td>
			<td>'.$data['createTime'].'</td>
			<td>'.$data['status'].'</td>
		</tr>';
		if(!$totalitem)
			$totalitem = $num;
		$i++;
	}
	if($totalitem) {
		$json['totalpage'] = ceil($totalitem / $row_count);
		$json['totalitem'] = $totalitem;
		$json['itemOnPage'] = $row_count;
	}
} else {
	$json['items'] = '';
}
echo json_encode($json);
?>