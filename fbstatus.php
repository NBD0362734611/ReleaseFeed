<?php
if ($user){
//<a class="btn btn-large btn-primary" href="<?php echo $logoutUrl ">Facebookをログアウト</a>
//<!--img class="img-thumbnail" src="https://graph.facebook.com/<?php echo $fid;/picture"-->
echo "<a href=\"./personal.php\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span>".$name."</a>";
}else{
echo "<a class=\"btn btn-large btn-primary\" href=\"".$loginUrl."\">Facebookでログイン</a>";
}
echo "<div id=\"fb-root\"></div>";
echo "<div id=\"uid\" data-id=".$uid."></div>";

?>