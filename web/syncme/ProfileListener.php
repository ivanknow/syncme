<?php
date_default_timezone_set("America/Recife");

include '../core/util/ModuleConfig.php';
$module_name = "syncme";

$conf = new ModuleConfig($module_name,array("core"));

function __autoload($classe){
	$conf = new ModuleConfig("syncme",array("core"));
	$conf->findClass($classe);
}

if(!isset($_REQUEST['opt'])){
	die("{error:1,msgError:Acesso Indevido}");

}else{

	$entrada = $_REQUEST;
	$fachada = new ProfileFacade();
	try {
		echo json_encode($conf->callMethod($entrada, $fachada));

	} catch (Exception $e) {
		$msg = $e->getMessage();

		echo "{\"error\":1,\"msgError\":\"$msg\"}";

	}

}

?>