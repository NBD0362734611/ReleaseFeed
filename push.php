<?php
require_once "db_func.php";
require_once "func.php";

$aid =  $_POST['aid'];//378718; //
$prcid =  $_POST['prcid'];//1; //
$my_uid = $_POST['uid'];//780539608681524; //
$status = $_POST['status']; //3; //

if(!empty($aid) && $aid != 0 && !empty($prcid)){
	//uid DB の uidのnotice を+1
	$sql = "SELECT `uid` FROM `Release_Feed`.`cid` WHERE `flg`='1' AND `aid` ='". $aid ."';";

	if($result = mysql_db_query($db_name, $sql)){
		while($id =  mysql_fetch_assoc($result)){
			$uids[] = $id['uid'];
		}
	}
}
$uni_uids = array_unique($uids);
$comment_uid = array_values($uni_uids);
foreach ( $comment_uid as $uid) {
	if($my_uid != $uid){
		if(notice_add($uid,$aid,$prcid,$status,$db_name)){
			$data = "success";
			echo json_encode($data);
		}else{
			$data = "false";
			echo json_encode($data);
		}
	}
}

mysql_close($connect);

header('Content-Type: application/json; charset=utf-8');
?>

