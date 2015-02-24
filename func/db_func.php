<?php
$connect_db = "localhost";
$connect_id = "root";
$connect_pw = "alue1029";
$connect = mysql_connect($connect_db,$connect_id,$connect_pw);
mysql_query("SET NAMES utf8",$connect);

class DataBase
{
	private $db_name  = "CrowdPress";

	public function select($table,$key,$value,$flg){
		$sql = "SELECT * FROM $this->db_name.$table WHERE `flg`= $flg ";
		$sql .= "AND `$key` = $value";
		//$sql .=";";
		$results = mysql_query($sql);
		while($result = mysql_fetch_assoc($results)){
			$a_result[] = $result;
		}
		return $a_result; 
	}

	public function selectCommentFromRid($rid,$flg){
		$table = "r_comment";
		$sql = "SELECT * FROM $this->db_name.$table WHERE `flg`= $flg ";
		$sql .= "AND `rid` = $rid ";
		$sql .="ORDER BY  `$table`.`time` ASC ;";
		$results = mysql_query($sql);
		while($result = mysql_fetch_assoc($results)){
		  	$a_result[] = $result;
		}
		return $a_result;
	}

	public function selectPressRleaseCompany($rid,$flg){
		$prcid_dump = $this->select("release","rid",$rid,$flg);
		$prcid = $prcid_dump[0]["prcid"];
		$prcname_dump = $this->select("prcid","prcid",$prcid,1);
		$prcname = $prcname_dump[0]["prcname"];
		return $prcname;
	}

}



//SELECT
/*
$sql = "SELECT * FROM $db_name.$table WHERE `flg`= $flg";
$results = mysql_db_query($db_name, $sql);
while($result = mysql_fetch_assoc($results)){
  var_dump($result); 
}
*/

//UPDATE
/*
$column = "id";
$serch_column = "909";
$sql = "UPDATE $db_name.$table SET `flg` = 0 WHERE $column = $serch_column;";
$results = mysql_db_query($db_name, $sql);
*/

//INSERT
/*
$table = "uid";
$column = "`snsid`,`uid`,`fname`,`lname`,`flg`,`notice`";
$column_value = "1,777,'Kota','Tatsumi',1,1";
$sql = "INSERT INTO $db_name.$table ($column) VALUES ($column_value);";
var_dump($sql);
$results = mysql_db_query($db_name, $sql);
*/
?>