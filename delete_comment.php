<?php
/*sql*/
$connect_db = "localhost";
$connect_id = "root";
$connect_pw = "alue1029";
$db_name = "Release_Feed";
$connect = mysql_connect($connect_db,$connect_id,$connect_pw);
//おまじない
mysql_query("SET NAMES utf8",$connect);

$cid = $_POST['cid'];
$uid = $_POST['uid'];
  
$sql = "UPDATE `Release_Feed`.`cid` SET `flg` = '0' WHERE `cid`.`cid` = ".$cid.";";

if(!empty($cid)){
	if(mysql_db_query($db_name, $sql)){
		$data = "success";
		echo json_encode($data);
	}
}else{
	return false;
}

mysql_close($connect);
 
header('Content-Type: application/json; charset=utf-8');
?>