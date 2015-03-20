<?php
require_once "../func/db_func.php";

$rid = $_POST["rid"];
$uid = $_POST["uid"];
$comment = $_POST["comment"];
 // $rid = 813643;
 // $uid = 823706921031459;
 // $comment = "かきくけこ";

if(!empty($rid) && $uid>0){
	$db = new DataBase;
	$data = $db->insert("r_comment",array("uid"=>$uid,"rid"=>$rid,"comment"=>"'$comment'","flg"=>1));
	echo json_encode($data);
}
 header('Content-Type: application/json; charset=utf-8');
?>