<?php


class DataBase
{
	public function escape($word){
		return mysql_real_escape_string(htmlspecialchars($word));
	}

	public $db_name  = "CrowdPress";

	public function __construct(){
		$connect_db = "localhost";
		$connect_id = "root";
		$connect_pw = "alue1029";
		$connect = mysql_connect($connect_db,$connect_id,$connect_pw);
		mysql_query("SET NAMES utf8",$connect);
	}

	public function select($table,$array,$compare = 0,$limit = 0,$sort = 0,$order = ""){
		if($compare == 0){
			$compare = "=";
		}elseif($compare == 1){
			$compare = "<";
		}elseif($compare == -1){
			$compare = ">";
		}
		if($sort == 0){
			$sort= "";
		}elseif($sort == 1){
			$sort = "ORDER BY $order ASC";
		}elseif($sort == -1){
			$sort = "ORDER BY $order DESC";
		}
		if($limit == 0){
			$limit = "";
		}else{
			$limit = "LIMIT $limit ";
		}

		$table = $this->escape($table);
		$sql = "SELECT * FROM $this->db_name.$table WHERE flg=1 ";
		if(!empty($array)){
			foreach($array as $key => $value){
				$key = $this->escape($key);
				$vallue = $this->escape($value);
				$sql .= "AND $key $compare '$value' ";
			}
			$sql .= "$sort $limit ";
			$results = mysql_query($sql);
		}else{
			return false;
		}
		if($results){
			$a_result = array();
			while($result = mysql_fetch_assoc($results)){
				$a_result[] = $result;
			}
			return $a_result; 
		}else{
			return false;
		}
	}

	public function insert($table,$array){
		$table = $this->escape($table);
		$keys ="";
		$values ="";
		if(!empty($array)){
			$count = 1;
			foreach($array as $key => $value){
				$key = $this->escape($key);
				$vallue = $this->escape($value);
				if($count == 1){
					$keys .= "`$key` ";
					$values .= "$value ";
				}else{
					$keys .= ",`$key` ";
					$values .= ",$value ";
				}
				$count++;
			}
		}else{
			return false;
		}
		$sql = "INSERT INTO $this->db_name.$table ($keys) VALUES ($values)";
		$results = mysql_query($sql);
		if($results){
			return true;
		}else{
			return false;
		}
	}

	public function update($table,$a_value,$a_key){
		$table = $this->escape($table);
		if(!empty($a_value)){
			$count = 1;
			$values = "";
			foreach($a_value as $id => $value){
				$key = $id->escape($id);
				$vallue = $this->escape($value);
				if($count == 1){
					$values .= "`$id` = $value ";
				}else{
					$values .= "`,$id` = $value ";
				}
				$count++;
			}
		}else{
			return false;
		}

		if(!empty($a_key)){
			$count = 1;
			$keys = "";
			foreach($a_key as $id => $value){
				$key = $id->escape($id);
				$vallue = $this->escape($value);
				if($count == 1){
					$keys .= "`$id` = $value ";
				}else{
					$keys .= "AND `$id` = $value ";
				}
				$count++;
			}
		}else{
			return false;
		}

		$sql = "UPDATE $this->db_name.$table SET $values WHERE $keys";
		$results = mysql_query($sql);
		if($results){
			return true;
		}else{
			return false;
		}
	}

	public function selectCommentFromRid($rid,$flg=1){
		$table = "r_comment";
		$sql = "SELECT * FROM $this->db_name.$table WHERE rid = $rid AND flg = $flg AND reply=0 ORDER BY  `$table`.`time` ASC";
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
	}

	public function selectPressRleaseCompanyFromRid($rid,$flg=1){
		if($prcid_dump = $this->select("release",array("rid" => $rid, "flg" => $flg))){
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
	}

	public function plus($table,$array){
		$a_flg = $this->select($table,$array);
		if(!empty($a_flg)){
			$flg = $a_flg[0]["flg"];
		}else{
			$flg = -1;
		}

		if($flg == 0){//無効中
			$results = $this->update($table,array("flg"=>1),$array);
		}elseif($flg == 1){//有効
			$results = $this->update($table,array("flg"=>0),$array);
		}else{//新規登録
			$array += array("flg" => 1);
			var_dump($array);
			$results = $this->insert($table,$array);
		}
		if($results){
			return true;
		}else{
			return false;
		}
	}
}
?>