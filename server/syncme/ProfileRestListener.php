<?php
date_default_timezone_set("America/Recife");

include '../core/util/ModuleConfig.php';

$module_name = "syncme";

include '../lib/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$conf = new ModuleConfig($module_name,array("core"));

$app = new \Slim\Slim();
$app->get('/text/','getTexto');
$app->get('/user/login/','login');
$app->get('/user/logout/','logout');
$app->get('/text/:id/','updateTexto');

$app->run();



function getTexto() {
	$fachada = new ProfileFacade();
	
	try {
		echo json_encode($fachada->GET_TEXT($_REQUEST));

	} catch (Exception $e) {
		$msg = $e->getMessage();

		echo "{\"error\":1,\"msgError\":\"$msg\"}";

	}
}

function updateTexto($id) {
	$fachada = new ProfileFacade();
	$array = $_REQUEST;
	$array['id'] = $id;
	
	try {
		echo json_encode($fachada->UPDATE_TEXT($array));
	
	} catch (Exception $e) {
		$msg = $e->getMessage();
	
		echo "{\"error\":1,\"msgError\":\"$msg\"}";
	
	}
	
}

function login() {
	
	$fachada = new ProfileFacade();
	
	try {
		echo json_encode($fachada->LOGIN($_REQUEST));

	} catch (Exception $e) {
		$msg = $e->getMessage();

		echo "{\"error\":1,\"msgError\":\"$msg\"}";

	}
	
}

function logout() {

	$fachada = new ProfileFacade();

	try {
		echo json_encode($fachada->LOGOUT());

	} catch (Exception $e) {
		$msg = $e->getMessage();

		echo "{\"error\":1,\"msgError\":\"$msg\"}";

	}

}
	


?>