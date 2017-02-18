<?php

function getPage(){

    if (isset($_GET["page"]) && $_GET["page"] != '' ){
        $page = $_GET["page"];
    }else{
        $page = "home";
    }

    return $page;

}

function isLogged(){

    if (isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        if (isset($_SESSION['userid']) && $_SESSION['userid'] != ''){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}

function curlIt($url, $post = false){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    if ($post){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //to suppress the curl output
    $result = curl_exec($ch);
    curl_close ($ch);

    $result = json_decode($result, true);

    return $result;

}
?>