<?php

class ExampleController extends AbstractController{
	
	
	public function __construct(){
		$this->setDao(new PessoaDAO());
	}
	
	public function sayHelloController($nome){
		return "Hello $nome by controller";
		
	}
	
	public function inserir(Pessoa $pessoa){
		
		return $this->getDao()->inserir($pessoa);
	}
}