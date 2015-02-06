<?php
include "header.php";
require_once "func.php";
require_once "db_func.php";
require 'src/facebook.php';
include "fblogin.php";
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Release Feed</title>
    <meta charset="utf-8">
    <title>Release Feed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link href="/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/func.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="span12" style="margin-left: 0px;">
          <div class="header" align="left" style="margin: 15px;">
            <?php include "head.php"; ?>
          </div><!--div class="header" align="left" style="margin-left: 0px;"-->
        </div><!--div class="span12" style="margin-left: 0px;"-->
        <div class="container">
          <div class="row">
            <div class="col-md-9" id="article_body" role="main">
              test
              <?php
                if(isset($_GET["words"]) && $_GET["words"] != ""){
                  echo "<div id=\"scroll\" data-id=\"false\"></div>";
                  $words = $_GET["words"];
                  $jwords = mb_convert_kana($words, 's');
                  $awords = preg_split('/[\s]+/', $jwords, -1, PREG_SPLIT_NO_EMPTY);
                  $articles = word_search($awords,$db_name);
                }elseif(isset($_GET["cname"]) && $_GET["cname"] != ""){
                  echo "<div id=\"scroll\" data-id=\"false\"></div>";
                  $cname = $_GET["cname"];
                  $articles = search_article_cname($cname,$db_name);
                  // $i=0;
                  // while($article =  mysql_fetch_assoc($articles)){
                  // //株価chart
                  //   if($i == 0){
                  //     echo "<div>";
                  //     echo yahoo_get_stockchart($article["sid"]);
                  //     echo "</div>";
                  //     $i++;
                  //   }
                  // }
                }elseif(isset($_GET["mypageid"]) && $_GET["mypageid"] != ""){
                  echo "<div id=\"scroll\" data-id=\"false\"></div>";
                  $mypageid = $_GET["mypageid"];
                  echo "<div><img src='https://graph.facebook.com/".$mypageid."/picture'class='img-rounded' alt=''>";
                  echo "さんのコメントした記事一覧</div>";
                  $articles = get_mycomment_aid($mypageid,$db_name);
                }else{
                  echo "<div id=\"scroll\" data-id=\"true\"></div>";
                  //include("./page.php");
                  $page = 1;
                  $articles = get_article($db_name,$page);
                }

                echo "<div id=\"uid\" data-id=".$uid."></div>";
                while($article =  mysql_fetch_assoc($articles)){
                  include("body.php");
                }
              ?>
              <p id="page-top"><a href="#wrap">△TOP</a></p>
              <div class="footer" align="left">
              </div><!--div class="footer" align="left"-->
            </div><!--div class="col-md-9" role="main"-->
          </div><!--div class="row"-->
        </div><!--class="container"-->
      </div> <!--div class="row"-->
    </div> <!--div class="container"-->
  </body>
</html>