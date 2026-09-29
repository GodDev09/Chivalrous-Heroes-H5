<?php
include_once '../global/db.class.php';
$sid = '127.0.0.1';
$severs=array();
foreach($quarr as $key=>$val){
	if($val['hide']==false){
		if($val['opentime']<=time()){
			$sever=array("serverId"=>$val["quid"],"serverName"=>$val['name'],"serverIp"=>$sid,"serverPort"=>$val['port'],"sslPort"=>0,"hostName"=>"","serverStatus"=>2,"serverState"=>"open","showId"=>$val["quid"],"limitCreate"=>0);
	    array_push($severs,$sever);
		}
	}	
}
$data=array("msg"=>"ok","code"=>1,"servers"=>$severs);
exit(json_encode($data,320));
?>