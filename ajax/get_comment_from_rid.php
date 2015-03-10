<?php
require_once "func/db_func.php";
require_once "func/func.php";

//$rid = $_POST["rid"];
$rid = 813524;

if(!empty($rid)){
	$release = new Release();
	echo $release->commentArea($rid);
}
 
// /header('Content-Type: application/json; charset=utf-8');
?>