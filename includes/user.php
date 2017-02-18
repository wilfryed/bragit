<?php
if (isLogged()){
    $user = new User($_SESSION['userid']);
    $content = $user->display();
    //var_dump($user->display());
}else{
    $content = array('username' => "fail");
}


?>