<?php
include "/var/www/html/header.php";
require_once "/var/www/html/func.php";
require_once "/var/www/html/db_func.php";
$result = 1;
for ($page = 1; $result; $page++) {
  $nstr = nikkei_get_nstr($page);
  $relIDend = 6;
  $relIDstart[0] = 0;
  $i = 0;
  $nurl = "http://release.nikkei.co.jp/?page=".$page."";
  while(strpos ( "$nstr" , '"detail.cfm?relID=',$relIDstart[$i]+1)){
    $i++;
    $relIDstart[$i] = strpos ( "$nstr" , '"detail.cfm?relID=',$relIDstart[$i-1]+1);
    $relID[$i] = substr ("$nstr" , $relIDstart[$i] + 18  , $relIDend );
    $prstr = nikkei_get_prstr($relID[$i]);
  //タイトル
    $titlename = nikkei_get_title($prstr);
  //詳細
    $cname = nikkei_get_cname($relID[$i],$prstr);
  //会社名
    $cid = nikkei_get_cid($relID[$i],$prstr);
    if(!isset($cid)||$cid<0){
      $cid = 0;
    }
    $prurl = "http://release.nikkei.co.jp/detail.cfm?relID=0".$relID[$i]."";
    $img[1] = "";
    $img[2] = "";
    $img[3] = "";
    $img[4] = "";
    $img[5] = "";
    $flg = 1;
    for ($j=1; $j < 6; $j++) {
      $imgurl[$j] = "http://release.nikkei.co.jp/attach_file/0".$relID[$i]."_0".$j.".jpg";
      $imgstrsjis[$j] = file_get_contents($imgurl[$j]);
      $imgstrutf8[$j] = mb_convert_encoding($imgstrsjis[$j], "UTF-8", "SJIS");
      $response[$j] = strpos($imgstrutf8[$j], "エラー");
      if ($response[$j] === false){
        $img[$flg]=$imgurl[$j];
        $flg++;
      }
    }
    $sql = "INSERT INTO article(`prcid`,`aid`,`url`,`sid`,`cname`,`title`,`img1`,`img2`,`img3`,`img4`,`img5`,`flg`,`good`) ";
    $sql .= "VALUES (1,".$relID[$i].",'".$prurl."',".$cid.",'".$cname."','".$titlename."','".$img[1]."','".$img[2]."','".$img[3]."','".$img[4]."','".$img[5]."',1,0);";
    $result = mysql_db_query($db_name, $sql);

    // if($_GET["print"] == 1){
    //   var_dump($result);
    //   echo $titlename;
    //   echo "<br>";
    // }
  }
}
?>