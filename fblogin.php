<?php
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '359372300910736',
  'secret' => '7ed24755505f8cab44b950aecf72c101',
));
if (isset($_GET['mode']) && $_GET['mode'] === 'logout') {
 $facebook->destroySession();
 header("location: index.php");
}
// Get User ID
$user = $facebook->getUser();
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
    $fid = $user_profile["id"];
    $uid = $fid;
    $name = $user_profile["name"];
    //var_dump($user_profile);

  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl(array('next' => 'index.php?mode=logout'));
// facebookのセッションを削除
} else {
  $loginUrl = $facebook->getLoginUrl(array('scope' => 'publish_stream'));
}
if(!isset($uid)){
  $uid = 0;
}
?>