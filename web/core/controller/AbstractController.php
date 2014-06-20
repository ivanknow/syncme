<?php
abstract class AbstractController {

	private $dao;
	
	public function __construct(){
	}
	
	public function getDao(){
		return $this->dao;
	}
	
	public function setDao($dao){
		$this->dao=$dao;
	}
		
}