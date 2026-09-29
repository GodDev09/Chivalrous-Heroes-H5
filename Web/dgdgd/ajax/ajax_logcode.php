<?php
require_once "../../db.php";
$page =  trim($_POST['page']);
$line =  trim($_POST['line']);
$type =  trim($_POST['type']);
$search = '';
if(isset($_POST['search'])) {
	$search .= "WHERE
	`code` LIKE '%".$_POST['search']."%'";
}
if($type == "") {
	$orderby = "`time` DESC";
} else {
	switch($type) {
		case "actorid_1":$orderby = "`actorid` ASC";break;
    	case "actorid_0":$orderby = "`actorid` DESC";break;		
    }
}
if($page<1)$page=1;
$i = 0;
$offset = ($page - 1) * 10;
$row_count = $line;
$result1 = mysqli_query($conn,"SELECT * FROM `gc_code_log` $search");
//$conn_web->query("SELECT Count(*) AS totalrows FROM `account` $search");
//$result = $conn_web->query("SELECT * FROM `account` $search ORDER BY $orderby LIMIT $offset, $row_count");
$result = mysqli_query($conn,"SELECT * FROM `gc_code_log` $search ORDER BY $orderby LIMIT $offset, $row_count");
$json['items'] = array();
$num = mysqli_num_rows($result1);
if ($num > 0){
	while ($data = mysqli_fetch_array($result)){
		$userstr = "'".$data['id']."'";
		$json['items'][$i] = '
		<tr class="gradeX">
			<td>'.$data['id'].'</td>
			<td>'.$data['user'].'</td>
			<td>'.$data['actorid'].'</td>
			<td>'.$data['code'].'</td>
			<td>'.$data['srv'].'</td>
			<td>'.$data['time'].'</td>
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