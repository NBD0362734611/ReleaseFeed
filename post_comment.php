<?php
require_once "db_func.php";
require_once "func.php";

$aid = $_POST['aid'];
$uid = $_POST['uid'];
$comment = $_POST['comment'];
  
$sql = "INSERT INTO `Release_Feed`.`cid` (`cid`, `aid`, `uid`, `comment`, `time`, `flg`) VALUES (NULL, '".$aid."', '".$uid."', '".$comment."', CURRENT_TIMESTAMP, 1);";

if(!empty($aid) && $uid!=0 && !empty($uid) && !empty($comment)){
	if(mysql_db_query($db_name, $sql)){

		$sql = "select last_insert_id();";
		$result = mysql_fetch_assoc(mysql_db_query($db_name, $sql));
		$cid = $result["last_insert_id()"];

		if(mysql_db_query($db_name, $sql)){
			$data = array('status' => "success", 'cid' => $cid);
			echo json_encode($data);
		}else{
			$data = array('status' => "db_error");
			echo json_encode($data);
			return false;
		}
	}
}else{
	$data = array('status' => "ログインしてください！");
	echo json_encode($data);
	return false;
}

mysql_close($connect);
 
header('Content-Type: application/json; charset=utf-8');
?>