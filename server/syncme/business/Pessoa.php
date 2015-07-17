<?php

class Pessoa extends ObjetoPersistente{

	private $nome;
	private $idade;
	public function __construct($id = 0,$nome= "",$idade = 0){
		$this->id = $id;
		$this->nome = $nome;
		$this->idade = $idade;

	}

	public static function construct($array){
		return new Pessoa($array['id'],$array['nome'], $array['idade']);

	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome=$nome;
	}

	public function getIdade(){
		return $this->idade;
	}

	public function setIdade($idade){
		$this->idade=$idade;
	}
	public function equals($object){
		if($object instanceof Pessoa){

			if($this->nome!=$object->nome){
				return false;

			}

			if($this->idade!=$object->idade){
				return false;

			}

			return true;

		}
		else{
			return false;
		}

	}
	public function toString(){

		return " id ".$this->id." [nome:" .$this->nome. "]  [idade:" .$this->idade. "]  " ;
	}


}

?>