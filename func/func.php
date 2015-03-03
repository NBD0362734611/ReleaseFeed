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

    /*
    return
    "
    <div class=\"release\" release-id=\"$release_body[aid]\">
      <span  class=\"release_title\">
        $release_body[title]
      </span>
      <span class=\"release_company\">
        $release_body[cname]
      </span>
      <span class=\"release_stock_code\">
        $release_body[sid]
      </span>
      <span class=\"release_stock_price\">
        $stock_Info[price]
      </span>
      <div class=\"release_img_box\">
        <span class=\"release_img\" data-id=\"$release_body[img1]\">
        </span>
        <span class=\"release_img\" data-id=\"$release_body[img2]\">
        </span>
        <span class=\"release_img\" data-id=\"$release_body[img3]\">
        </span>
        <span class=\"release_img\" data-id=\"$release_body[img4]\">
        </span>
        <span class=\"release_img\" data-id=\"$release_body[img5]\">
        </span>
      </div>
      <span class=\"post_commnet\">
      </span>
      <span class=\"post_good\">
      </span>
      <span class=\"post_favorite\">
      </span>
      <div class=\"comment_boxes\">
        <div class=\"comment_box\" comment-id=\"\" comment-user-id=\"\">
          <span class = \"comment_img\">
          </span>
          <span class = \"comment_text\">
          </span>
          <span class = \"comment_time\">
          </span>
          <span class = \"comment_good\">
          </span>
          <span class = \"comment_favorite\">
          </span>
          <span class = \"comment_delete\">
          </span>
        </div>
        <div class=\"comment_box\" comment-id=\"\" comment-user-id=\"\">
        </div>
        <div class=\"comment_box\" comment-id=\"\" comment-user-id=\"\">
        </div>
        <div class=\"comment_box\" comment-id=\"\" comment-user-id=\"\">
        </div>
        <div class=\"comment_box\" comment-id=\"\" comment-user-id=\"\">
        </div>
      </div>
    </div>
    ";// class='release'
    */

  }
  private function br(){
    echo "<br>";
  } 
}  
?>