<?php
abstract class AbstractFacade{

	private $controller;


	public function __construct(){
	
	}
	
	public function getController(){
		return $this->controller;
	}
	
	public function setController($controller){
		$this->controller=$controller;
	}
}