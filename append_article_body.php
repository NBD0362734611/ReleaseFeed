<?php
require_once "db_func.php";
require_once "func.php";

// $article["title"] = "testtitle";//$_POST['title'];
// $article["aid"] = "testaid";//$_POST['aid'];
// $article["url"] = "testurl";//$_POST['url'];
// $article["cname"] = "testcname";//= $_POST['cname'];
// $article["sid"] = "testsid";//$_POST['sid'];
// $article["img1"] = "testimg1";//$_POST['img1'];
// $article["img2"] = "testimg2";//$_POST['img2'];
// $article["img3"] = "testimg3";//$_POST['img3'];
// $article['img4'] = "testimg4";//$_POST['img4'];
// $article['img5'] = "testimg4";//$_POST['img5'];
// $article["good"] = "testgood";//$_POST['good'];

$uid = $_POST['uid'];
$article["title"] = $_POST['title'];
$article["aid"] = $_POST['aid'];
$article["url"] = $_POST['url'];
$article["cname"] = $_POST['cname'];
$article["sid"] = $_POST['sid'];
$article["img1"] = $_POST['img1'];
$article["img2"] = $_POST['img2'];
$article["img3"] = $_POST['img3'];
$article['img4'] = $_POST['img4'];
$article['img5'] = $_POST['img5'];
$article["good"] = $_POST['good']; 

$titlename = $article["title"];
$body ="";
//$body .= "<div class='article' data-id='".$article["aid"]."'>";
//タイトル
$body .=  "<div class='title'><a href='".$article["url"]."' target='_blank'>".$article["title"]."</a></div>";
//詳細
//tempfile_popup_btn($titlename,$relID[$i],$i);
$body .= "<div class='company_info'>";
//会社名
$body .= "<div class='company_name'>";
$body .=  "<span class='glyphicon glyphicon-globe' aria-hidden='true'></span> <a href='./index.php?cname=".$article["cname"]."'>".$article["cname"]."</a><br />";
$body .= "</div>";
//株価
$body .= "<div class='stock_code'>";
$body .=  "<span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>株式コード <a href='http://stocks.finance.yahoo.co.jp/stocks/detail/?code=".$article["sid"]."'>".$article["sid"]."</a><br />";
$body .= "</div>";
//yahoo_get_stockprice($article["sid"]);
$cid = $article["sid"];
$yurl = "http://stocks.finance.yahoo.co.jp/stocks/detail/?code=".$cid."";
$ystr = file_get_contents("$yurl");
$stoksstart = strpos ( "$ystr" , '<td class="stoksPrice">') + 23;
$stoksend = strpos ( "$ystr" , '</td>',$stoksstart) - $stoksstart;
if($stoksstart!=23){
  $stoks = substr ("$ystr" , $stoksstart , $stoksend);
  $body .= "<div><span class='glyphicon glyphicon-usd' aria-hidden='true'></span> 株価 ".$stoks."円</div>";
  $udflg = strpos ( "$ystr" , '前日比');
  $udstart = strpos ( "$ystr" , '">' , $udflg) + 2;
  $udend = strpos ( "$ystr" , '</span>',$udstart) - $udstart;
  $udstoks = substr ("$ystr" , $udstart , $udend);
  $body .= '<div><span class="glyphicon glyphicon-sort" aria-hidden="true"></span> 前日比 '.$udstoks."</div>";
}else{
$body .= "<div><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> 情報なし</div>";
}

