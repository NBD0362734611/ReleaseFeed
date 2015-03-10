<?php
require_once "../func/func.php";
require_once "../func/db_func.php";

$repeat = $_POST["repeat"];
$release = new Release;
$data = $release->releaseBoxes($repeat);
echo json_encode($data);

// /header('Content-Type: application/json; charset=utf-8');
?>