<?php
require_once "../func/db_func.php";

// $uid = $_POST["uid"];
$uid = 111111111111111;
$upapername = $_POST["upapername"];
$type = $_POST["type"];

if($uid>0 && !empty($type)){
    $db = new DataBase;
    // $data = $db->insert("$type",array("uid"=>$uid,"upapername"=>$upapername,"uname"=>$uname,"uemail"=>$uemail));
    $data = $db->update("$type",array("upapername"=>$upapername),array("uid"=>$uid));
    echo json_encode($data);
}

// /header('Content-Type: application/json; charset=utf-8');
?>
