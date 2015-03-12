<?php
require_once "../func/db_func.php";

$rid = $_POST["rid"];
$uid = $_POST["uid"];
$type = $_POST["type"];
// $rid = 813643;
// $uid = 823706921031459;
// $type = "r_scrap";

if(!empty($rid) && $uid>0 && !empty($type)){
	$db = new DataBase;
	$data = $db->plus("$type",array("rid"=>$rid,"uid"=>$uid));
	echo json_encode($data);
}
 
// /header('Content-Type: application/json; charset=utf-8');
?>