<?php
require_once "db_func.php";

$uid = $_POST['uid'];
$status = $_POST['status'];

//$uid = 972704152759318; //

if($uid!=0 && !empty($uid)){
	$sql = "SELECT COUNT(*) FROM `Release_Feed`.`notice` WHERE `flg` = '1' AND `uid` = '". $uid ."' AND `status` = '". $status ."';";
	if($results = mysql_db_query($db_name, $sql)){
		while($result = mysql_fetch_assoc($results)) {
			$num = $result["COUNT(*)"];
		}
		$data = array('num' => $num);
		echo json_encode($data);
	}else{//aidまたはuidがない
		$data = array('num' => "0");
		echo json_encode($data);
	}
}


mysql_close($connect);
 
header('Content-Type: application/json; charset=utf-8');
?>