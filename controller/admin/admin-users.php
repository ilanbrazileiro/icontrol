<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Usuario;
use \Hcode\Config\Paginacao;

$app->get("/admin/users/:iduser/password", function($iduser){//tela alterar senha

	Usuario::verifyLogin();

	$user = new Usuario();

	$user->get((int)$iduser);

	$page = new PageAdmin();

	$page->setTpl("users-password", [
		"user"=>$user->getValues(),
		"msgError"=>Usuario::getError(),
		"msgSuccess"=>Usuario::getSuccess()
	]);

});

$app->post("/admin/users/:iduser/password", function($iduser){//Verificar e salva a senha

	Usuario::verifyLogin();

	if (!isset($_POST['senha']) || $_POST['senha']==='') {

		Usuario::setError("Preencha a nova senha.");
		header("Location: /admin/users/$iduser/password");
		exit;

	}

	if (!isset($_POST['senha-confirm']) || $_POST['senha-confirm']==='') {

		Usuario::setError("Preencha a confirmação da nova senha.");
		header("Location: /admin/users/$iduser/password");
		exit;

	}

	if ($_POST['senha'] !== $_POST['senha-confirm']) {

		Usuario::setError("Confirme corretamente as senhas.");
		header("Location: /admin/users/$iduser/password");
		exit;

	}

	$user = new Usuario();

	$user->get((int)$iduser);

	$user->setPassword(Usuario::getPasswordHash($_POST['senha']));

	Usuario::setSuccess("Senha alterada com sucesso.");

	header("Location: /admin/users/$iduser/password");
	exit;

});


$app->get("/admin/users", function() {//Listar Usuarios

	Usuario::verifyLogin();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = Paginacao::getPageSearch($search, $page, 10, 'usuario');

	} else {

		$pagination = Paginacao::getPage($page, 10, 'usuario');

	}

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/users?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"users"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	));

});

$app->get("/admin/users/create", function() {//Tela de cadastrar usuario

	Usuario::verifyLogin();
	
	$matricula = Usuario::getProximaMatricula();

	$page = new PageAdmin();

	$page->setTpl("users-create", array(
		"matricula"=>$matricula
	));

});

$app->get("/admin/users/:iduser/delete", function($iduser) {//deletar o usuario

	Usuario::verifyLogin();	

	$user = new Usuario();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /admin/users");
	exit;

});

$app->get("/admin/users/:iduser", function($iduser) {//tela de editar o usuario

	Usuario::verifyLogin();

	$user = new Usuario();

	$user->get((int)$iduser);

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));

});

$app->post("/admin/users/create", function() {//Cadastrar dados do usuario

	Usuario::verifyLogin();
	
	$user = new Usuario();
	
	$_POST['senha'] = Usuario::getPasswordHash($_POST['senha']);

	$user->setData($_POST);

	$user->save();

	header("Location: /admin/users");
	exit;

});

$app->post("/admin/users/:iduser", function($iduser) {//Atualizar dados do usuario

	Usuario::verifyLogin();

	$user = new Usuario();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();	

	header("Location: /admin/users");
	exit;

});

 ?>