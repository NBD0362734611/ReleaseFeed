<?php
echo '
            <div style="width: 200px;float: left;">
              <a href="index.php"><img src="/img/releasefeed_logo.png" style="width: 200px;"></a>
            </div>
            <div class="search-box input-group col-xs-9">
              <input type="text" class="form-control search-form-control" id="search-input" name="Search" placeholder="Search">
              <span class="input-group-btn">
                <button class="search-btn btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
                </span>
            </div>
';
            include "fbstatus.php";
echo "<div class='push_msg_box' data-url='./notice.php' style='display:none;'>";
echo  "ーお知らせー<br>";
echo  "<span id='push_msg_comment'></span><br>";
//echo  "<span id='push_msg_good'></span><br>";
//echo  "<span id='push_msg_favorite'></span><br>";
echo "</div>";


?>