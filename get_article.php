<?php
	$relID = $_GET["relID"];
	$prurl = "http://release.nikkei.co.jp/detail.cfm?relID=".$relID."";
	$prstrsjis = file_get_contents("$prurl");
	$prstrutf8 = mb_convert_encoding($prstrsjis, "UTF-8", "SJIS");
	
	$prstr = strip_tags ($prstrutf8,'');


	$articlestart = strpos ( "$prstr" , 'プリントする') + 18;
  	$articleend = strpos ( "$prstr" , 'プリントする' , $articlestart) - $articlestart - 20;
  	$articlebody = substr ("$prstr" , $articlestart, $articleend );
  	$short = mb_strimwidth($articlebody, 0, 3000, "");

	header('Content-type: application/json');//指定されたデータタイプに応じたヘッダーを出力する
	echo json_encode($short);
?>