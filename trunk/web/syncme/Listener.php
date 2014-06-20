<?php
date_default_timezone_set("America/Recife");

include '../core/util/ModuleConfig.php';

$conf = new ModuleConfig("module_example",array("core"));

function __autoload($classe){
	$conf = new ModuleConfig("module_example",array("core"));
	$conf->findClass($classe);
}

if(!isset($_REQUEST['opt'])){
	die("Acesso Indevido");

}else{

	$entrada = $_REQUEST;
	$fachada = new AdministradorFacade();
	try {
		echo json_encode($conf->callMethod($entrada, $fachada));

	} catch (Exception $e) {
		$msg = $e->getMessage();

		echo "{error:1,msgError:$msg}";

	}

}

?>