<?php
if(isset($_GET["page"]) && $_GET["page"] > 0){
  $page = $_GET["page"];
}else{
	$page = 1;
}
$before1 = $page - 1;
$after1 = $page + 1;
$before2 = $page -10;
$after2 = $page +10;
if($before1 <= 1){$before1 = 1;}
if($before2 <= 1){$before2 = 1;}

	echo "<div class=\"page-box\">";
	echo  	"<a href=\"./index.php?page=".$before2."\"><span class=\"glyphicon glyphicon-backward\" aria-hidden=\"true\"></span></a>";
	echo    "<a href=\"./index.php?page=".$before1."\"><span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span></a>";
	echo 	"page ".$page;
	echo    "<a href=\"./index.php?page=".$after1."\"><span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span></a>";
	echo   	"<a href=\"./index.php?page=".$after2."\"><span class=\"glyphicon glyphicon-forward\" aria-hidden=\"true\"></span></a>";
	echo "</div>";


?>