<?php
session_start();
//https://www.instagram.com/oauth/authorize/?client_id=646945bf52b9495c9155a65700b79f45&redirect_uri=http://wilfryed.com/app/bragit/oauth.php&response_type=code

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("ini.php");
include("functions.php");

if (isset($_GET['code']) && $_GET['code'] != ''){
    $code = $_GET['code'];

    $postfields = array(
        "client_id" => CLIENT_ID,
        "client_secret" => CLIENT_SECRET,
        "grant_type" => "authorization_code",
        "code" => $code,
        "redirect_uri" => REDIRECT_URI
    );

    $url = "https://api.instagram.com/oauth/access_token";

    $result = curlIt($url, $postfields);

    //var_dump($result);
    $filename = $result["user"]["id"].".json";
    $content = array('id' => $result["user"]["id"], 'username' => $result["user"]["username"], 'token' => $result["access_token"]);
    $content = json_encode($content);

    file_put_contents("users/".$filename, $content);

    $_SESSION['logged'] = true;
    $_SESSION['userid'] = $result["user"]["id"];
    
    //echo $result["access_token"];
    header('Location: ../user/');
}
?>