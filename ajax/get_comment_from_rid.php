<?php
require_once "../func/db_func.php";
require_once "../func/func.php";

//$rid = $_POST["rid"];
$rid = 813524;

if(!empty($rid)){
	$release = new Release();
	$commentArea = $release->commentArea($rid);
	return $commentArea;
	/*
	$cid = $data[0]["commentid"];
	$view = new Release;
	$comment = $view->comment($cid);
	var_dump($comment);
	*/
	//echo json_encode($data);
}
 
// /header('Content-Type: application/json; charset=utf-8');
?>