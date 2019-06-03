<?php 

session_start();

set_time_limit(60);
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once("vendor/autoload.php");

use \Slim\Slim;
$app = new Slim();


$app->config('debug', true);

require_once("includes.php");

$app->run();

 ?>