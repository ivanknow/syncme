<?php 

class ProfileDAO extends AbstractDAO{

		public function __construct(){

		$this->setConn(new ConnectionMysql());

		$this->setTableName("tb_profile");

	}

	public function mapear($obj){
		$array = $obj->toArray();
		
		return $array;
	}

	public function validarTipo($obj){
		return $obj instanceof Profile;

	}

	public function validarTipoPesquisa($obj){
		return $obj instanceof ProfilePesquisa;

	}

	public function criarObjeto($array){
		return Profile::construct($array);
	}

}
?>