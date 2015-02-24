<?php
include_once("./func/func.php");
include_once("./func/db_func.php");
include_once("./func/yahoo_func.php");

	$release = new Release($rid);
for($rid=811775;$rid<811776;$rid++){
	//$rid =811775;
	$release->body($rid);
}
?>
