<?php
require_once "db_func.php";
require_once "func.php";

$row = $_POST['row'];
$num = $_POST['num'];

//$row = 10;
//$num = 5;
$sql = "SELECT * FROM `article` WHERE `flg` = 1 ORDER BY `article`.`aid` DESC LIMIT ".$row.",".$num.";";
if(!empty($row) && $row!=0 ){
  if($results = mysql_db_query($db_name, $sql)){
    while($result = mysql_fetch_assoc($results)){
      $articles[] = $result;
    }
    $data = array('articles' => $articles);
    echo json_encode($data);
  }else{
    $data = array('status' => "エラー");
    echo json_encode($data);
    return false;
  }
}else{
  $data = array('status' => "エラー");
  echo json_encode($data);
  return false;
}

mysql_close($connect);
 
header('Content-Type: application/json; charset=utf-8');
?>