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
            
<!--             <div>
              <a href="/index.php"><img src="/img/releasefeed_logo.png" style="width: 200px;"></a>
            </div> -->
            <?php //include "fbstatus.php";?>
          </div><!--div class="header" align="left" style="margin-left: 0px;"-->
        </div><!--div class="span12" style="margin-left: 0px;"-->
        <div class="container">
          <div class="row">
            <div class="col-md-9" role="main">
              <?php
                $words = $_GET["words"];
                $jwords = mb_convert_kana($words, 's');
                $awords = preg_split('/[\s]+/', $jwords, -1, PREG_SPLIT_NO_EMPTY);
                $articles = word_search($awords,$db_name);
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
      </div> <!--div class="row-fuluid"-->
    </div> <!--div class="container"-->
  </body>
</html>