<?php

abstract class ObjetoPersistente extends ObjetoSerializavel{

	protected  $id = 0;
	
	public function __construct(){
	
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id=$id;
	}
	
	abstract public static function construct($array);
	

}

?>