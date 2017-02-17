<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$c = curl_init();

$url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=&max_id=";

$ch = curl_init();

// EXECUTE THE CURL…
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //to suppress the curl output
$result = curl_exec($ch);
curl_close ($ch);

$result = json_decode($result, true);
$likes = 0;
$count = 0;

//echo $result["data"][count($result["data"])-1]["caption"]["id"];
foreach ($result["data"] as $data){
    $likes += $data["likes"]["count"];
    $count++;
}
?>