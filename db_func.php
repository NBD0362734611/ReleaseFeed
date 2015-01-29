<?php
/*sql*/
$connect_db = "localhost";
$connect_id = "root";
$connect_pw = "alue1029";
$db_name = "Release_Feed";
$connect = mysql_connect($connect_db,$connect_id,$connect_pw);
//おまじない
mysql_query("SET NAMES utf8",$connect);


?>