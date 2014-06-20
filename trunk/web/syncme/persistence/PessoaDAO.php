<?php

class PessoaDAO extends AbstractDAO{
	public function __construct(){
	$this->setConn(new ConnectionMysql());
	$this->setTableName("tb_pessoa");
	}
	
	public function mapear($obj){
		$array = $obj->toArray();
		
		return $array;
	}
	
	public function validarTipo($obj){
		return $obj instanceof Pessoa;
	}
	
	public function validarTipoPesquisa($obj){}
	
	public function criarObjeto($array){
		return Pessoa::construct($array);
	}
}

?>