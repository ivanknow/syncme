<?php
class TextDAO extends AbstractDAO{
private $profileDAO;


	public function __construct(){
	
		$this->profileDAO = new ProfileDAO();
				
		$this->setConn( new ConnectionMySQLPDO());

		$this->setTableName("tb_text");

	}

	public function mapear($obj){
		
		$array = $obj->toArray();
		$array['idProfile'] = $array['author']->getId(); 
		unset($array['author']);
		return $array;

	}

	public function validarTipo($obj){
		return $obj instanceof Text;

	}

	public function validarTipoPesquisa($obj){
		return $obj instanceof TextPesquisa;

	}

	public function criarObjeto($array){
		$profile = new Profile();
		$profile->setId($array['idProfile']);
		$array['author'] = $this->profileDAO->buscar($profile);
		return Text::construct($array);

	}

}