$body .= "</div>";//class='company_info'
//イメージ
$body .= "<div class='article_img_boxes article_img_boxes".$article['aid']."'>";
// $body .= "<div class='article_img_box article_img_box".$article['aid']."1' data-url='".$article['img1']."'></div>";
// $body .= "<div class='article_img_box article_img_box".$article['aid']."2' data-url='".$article['img2']."'></div>";
// $body .= "<div class='article_img_box article_img_box".$article['aid']."3' data-url='".$article['img3']."'></div>";
// $body .= "<div class='article_img_box article_img_box".$article['aid']."4' data-url='".$article['img4']."'></div>";
// $body .= "<div class='article_img_box article_img_box".$article['aid']."5' data-url='".$article['img5']."'></div>";
$body .= "<div class='article_img_box article_img_box".$article['aid']."'>";
if($article['img1'] != ""){
  $body .=  "<a href='".$article['img1']."' target=_blank><img src='".$article['img1']."' alt='' style='height: 90px; width: 90px;'></a></div>";
}else{
  $body .= "</div>";
}
$body .= "<div class='article_img_box article_img_box".$article['aid']."'>";
if($article['img2'] != ""){
$body .=  "<a href='".$article['img2']."' target=_blank><img src='".$article['img2']."' alt='' style='height: 90px; width: 90px;'></a></div>";

}else{
  $body .= "</div>";
}
$body .= "<div class='article_img_box article_img_box".$article['aid']."'>";
if($article['img3'] != ""){
$body .=  "<a href='".$article['img3']."' target=_blank><img src='".$article['img3']."' alt='' style='height: 90px; width: 90px;'></a></div>";

}else{
  $body .= "</div>";
}
$body .= "<div class='article_img_box article_img_box".$article['aid']."'>";
if($article['img4'] != ""){
$body .=  "<a href='".$article['img4']."' target=_blank><img src='".$article['img4']."' alt='' style='height: 90px; width: 90px;'></a></div>";

}else{
  $body .= "</div>";
}
$body .= "<div class='article_img_box article_img_box".$article['aid']."'>";
if($article['img5'] != ""){
$body .=  "<a href='".$article['img5']."' target=_blank><img src='".$article['img4']."' alt='' style='height: 90px; width: 90px;'></a></div>";

}else{
  $body .= "</div>";
}


$body .= "</div>";
//ツールボックス
$body .= "<div class='tool-box'>";
  //コメント投稿
  $body .= '<div class="comment-btn" data-id="'.$article["aid"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>';
  //良いね
  $body .= '<div class="agood-btn" data-id="'.$article["aid"].'"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><span id="agood-'.$article["aid"].'" >'.$article["good"].'</span></div>';
  //お気に入り
  $body .= '<div class="afavorite-btn" data-id="'.$article["aid"].'"><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span id="afavorite-'.$article["aid"].'" ></span></div>';
$body .= "</div>";
$body .= '  <div class="comment-input-group input-group" id="input-group-'.$article["aid"].'">
          <input type="text" class="comment-form-control form-control" name="'.$article["aid"].'" placeholder="コメント(１４０字以内)">
          <span class="input-group-btn">
              <button id="'.$article["aid"].'" class="comment-submit btn btn-default" type="button">
                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
              </button>
          </span>
        </div>';
//コメント
$cids = get_comment($article["aid"],$db_name);
$body .= "<div class='comment_boxes' id='comment_aid_".$article["aid"]."'>";
while ($cid = mysql_fetch_assoc($cids)){
  $body .= "<div class='comment_box' id='comment_cid_".$cid["cid"]."'>";
  $body .=  "<div class='comment_img' data-url='./index.php?mypageid=".$cid["uid"]."'><img src='https://graph.facebook.com/".$cid["uid"]."/picture'class='img-rounded' alt=''></div>";
  $body .=  "<div class='comment_text'>";
  $body .=   "<div class='comment_body'><span id='comment_body_cid_".$cid["cid"]."'>".$cid["comment"]."</span></div>";
  $body .=   "<div class='comment_time'><span><span class='glyphicon glyphicon-time' aria-hidden='true'></span>".$cid["time"]."</span></div>";
  $body .=  "</div>";//comment_text
  if($cid["uid"] == $uid){
    $body .= "<div class='comment_delete'><span id='".$cid["cid"]."' class='delete glyphicon glyphicon-remove-circle' aria-hidden='true'></span></div>";
  }
  $body .= "</div>";//comment_box
}
$body .= "</div>";//comment_boxes
//$body .= "</div>";// class='article'

$data = array('body' => $body,'aid' => $article["aid"]);
echo json_encode($data);
header('Content-Type: application/json; charset=utf-8');

?>