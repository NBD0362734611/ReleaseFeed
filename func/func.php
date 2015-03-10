<?php
class Release
{
  public function __construct(){

  }

  public function body($rid){
    $db = new DataBase();
    if($release_body = $db->select("release",array( "rid" => $rid , "flg" => 1))){
      echo($release_body[0]["title"]);
      $this->br();
    }

    if($pr_company = $db->selectPressRleaseCompanyFromRid($rid,1)){
      echo($pr_company);
      $this->br();
    }

    if($comments = $db->selectCommentFromRid($rid,1)){
      foreach ($comments as $comment) {
        echo $comment["comment"];
        $this->br();
      }
    }
  }
  /*単体リリース*/
  public function releaseBox($rid){
    $html ="";
    $html .= "
                  <div class=\"post-area clear-after release rid-add\" release-id=\"$rid\" >
                      <section role=\"main\" class=\"release1\">
                          <h3 class=\"release-title\">
                          <a href=\"release-post.html\"><span class=\"title\">タイトル</span></a></h3>
                              <div class=\"portfolio-section preload\">
                                  <article class=\"item column fourth\">
                                  <figure><img class=\"img1\" src=\"\" alt=\"\"></figure>
                                  </article>
                                  <article class=\"item column fourth\">
                                  <figure><img class=\"img2\" src=\"\" alt=\"\"></figure>
                                  </article>
                              </div>
                      </section>
                      <div class=\"widget meta-social column half\">
                          <ul class=\"inline\">
                              <li><a href=\"#\" class=\"twitter-share border-box \"><i class=\"fa fa-comment-o fa-lg\"></i></a></li>
                              <li><a href=\"#\" class=\"facebook-share border-box\"><i class=\"fa fa-facebook fa-lg\"></i></a><span class=\"arrow_box\">22</span></li>
                              <li><a href=\"#\" class=\"pinterest-share border-box\"><i class=\"fa fa-pinterest fa-lg\"></i></a><span class=\"arrow_box\">33</span></li>
                              <li><a href=\"#\" class=\"check border-box\"><i class=\"fa fa-check-square-o fa-lg\"></i></a></li>
                          </ul>
                      </div>
                      <div class=\"column fourth right\">
                          <h5 class=\"meta-post\"><a href=\"#\">IT</a>, <a class=\"company-name cname\" href=\"#\">会社名</a> - <time class=\"time\" datetime=>リリース時刻</time></h5>
                      </div>
                      <section cladd=\"line_wrapper\">
                          <div class=\"question_Box\">
                              <div class=\"question_image column left\"><img src=\"img/facebook_image.jpg\" alt=\"facebookの写真\"/></div>
                              <p class=\"arrow_question column ten reset\">
                              コメントコメントコメント
                              </p><!-- /.arrow_question -->
                          </div><!-- /.question_Box -->
                      </section><!-- /.line_wrappaer -->
                  </div><!-- post-area -->
                  ";
    return $html;
  }

  /*複数リリース*/
  public function releaseBoxes($start=1, $repeat=1){
    $db = new DataBase();
    $html ="";
    for ($i=0; $i < $repeat; $i++) { 
          $rid = $db->getLatestReleaseId($start);
          $start++;
          $html .= $this->releaseBox($rid); 
      }
    return $html;
  }

  /*コメント*/
    public function commentArea($rid){//コメントエリア
      $db = new DataBase();
      $data = $db->selectCommentFromRid($rid);
      $html = "
          <div class=\"comment-section\">
            <h3 id=\"comments\">".$this->commentsNum($rid)."Comments</h3>
            <ul class=\"comment-list plain\">
      ";
      foreach($data as $value){
        $html .= $this->commentBox($value["commentid"]);
      }
      $html .= "
            </ul>
          </div><!-- comment-section -->
      ";
      return $html;
    }

    public function commentsNum($rid){//コメント数
      $db = new DataBase();
      $data = $db->select("r_comment",array("rid"=>$rid));
      $num = count($data);
      return $num;
    }

    public function commentBox($cid){//コメント+そのコメントの返信を書き出す
      $db = new DataBase();
      $a_reply = $db->select("r_comment",array("reply"=>$cid));
      $html = "<li class=\"comment\">";
      $html .= $this->comment($cid);
      foreach ($a_reply as $key => $value) {
        $html .= $this->commentReply($value["commentid"]);
      }
      $html .= "<li class=\"comment\">";
      return $html;
    }

    public function commentReply($cid){//コメントリプライのエリアを書き出す
      $db = new DataBase();
      $a_reply =  $db->select("r_comment",array("reply"=>$cid));
      $html = "<ul class=\"children plain\">
                      <li class=\"comment\">";
      $html .= $this->comment($cid);
      foreach ($a_reply as $key => $value) {
        $html .= $this->commentReply($value["commentid"]);
      }

      $html .= "</li>
                    </ul>";
      return $html;
    }

    public function comment($cid){//コメント1件を書き出す
      $db = new DataBase();
      $comment = $db->select("r_comment",array("commentid"=>$cid));
      $html = "
          <div class=\"single-comment\">
            <div class=\"comment-author\">
              <img src=\"http://placehold.it/60x60\" class=\"avatar\" alt=\"\">
              <cite><a href=\"#\">".$comment[0]["uid"]."</a></cite>
              <span class=\"says\">says:</span>
            </div><!-- comment-author -->
            <div class=\"comment-meta\">
              <time datetime=\"\">".$comment[0]["time"]."</time> / <a href=\"#\" class=\"reply\">Reply</a>
            </div><!-- comment-meta -->
            <p>".$comment[0]['comment']."</p>
          </div><!-- single-comment -->";
      return $html;
    }



  private function br($repeat = 1){
    for ($i=0; $i < $repeat; $i++) { 
      echo "<br>";
    }
  } 
}  
?>