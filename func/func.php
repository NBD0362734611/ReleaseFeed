<?php
class Release
{
  public function __construct(){

  }
  public function header(){
    //ログイン状態によって分ける
    $html = "<header role=\"banner\" class=\"transparent light\">";
    $html .= $this->headerAfterLogin();
    $html .= $this->headerBeforeLogin();
    $html .= "</header>";
    return $html;
  }
  public function headerBeforeLogin(){
        $html = "";
        $html .="
          <div class=\"row before-login-element\" style=\"display: none;\">
            <div class=\"nav-inner row-content buffer-left buffer-right even clear-after\">
              <div id=\"brand\">
                <h1 class=\"reset\"><!--<img src=\"img/logo.png\" alt=\"logo\">--><a class=\"link\" data-url=\"/\">CrowdPress</a></h1>
              </div><!-- brand -->
              <a id=\"menu-toggle\" class=\"link\" data-url=\"/\"><i class=\"fa fa-bars fa-lg\"></i></a>
              <nav>
                <ul class=\"reset\" role=\"navigation\">
                 <li class=\"menu-item\">
                    <a class=\"link\" data-url=\"newrelease.html\">NewRelease</a>
                  </li>
                  <li class=\"menu-item\">
                    <a class=\"login-btn\">ログイン</a>
                  </li>
                </ul>
              </nav>
            </div><!-- row-content -->
          </div><!-- row -->
          ";
    return $html;
  }
   public function headerAfterLogin(){
    $html = "";
    $html .="        
            <div class=\"row after-login-element\" style=\"display: none;\">
                <div class=\"nav-inner row-content buffer-left buffer-right even clear-after\">
                    <div id=\"brand\">
                        <h1 class=\"reset\"><!--<img src=\"img/logo.png\" alt=\"logo\">--><a class=\"link\" data-url=\"/\">CrowdPress</a></h1>
                    </div><!-- brand -->
                    <a id=\"menu-toggle\" class=\"link\" data-url=\"/\"><i class=\"fa fa-bars fa-lg\"></i></a>
                    <nav>
                        <ul class=\"reset\" role=\"navigation\">
                            <li class=\"menu-item\"><a class=\"link\" data-url=\"newrelease.html\">New Release</a></li>
                            <li class=\"menu-item\"><a class=\"link\" data-url=\"scrap.html\">Scrap</a></li>
                            <li class=\"menu-item\"><a class=\"link\" data-url=\"paper2.html\">My Feed</a></li>
                            <li class=\"menu-item\"><a class=\"link\" data-url=\"mypage-pocket.html\">My Page</a></li>
                            <li class=\"menu-item\"><a class=\"link\" data-url=\"/\">通知</a></li>
                            <li class=\"menu-item\"><a class=\"link\" data-url=\"/\">設定</a>
                                <ul class=\"sub-menu\">
                                    <li><a class=\"link\" data-url=\"/\">マイプロフィール</a></li>
                                    <li><a class=\"link\" data-url=\"/\">アカウント設定</a></li>
                                    <li><a class=\"link logout-btn\" data-url=\"index.html\"  >ログアウト</a></li>
                                    <li>
                                        <a class=\"link\" data-url=\"/\">サブメニュー</a>
                                        <ul class=\"sub-menu\">
                                            <li><a class=\"link\" data-url=\"/\">テスト01</a></li>
                                            <li><a class=\"link\" data-url=\"/\">テスト02</a></li>
                                            <li><a class=\"link\" data-url=\"/\">テスト03</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div><!-- row-content -->
            </div><!-- row -->
            ";
    return $html;
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
                  <div class=\"post-area clear-after release\" release-id=\"$rid\" >
                      <section role=\"main\" class=\"release1\">
                          <h3 class=\"release-title\">
                          <a class=\"link\" data-url=\"release-post.html?rid=$rid\"><span class=\"title\"></span></a></h3>
                          </h3><input type=\"checkbox\" id=\"$rid\"><label for=\"$rid\"></label>
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
                              <li><a class=\"mycomment border-box \"><i class=\"fa fa-comment-o fa-lg\"></i></a></li>
                              <li><a class=\"clap border-box\"><i class=\"fa fa-facebook fa-lg\"></i></a><span class=\"arrow_box\">0</span></li>
                              <li><a class=\"scrap border-box\"><i class=\"fa fa-pinterest fa-lg\"></i></a><span class=\"arrow_box\">0</span></li>
                              <li><a id=\"toggle-edit1\" class=\"edit border-box\"><i class=\"fa fa-pencil-square-o fa-lg\"></i></a></li>

                          </ul>
                      </div>
                      <div class=\"column half right last\">
                          <h5 class=\"meta-post\"><a href=\"#\">IT</a>, <a class=\"company-name cname\" href=\"#\"></a> - <time class=\"time\" datetime=></time></h5>
                      </div>
                      <div class=\"clear\"></div>
                      <div class=\"comment-box\" id=\"comment-box-$rid\">
                        <section class=\"ine_wrapper\">
                            <div class=\"question_Box inline\">
                                <div class=\"question_image column left\"><img class=\"my-pic\" src=\"\" alt=\"\"/></div>
                                <p class=\"arrow_question column ten reset inline-box\">
                                </p><!-- /.arrow_question -->
                                                                <input id=\"comment-$rid\" type=\"text\" style=\"display: block;
  padding: 0px 0px;
  width: 220px;
  height: 102px;
  border: none;
  margin-bottom: 0px;  font-size: 200%;;\" >
                            </div><!-- /.question_Box -->
                            <div class=\"clear\"></div>
                          </section><!-- /.line_wrappaer -->
                        </div>
                  </div><!-- post-area -->
                  ";
    return $html;
  }

  /*新着順複数リリース*/
  public function latestReleaseBoxes($start=1, $repeat=1){
    $db = new DataBase();
    $html ="";
    for ($i=0; $i < $repeat; $i++) { 
          $rid = $db->getLatestReleaseId($start);
          $start++;
          $html .= $this->releaseBox($rid); 
      }
    return $html;
  }

    /*スクラップページリリース*/
  public function scrapReleaseBoxes($start=1, $repeat=1,$uid=0){
    $db = new DataBase();
    $html ="";
    for ($i=0; $i < $repeat; $i++) { 
          $rid = $db->getScrapReleaseId($start,$uid);
          $start++;
          $html .= $this->releaseBox($rid); 
      }
    return $html;
  }

  /*コメント*/
    public function commentArea($rid){//コメントエリア書き出し
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

    public function commentsNum($rid){//コメント数取得
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