<?php
class Release
{
  public function __construct(){
  }

  public function body($rid){
    $data_base = new DataBase();
    if($release_body = $data_base->select("release",array( "rid" => $rid , "flg" => 1))){
      echo($release_body[0]["title"]);
      $this->br();
    }

    //$yahoo_finance = new yahooFinance;
    //$stock_Info = $yahoo_finance->getStockInfo($release_body[sid]);

    if($pr_company = $data_base->selectPressRleaseCompanyFromRid($rid,1)){
      echo($pr_company);
      $this->br();
    }

    if($comments = $data_base->selectCommentFromRid($rid,1)){
      foreach ($comments as $comment) {
        echo $comment["comment"];
        $this->br();
      }
    }
  }
    public function commentArea($rid){//コメントエリア
      $html = "
          <div class=\"comment-section\">
            <h3 id=\"comments\">19 Comments</h3>
            <ul class=\"comment-list plain\">
      ";
      $db = new DataBase();
      $data = $db->selectCommentFromRid($rid);
      foreach($data as $value){
        $this->commentBox($value["commentid"]);

      }
      $html .= "
            </ul>
          </div><!-- comment-section -->
      ";
      echo $html;
    }

    public function commentsNum($rid){//コメント数

    }

    public function commentBox($cid){//コメント+返信
      //replyidがあればインクルード
      $html = "
          <li class=\"comment\">
      ";
      $db = new DataBase();
      $comment = $this->comment($cid);
      $html .= "$comment";
      $a_reply = $this->commentReply($cid);
      $html .="
          <ul class=\"children plain\">
        ";
      foreach ($a_reply as $key => $value) {
        $html .="
          <li class=\"comment\">
        ";

        $html .="
          </li>
        ";
      }
      // var_dump($comment);
      // var_dump($a_reply);
      $html .="
          </ul>
      ";
      $html = "
          <li class=\"comment\">
      ";
    }
    public function comment($cid){//コメント1件
      $db = new DataBase();
      $comment = $db->select("r_comment",array("commentid"=>$cid));
      $html = "
          <div class=\"single-comment\">
            <div class=\"comment-author\">
              <img src=\"http://placehold.it/60x60\" class=\"avatar\" alt=\"\">
              <cite><a href=\"#\">Mark Robben</a></cite>
              <span class=\"says\">says:</span>
            </div><!-- comment-author -->
            <div class=\"comment-meta\">
              <time datetime=\"2013-03-23 19:58\">March 23, 2013 at 7:58 pm</time> / <a href=\"#\" class=\"reply\">Reply</a>
            </div><!-- comment-meta -->
            <p>".$comment[0]['comment']."</p>
          </div><!-- single-comment -->
      ";
      return $html;
    }
    public function commentReply($cid){//コメント返信
      $db = new DataBase();
      $a_reply = $db->select("r_comment",array("reply"=>$cid));
      return $a_reply;
    }
  private function br(){
    echo "<br>";
  } 
}  
?>