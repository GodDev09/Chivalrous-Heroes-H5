<?php
include "../../db.php";
$page =  trim($_POST['page']);
$line =  trim($_POST['line']);
$type =  trim($_POST['type']);
$search = '';
if(isset($_POST['search'])) {
	$search .= "WHERE
	`username` LIKE '%".$_POST['search']."%'";
}
if($type == "") {
	$orderby = "`username` ASC";
} else {
	switch($type) {
		case "money_1":$orderby = "`xu` ASC";break;
    	case "money_0":$orderby = "`xu` DESC";break;		
    }
}
if($page<1)$page=1;
$i = 0;
$offset = ($page - 1) * 10;
$row_count = $line;
$result1 = mysqli_query($conn,"SELECT * FROM account $search");
//$conn_web->query("SELECT Count(*) AS totalrows FROM `account` $search");
//$result = $conn_web->query("SELECT * FROM `account` $search ORDER BY $orderby LIMIT $offset, $row_count");
$ckus = $conn->query("SELECT * FROM account $search ORDER BY $orderby LIMIT $offset, $row_count");
$json['items'] = array();
$num = mysqli_num_rows($result1);
if ($num > 0){
	while($data = mysqli_fetch_array($ckus)){
		$userstr = "'".$data['username']."'";
		$json['items'][$i] = '
		<tr class="gradeX">
			<td>'.$data['id'].'</td>
			<td>'.$data['username'].'</td>
			<td>'.$data['password'].'</td>
			<td>'.$data['ming'].'</td>
			<td>'.($data['xu'] > 0 ? "<font color='blue'>".number_format($data['xu'])."</font>" : number_format($data['xu'])).'</td>
			<td>'.$data['lastloginip'].'</td>
			<td>'.$data['reg_time'].'</td>
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