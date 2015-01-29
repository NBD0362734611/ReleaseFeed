<?php
$titlename = $article["title"];
$article["url"];
echo "<div class='article' data-id='".$article["aid"]."'>";
//タイトル
echo  "<div class='title'><a href='".$article["url"]."' target='_blank'>".$article["title"]."</a></div>";
//詳細
//tempfile_popup_btn($titlename,$relID[$i],$i);
echo "<div class='company_info'>";
//会社名
echo "<div class='company_name'>";
echo  "<span class='glyphicon glyphicon-globe' aria-hidden='true'></span> <a href='./index.php?cname=".$article["cname"]."'>".$article["cname"]."</a><br />";
echo "</div>";
//株価
echo "<div class='stock_code'>";
echo  "<span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>株式コード <a href='http://stocks.finance.yahoo.co.jp/stocks/detail/?code=".$article["sid"]."'>".$article["sid"]."</a><br />";
echo "</div>";
$price = yahoo_get_stockprice($article["sid"]);
echo "</div>";//class='company_info'
//イメージ
echo "<div class='article_img_boxes'>";
echo "<div class='article_img_box' data-url='".$article['img1']."'></div>";
echo "<div class='article_img_box' data-url='".$article['img2']."'></div>";
echo "<div class='article_img_box' data-url='".$article['img3']."'></div>";
echo "<div class='article_img_box' data-url='".$article['img4']."'></div>";
echo "<div class='article_img_box' data-url='".$article['img5']."'></div>";
echo "</div>";
//ツールボックス
echo "<div class='tool-box'>";
  //コメント投稿
  echo '<div class="comment-btn" data-id="'.$article["aid"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>';
  //良いね
  echo '<div class="agood-btn" data-id="'.$article["aid"].'"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><span id="agood-'.$article["aid"].'" >'.$article["good"].'</span></div>';
  //お気に入り
  echo '<div class="afavorite-btn" data-id="'.$article["aid"].'"><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span id="afavorite-'.$article["aid"].'" ></span></div>';
echo "</div>";
echo '  <div class="comment-input-group input-group" id="input-group-'.$article["aid"].'">
          <input type="text" class="comment-form-control form-control" name="'.$article["aid"].'" placeholder="コメント(１４０字以内)">
          <span class="input-group-btn">
              <button id="'.$article["aid"].'" class="comment-submit btn btn-default" type="button">
                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
              </button>
          </span>
        </div>';
//コメント
$cids = get_comment($article["aid"],$db_name);
echo "<div class='comment_boxes' id='comment_aid_".$article["aid"]."'>";
while ($cid = mysql_fetch_assoc($cids)){
  echo "<div class='comment_box' id='comment_cid_".$cid["cid"]."'>";
  echo  "<div class='comment_img' data-url='./index.php?mypageid=".$cid["uid"]."'><img src='https://graph.facebook.com/".$cid["uid"]."/picture'class='img-rounded' alt=''></div>";
  echo  "<div class='comment_text'>";
  echo   "<div class='comment_body'><span id='comment_body_cid_".$cid["cid"]."'>".$cid["comment"]."</span></div>";
  echo   "<div class='comment_time'><span><span class='glyphicon glyphicon-time' aria-hidden='true'></span>".$cid["time"]."</span></div>";
  echo  "</div>";//comment_text
  if($cid["uid"] == $uid){
    echo "<div class='comment_delete'><span id='".$cid["cid"]."' class='delete glyphicon glyphicon-remove-circle' aria-hidden='true'></span></div>";
  }
  echo "</div>";//comment_box
}
echo "</div>";//comment_boxes
echo "</div>";// class='article'
?>