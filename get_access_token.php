<?php 

   $app_id = "5ca5sdfadsfafasdf1bb08d7ce";
   $app_secret = "a28cf7basdfdsafdsfadsfadsf78e1a";
   $my_url = "http://utc.kekebox.com/get_access_token.php";
   $grant_type="authorization_code";

   session_start();
   $code = $_REQUEST["code"];
   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
     $dialog_url = "https://graph.renren.com/oauth/authorize?client_id=" 
       . $app_id."&response_type=code" ."&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'];
     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }

   if($_REQUEST['state'] == $_SESSION['state']) {
     $token_url = "https://graph.renren.com/oauth/token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret ."&grant_type=" . $grant_type . "&code=" . $code;

     $response = @file_get_contents($token_url);
     $params = explode(",", $response); 
      echo(substr($params[13],16,70)); 

/*
     $graph_url = "https://api.renren.com/v2/user?access_token=" 
       . $response['access_token'];

     $user = json_decode(file_get_contents($graph_url));
     //var_dump($params);
     //echo($response['access_token']);
     //echo("Hello " . $user->name);
     */
   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }

 ?>