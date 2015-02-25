<?php
$connect_db = "localhost";
$connect_id = "root";
$connect_pw = "alue1029";
$connect = mysql_connect($connect_db,$connect_id,$connect_pw);
mysql_query("SET NAMES utf8",$connect);

class DataBase
{
	private $db_name  = "CrowdPress";

	public function select($table,$array){
		$sql = "SELECT * FROM $this->db_name.$table WHERE 1=1 ";
		if(is_array($array)){
			foreach($array as $key => $value){
				$sql .= "AND $key = $value ";
			}
		}
		$results = mysql_query($sql);
		if($results){
			$a_result = array();
			while($result = mysql_fetch_assoc($results)){
				$a_result[] = $result;
			}
			return $a_result; 
		}else{
			return false;
		}
		mysql_close($connect);
	}

	public function insert($table,$array){
		$keys ="";
		$values ="";
		if(is_array($array)){
			$count = 1;
			foreach($array as $key => $value){
				if($count == 1){
					$keys .= "`$key` ";
					$values .= "$value ";
				}else{
					$keys .= ",`$key` ";
					$values .= ",$value ";
				}
				$count++;
			}
		}
		$sql = "INSERT INTO $this->db_name.$table ($keys) VALUES ($values)";
		if($results = mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

	public function update($table,$a_value,$a_key){
		if(is_array($a_value)){
			$count = 1;
			$values = "";
			foreach($a_value as $id => $value){
				if($count == 1){
					$values .= "`$id` = $value ";
				}else{
					$values .= "`,$id` = $value ";
				}
				$count++;
			}
		}
		if(is_array($a_key)){
			$count = 1;
			$keys = "";
			foreach($a_key as $id => $value){
				if($count == 1){
					$keys .= "`$id` = $value ";
				}else{
					$keys .= "`,$id` = $value ";
				}
				$count++;
			}
		}

		$sql = "UPDATE $table SET $values WHERE $keys";
		echo $sql;

	}

	public function selectCommentFromRid($rid,$flg){
		$table = "r_comment";
		$sql = "SELECT * FROM $this->db_name.$table WHERE rid = $rid ORDER BY  `$table`.`time` ASC";
		$results = mysql_query($sql);
		if($results){
			$a_result = array();
			while($result = mysql_fetch_assoc($results)){
			  	$a_result[] = $result;
			}
			return $a_result;
		}else{
			return false;
		}
		mysql_close($connect);
	}

	public function selectPressRleaseCompany($rid,$flg){
		if($prcid_dump = $this->select("release",array("rid" => $rid, "flg" => 1))){
			if($prcid = $prcid_dump[0]["prcid"]){
				$prcname_dump = $this->select("prcid",array( "prcid" => $prcid , "flg" => 1));
				$prcname = $prcname_dump[0]["prcname"];
				return $prcname;
			}else{
				return false;
			}
		}else{
			return false;
		}
		mysql_close($connect);
	}

	public function clapRelease($rid,$uid){
	//clapの登録
	//⇒flg = -1 未登録ならインサート
	//⇒登録済みならupdate
		//⇒flg0なら1
		//⇒flg1なら0
		//$results = mysql_query($sql);

		$table = "r_clap";
		$a_flg = $this->select($table,array("rid" => $rid , "uid" => $uid));
		$flg = $a_flg[0]["flg"];
		//$this->insert($table, array("rid" => $rid , "uid" => $uid));

		if($flg == -1){//未登録
			$this->insert($table,array("rid" => $rid, "uid" => $uid));
		}elseif($flg == 0){//無効中

		}elseif($flg == 1){//有効
		
		}
	}

	public function commentRelease($rid,$uid,$comment,$flg){

	}
	public function followUser($uid,$follower,$flg){

	}
	public function followCompany($cid,$follower,$flg){

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