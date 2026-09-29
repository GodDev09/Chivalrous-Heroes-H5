<?php
error_reporting(0);
session_start();
ini_set('date.timezone','Asia/Shanghai');
header("Content-type: text/html; charset=utf8");

define("DBIP","127.0.0.1");
define("DBUSER","root");
define("DBPWD","X7kR9mP2qN5wL8jZ");
define("DBPPORT","3306");
define("DBNAME","account");
define("WEBNAME","三国名将传");//站点名称
$quarr=array(
"10000"=>array(
"dbname"=>"sanguo_game",
"dbip"=>DBIP,
"dbuser"=>DBUSER,
"dbport"=>DBPPORT,
"name"=>"SV1_THANDIEU",
"ip"=>"127.0.0.1",
"port"=>19101,
"quid"=>10000,
"key"=>"5Jqxjo10Yl2ElQCwJm",
"cdn"=>"http://127.0.0.1/",
"hide"=>false,
"opentime"=>1593160806

)
);
$getfilter="'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq){
	if(is_array($StrFiltValue)){
		$StrFiltValue=implode($StrFiltValue);
	}
	if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){
		print "非法操作!";
		exit();
	}
}
foreach($_GET as $key=>$value){
	StopAttack($key,$value,$getfilter);
}
foreach($_POST as $key=>$value){
	StopAttack($key,$value,$postfilter);
}
foreach($_COOKIE as $key=>$value){
	StopAttack($key,$value,$cookiefilter);
}
include_once dirname(__FILE__).'/function.php';
?>