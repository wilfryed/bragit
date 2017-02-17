<?php
//https://www.instagram.com/oauth/authorize/?client_id=646945bf52b9495c9155a65700b79f45&redirect_uri=http://wilfryed.com/app/bragit/oauth.php&response_type=code

error_reporting(E_ALL);
ini_set("display_errors", 1);

if (isset($_GET['code']) && $_GET['code'] != ''){
    $code = $_GET['code'];

    $c = curl_init();

    $postfields = array(
        "client_id" => "",
        "client_secret" => "",
        "grant_type" => "authorization_code",
        "code" => $code,
        "redirect_uri" => ""
    );

    $url = "https://api.instagram.com/oauth/access_token";

    $ch = curl_init();

    // EXECUTE THE CURL…
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //to suppress the curl output
    $result = curl_exec($ch);
    curl_close ($ch);


    $result = json_decode($result, true);

    //var_dump($result);
    $filename = $result["user"]["username"].".json";
    $content = array('id' => $result["user"]["id"], 'username' => $result["user"]["username"], 'token' => $result["access_token"]);
    $content = json_encode($content);
    
    file_put_contents($filename, $content);
    
    //echo $result["access_token"];
}
?>