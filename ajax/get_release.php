<?php
require_once "../func/db_func.php";

$rid = $_POST["rid"];
//$rid = 813523;

if(!empty($rid)){
	$db = new DataBase;
	$data = $db->select("release",array("rid"=>$rid));
	if($next = $db->select("release",array("time"=>$data[0]["time"]),-1,1,1,"time")){
	}else{
		$next[0]["rid"]=$rid;
	}
	if($previous = $db->select("release",array("time"=>$data[0]["time"]),1,1,-1,"time")){
	}else{
		$previous[0]["rid"]=$rid;
	}
	
	$data = $data[0] + array("next"=>$next[0]["rid"],"previous"=>$previous[0]["rid"]);
	echo json_encode($data);
}
 
// /header('Content-Type: application/json; charset=utf-8');
?>