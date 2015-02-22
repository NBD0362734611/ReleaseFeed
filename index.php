<?php
error_reporting(-1);
include_once("./func/func.php");
include_once("./func/db_func.php");
include_once("./func/yahoo_func.php");


$article = new Article();
for($i=375896;$i<=379371;$i++){
	$article->show($i);
}


?>
