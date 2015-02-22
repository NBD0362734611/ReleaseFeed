<?php
error_reporting(-1);
include_once("./func/func.php");
include_once("./func/db_func.php");
include_once("./func/yahoo_func.php");


$article = new Article();
$article->show(377533);


?>
