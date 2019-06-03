<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Usuario;

$app->get('/admin', function() {

	Usuario::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

});



$app->get('/admin/login', function() {//Página de Login administrativo

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");
});


$app->post('/admin/login', function() {

	Usuario::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit;

});



$app->get('/admin/logout', function() {

	Usuario::logout();
	header("Location: /admin/login");
	exit;
});



$app->get("/admin/forgot", function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");	

});

$app->post("/admin/forgot", function(){

	$user = Usuario::getForgot($_POST["email"]);

	header("Location: /admin/forgot/sent");
	exit;

});



$app->get("/admin/forgot/sent", function(){



	$page = new PageAdmin([

		"header"=>false,

		"footer"=>false

	]);



	$page->setTpl("forgot-sent");	



});





$app->get("/admin/forgot/reset", function(){



	$user = Usuario::validForgotDecrypt($_GET["code"]);



	$page = new PageAdmin([

		"header"=>false,

		"footer"=>false

	]);



	$page->setTpl("forgot-reset", array(

		"name"=>$user["desperson"],

		"code"=>$_GET["code"]

	));



});



$app->post("/admin/forgot/reset", function(){



	$forgot = Usuario::validForgotDecrypt($_POST["code"]);	



	Usuario::setFogotUsed($forgot["idrecovery"]);



	$user = new Usuario();



	$user->get((int)$forgot["idUsuario"]);



	$password = Usuario::getPasswordHash($_POST["password"]);



	$user->setPassword($password);



	$page = new PageAdmin([

		"header"=>false,

		"footer"=>false

	]);



	$page->setTpl("forgot-reset-success");



});

$app->get("/admin/teste", function(){
	
	$code = Usuario::getPasswordHash("admin");

	echo $code;
	
	
});




 ?>