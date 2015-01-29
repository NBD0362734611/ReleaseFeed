<?php
require_once "db_func.php";

$aid = $_POST['aid'];
$uid = $_POST['uid'];
$prcid = 1;

// $uid = 780539608681524;
// $aid = 378368;

if(!empty($aid) && $uid!=0 && !empty($uid)){
	$sql = "SELECT `flg` FROM `Release_Feed`.`afavorite` WHERE `aid` = '". $aid ."' AND `uid` = '". $uid ."' AND `prcid` = '". $prcid ."';";
	$flg = 0;
	if($flgs = mysql_db_query($db_name, $sql)){
		while($v = mysql_fetch_assoc($flgs)) {
			$flg = $v;
		}
		$flg = intval($flg['flg']);
	};

	if($flg == 1){
		$data = array('status' => "success");
	 	echo json_encode($data);
	}else{
		$data = array('status' => "no_data");
	 	echo json_encode($data);
	 	return false;
	}

}else{//aidまたはuidがない
	$data = array('status' => "id_error");
	echo json_encode($data);
}


mysql_close($connect);
 
header('Content-Type: application/json; charset=utf-8');
?>