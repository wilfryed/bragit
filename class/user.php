<?php

class User{

    private $_content;

    public function __construct($userid){
        $json = file_get_contents('users/'.$userid.'.json');
        $this->_content = json_decode($json, true);
    }

    private function userSelf(){
        $content = $this->_content;

        $url = "https://api.instagram.com/v1/users/self/?access_token=".$content['token'];

        $result = curlIt($url);

        $return = $result["data"]["counts"];

        return $return;
    }

    private function mediaRecent(){
        $content = $this->_content;

        $url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=".$content['token'];

        $result = curlIt($url);

        $likes = 0;

        //echo $result["data"][count($result["data"])-1]["caption"]["id"];
        foreach ($result["data"] as $data){
            $likes += $data["likes"]["count"];
        }

        return $likes;
    }

    public function display(){

        $content = $this->_content;
        $userSelf = $this->userSelf();
        $mediaRecent = $this->mediaRecent();

        $return = array(
            'username' => $content["username"],
            'likes_count' => $mediaRecent,
            'pics_count' => '20',
            'followed_by' => $userSelf['followed_by'],
            'follows' => $userSelf['follows'],
            'media' => $userSelf['media']
        );
        return $return;
    }

}

?>