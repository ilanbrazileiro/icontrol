<?php 
#################################################
#												#
#	ARQUIVO COM AS ROTAS DA AREA DO CLIENTE  	#
#												#
#################################################

use \Hcode\Page;//usando a classe Page para carregar as páginas
use \Hcode\Model\User;
use \Hcode\Model\Clientes;

$app->get('/', function() {//configurando a rota e dentro vai a página

	$page = new Page();

	$page->setTpl("index");

});

$app->get("/login", function(){

	$page = new Page();

	$page->setTpl("login", [

		'error'=>Clientes::getError(),

		'errorRegister'=>Clientes::getErrorRegister(),

		'registerValues'=>(isset($_SESSION['registerValues'])) ? $_SESSION['registerValues'] : ['nome'=>'', 'email'=>'', 'telefone'=>'']

	]);



});



$app->post("/register", function(){ ###REGISTRO DO CLIENTE NO SITE



	$_SESSION['registerValues'] = $_POST; ##JOGA OS DADOS EM SESSAO



	if (!isset($_POST['nome']) || $_POST['nome'] == '') {##TESTA NOME



		Clientes::setErrorRegister("Preencha o seu nome.");

		header("Location: /login");

		exit;



	}



	if (!isset($_POST['email']) || $_POST['email'] == '') {##TESTA EMAIL



		Clientes::setErrorRegister("Preencha o seu e-mail.");

		header("Location: /login");

		exit;



	}



	if (!isset($_POST['password']) || $_POST['password'] == '') {##TESTA SENHA



		Clientes::setErrorRegister("Preencha a senha.");

		header("Location: /login");

		exit;



	}



	if ($_POST['password'] !== $_POST['password-confirm']) {##CONFIRMA SENHA



		Clientes::setErrorRegister("As senhas não conferem!");

		header("Location: /login");

		exit;



	}



	if (Clientes::checkLoginExist($_POST['email']) === true) {



		Clientes::setErrorRegister("Este endereço de e-mail já está sendo usado por outro usuário.");

		header("Location: /login");

		exit;



	}



	$cliente = new Clientes();



	$cliente->setData([

		'dt_registro'=>date('Y-m-d'),

		'email'=>$_POST['email'],

		'nome'=>$_POST['nome'],

		'telefone'=>$_POST['telefone'],

		'senha'=>$_POST['password']

	]);



	$cliente->save();



	Clientes::login($_POST['email'], $_POST['password']);



	header('Location: /agendamento');

	exit;



});





$app->post("/login", function(){



	try {



		Clientes::login($_POST['login'], $_POST['password']);



	} catch(Exception $e) {



		Clientes::setError($e->getMessage());

		header("Location: /login");

		exit;

	}



	header("Location: /agendamento");

	exit;



});



$app->get("/logout", function(){



	Clientes::logout();



	header("Location: /login");

	exit;



});





$app->get("/agendamento", function(){



	$page = new Page();



	$page->setTpl("agendamento");



});



 ?>