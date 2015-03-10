<?php
require_once "../func/db_func.php";

$page = $_POST["page"];
$releaseNumber = $_POST["num"] ;
$table = "release";
$compare = 0;
$limit = $page*$releaseNumber." , $releaseNumber";
$sort = -1;
$db = new DataBase();
$data = $db->select("$table", array("flg" => 1 ),$compare,$limit,$sort,"time");
echo json_encode($data);
  
//header('Content-Type: application/json; charset=utf-8');
?>