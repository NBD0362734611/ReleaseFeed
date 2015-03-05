<?php
require_once "../func/db_func.php";

$rid = $_POST["rid"];
//$rid = 813524;

if(!empty($rid)){
	$comment = new DataBase;
	$data = $comment->selectCommentFromRid($rid);
	echo json_encode($data);
}
 
// /header('Content-Type: application/json; charset=utf-8');
?>