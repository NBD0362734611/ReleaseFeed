<?php
require_once "../func/db_func.php";

$rid = $_POST["rid"];
if(!empty($rid)){
	$release = new DataBase;
	$data = $release->select("release",array("rid"=>$rid));
	echo json_encode($data);
}
 
header('Content-Type: application/json; charset=utf-8');
?>