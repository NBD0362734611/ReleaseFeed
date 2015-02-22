<?php
class Article
{
  public function show($aid){
    $data_base = new DataBase;
    $article_body = $data_base->selectArticle("aid",$aid,1);
    $yahoo_finance = new yahooFinance;
    $stock_Info = $yahoo_finance->getStockInfo($article_body[sid]);
    
    echo 
    "
    <div class=\"article\" article-id=\"$article_body[aid]\">
      <span  class=\"article_title\">
        $article_body[title]
      </span>
      <span class=\"article_company\">
        $article_body[cname]
      </span>
      <span class=\"article_stock_code\">
        $article_body[sid]
      </span>
      <span class=\"article_stock_price\">
        $stock_Info[price]
      </span>
      <div class=\"article_img_box\">
        <span class=\"article_img\" data-id=\"$article_body[img1]\">
        </span>
        <span class=\"article_img\" data-id=\"$article_body[img2]\">
        </span>
        <span class=\"article_img\" data-id=\"$article_body[img3]\">
        </span>
        <span class=\"article_img\" data-id=\"$article_body[img4]\">
        </span>
        <span class=\"article_img\" data-id=\"$article_body[img5]\">
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
    ";// class='article'



  }
}

?>