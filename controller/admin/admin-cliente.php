<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\Cliente;
use \Hcode\Model\Usuario;
use \Hcode\Config\Paginacao;

$app->get("/admin/clientes", function() {//Listar Usuarios

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

	$page->setTpl("cliente", array(
		"users"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	));

});