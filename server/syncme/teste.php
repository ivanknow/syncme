<?php

date_default_timezone_set("America/Recife");

include '../core/util/ModuleConfig.php';

$conf = new ModuleConfig("module_example",array("core"));

function __autoload($classe){
	$conf = new ModuleConfig("module_example",array("core"));
	$conf->findClass($classe);
}

$fachada = new ExampleFacade();
echo json_encode($fachada->SAY_HI(null));
echo json_encode($fachada->SAY_HELLO_CONT(array("name"=>"Ivan")));
echo json_encode($fachada->INSERIR_PESSOA(array("id"=>0,"nome"=>"Ivan","idade"=>26)));


?>