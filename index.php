<?php 
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("ini.php");
include("includes/header.php"); 
include("functions.php"); 

require 'Mustache/Autoloader.php';
Mustache_Autoloader::register();

$options =  array('extension' => '.html');

$m = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates/', $options),
));

$page = getPage();

if (file_exists("class/".$page.".php")){
    include("class/".$page.".php"); 
}

if (file_exists("includes/".$page.".php")){
    include("includes/".$page.".php"); 
}

$tpl = $m->loadTemplate($page);
echo $tpl->render($content);

?>

<?php include("includes/footer.php"); ?>