<?php
require_once "db_func.php";

$aid = $_POST['aid'];
$uid = $_POST['uid'];
$prcid = 1;

// $uid = 780539608681524;
// $aid = 378324;

//$sql = "SELECT `prcid` FROM `Release_Feed`.`article` WHERE `aid` = `". $aid ."`";


if(!empty($aid) && $uid!=0 && !empty($uid)){
	
	$sql = "INSERT INTO `Release_Feed`.`agood` (`aid`, `uid`, `prcid`,`flg`) VALUES ('".$aid."', '".$uid."', '".$prcid."', '1');";
	if(mysql_db_query($db_name, $sql)){//agoodにinsert出来る場合
		$sql = "UPDATE `Release_Feed`.`article` SET `good` = `good` + '1' WHERE `aid` = '". $aid ."' AND `prcid` = '". $prcid ."';";
		
		if(mysql_db_query($db_name, $sql)){//articleに+1できた
			$data = array('status' => "success");
		 	echo json_encode($data);
		
		}else{//articleに+1できなかった
			$data = array('status' => "article_add_error1");
		 	echo json_encode($data);
		 	return false;
		}

	}else{//agoodにinsertできない場合
		$sql = "SELECT `flg` FROM `Release_Feed`.`agood` WHERE `aid` = '". $aid ."' AND `uid` = '". $uid ."' AND `prcid` = '". $prcid ."';";
		$flg = 0;
		if($flgs = mysql_db_query($db_name, $sql)){
			while($v = mysql_fetch_assoc($flgs)) {
				$flg = $v;
			}
		};
		$flg = intval($flg['flg']);
		if($flg == 1){//flg=1
		 	
		 	$sql = "UPDATE `Release_Feed`.`article` SET `good` = `good` - 1 WHERE `aid` = '". $aid ."';";
			if(mysql_db_query($db_name, $sql)){
			 	$sql = "UPDATE `Release_Feed`.`agood` SET `flg`= '0' WHERE `aid` = '". $aid ."' AND `uid` = '". $uid ."';";
			 	if(mysql_db_query($db_name, $sql)){
			 		$data = array('status' => "delete");
			  		echo json_encode($data);
			  	}else{
			  		$data = array('status' => "delete_error1");
			  		echo json_encode($data);
			  		return false;
			  	}
			
			}else{
				$data = array('status' => "delete_error2");
			  	echo json_encode($data);
			  	return false;
			}
			
		}elseif($flg ==0){
			$sql = "UPDATE `Release_Feed`.`article` SET `good` = `good` + '1' WHERE `aid` = '". $aid ."' AND `prcid` = '". $prcid ."';";
			
			if(mysql_db_query($db_name, $sql)){//articleに+1できた
				$sql = "UPDATE `Release_Feed`.`agood` SET `flg`= '1' WHERE `aid` = '". $aid ."' AND `uid` = '". $uid ."';";
				if(mysql_db_query($db_name, $sql)){
					$data = array('status' => "success");
			 		echo json_encode($data);
			 	}else{
			 		$data = array('status' => "article_add_error2");
				 	echo json_encode($data);
				 	return false;
			 	}
			
			}else{//articleに+1できなかった
				$data = array('status' => "article_add_error3");
			 	echo json_encode($data);
			 	return false;
			}
		}else{
			$data = array('status' => "article_add_error4");
			echo json_encode($data);
			return false;
		}
	}

}else{//aidまたはuidがない
	$data = array('status' => "id_error");
	echo json_encode($data);
}


mysql_close($connect);
 
header('Content-Type: application/json; charset=utf-8');
?>


