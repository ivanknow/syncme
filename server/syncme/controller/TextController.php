<?php
class TextController extends AbstractController{


	public function __construct(){
		$this->setDao(new TextDAO());
	}


	public function cadastrar(Text $text){

		return $this->getDao()->inserir($text);

	}
	
	
	public function atualizar(Text $text){

		return $this->getDao()->atualizar($text);

	}

	public function apagar(Text $text){
		return $this->getDao()->apagar($text);
	}

	public function buscarUnico(Text $text){
		return $this->getDao()->buscar($text);
	}
	
	public function buscarTodos(Text $text){
		return $this->getDao()->buscarTodos($text);
	}

}