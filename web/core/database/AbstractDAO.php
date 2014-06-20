<?php
abstract class AbstractDAO{

	private $tableName = "";
	private $conn;

	public function __construct(){
	
	}
	
	public function getTableName(){
		return $this->tableName;
	}

	public function setTableName($tableName){
		$this->tableName=$tableName;
	}

	public function getConn(){
		return $this->conn;
	}

	public function setConn($conn){
		$this->conn=$conn;
	}

	public function inserir($obj){
		if(!$this->validarTipo($obj)){

			throw new Exception("Dados Inapropriados");
		}

		$tableName = $this->tableName;


		$comando = DMLGenerator::createInsert($tableName,$this->mapear($obj));
//		echo $comando;

		$this->conn->Conecta();
		$this->conn->Executa($comando);
		$this->conn->Desconecta();


		return true;

	}

	public function atualizar($obj){

		if(!$this->validarTipo($obj)){

			throw new Exception("Dados Inapropriados");
		}

		$tableName = $this->tableName;


		$comando = DMLGenerator::createUpdate($tableName,$this->mapear($obj));

		
			$this->conn->Conecta();
			$this->conn->Executa($comando);
			$this->conn->Desconecta();

		
		return true;
	}

	public function apagar($obj){

		if(!$this->validarTipo($obj)){

			throw new Exception("Dados Inapropriados");
		}

		$tableName = $this->tableName;


		$comando = DMLGenerator::createDelete($tableName,$obj->getId());

			$this->conn->Conecta();
			$this->conn->Executa($comando);
			$this->conn->Desconecta();

	}

	/*public function buscarTodosSerach($obj_pesquisa){

		if($this->validarTipoPesquisa($obj_pesquisa)){

			$this->sql = new SQLGenerator($this->tableName);

			$this->sql->setWhere($this->geraWherePesquisa($obj_pesquisa));

			$this->conn->Conecta();

			$result = $this->conn->getResultAsVector($this->sql->generateSQL());

			$this->conn->Desconecta();

			$objArray = array();

			foreach ($result as $array){

				$objArray[] = $this->criarObjeto($array);

			}

			return $objArray;

		}
		else{

			throw new Exception("Dados Inapropriados");
		}
	}*/

	public function buscarTodos($obj){

		if($this->validarTipo($obj)){
			$this->sql = new SQLGenerator($this->tableName);

			if($this->validarTipoPesquisa($obj)){
				$this->sql->setWhere($this->geraWherePesquisa($obj));
			}
			else{
				$this->sql->setWhere($this->geraWhere($obj));
			}
				
			$this->conn->Conecta();
            
			$result = $this->conn->getResultAsVector($this->sql->generateSQL());

			$this->conn->Desconecta();

			$objArray = array();

			foreach ($result as $array){

				$objArray[] = $this->criarObjeto($array);

			}
			
			return $objArray;

		}
		else{

			throw new Exception("Dados Inapropriados");
		}
	}


	public function contem($obj_pesquisa){

		if($this->validarTipoPesquisa($obj_pesquisa)){

			$this->sql = new SQLGenerator($this->tableName);

			$this->sql->setWhere($this->geraWherePesquisa($obj_pesquisa));

			$this->sql->setFields(array("count(*) count"));

			$this->conn->Conecta();

			$result = $this->conn->getResultAsVector($this->sql->generateSQL());

			$this->conn->Desconecta();

			return $result[0]['count'];

		}
		else{

			throw new Exception("Dados Inapropriados");
		}

	}


	private function geraWhere($obj){

		if($this->validarTipo($obj)){

			$arrayWhere = array();
			$attr = $obj->toArray();

			foreach ($attr as $key => $value){
					
				if($value !== 0 && $value !== '0' && $value !== '' && $value !== '0000-00-00 00:00:00' && $value !== '0000-00-00' ){
						
					$arrayWhere[] = "".$key." = '".$value."'";
				}
			}

			return $arrayWhere;

		}
		else{

			throw new Exception("Dados Inapropriados");
		}
	}

	private function geraWherePesquisa($obj_pesquisa){

		if($this->validarTipoPesquisa($obj_pesquisa)){

			$arrayWhere = array();
			$attr = $obj_pesquisa->toArray();

			foreach ($attr as $key => $value){
				if($value!= null && $value !== 0 && $value !== '0' && $value !== '' && $value !== '0000-00-00 00:00:00' && $value !== '0000-00-00'){
					

					//se tiver o termo min
					if (strpos($key,'Min') !== false) {
						$arrayWhere[] = "".str_replace("Min", "",$key)." >= '".$value."'";
					}
					//se tiver o termo max
					elseif (strpos($key,'Max') !== false) {
						$arrayWhere[] = "".str_replace("Max", "", $key)." <= '".$value."'";
					}
					//se for string
					elseif(is_string($value)){
						$arrayWhere[] = "".$key." like '%".$value."%'";

					}elseif (is_array($value)){
						$whereTemp = "".$key." in (";
						foreach ($value as $v) {
							$whereTemp = "'".$v."',";
						}
						rtrim($whereTemp,",");
						
						$whereTemp .= ")";
						$arrayWhere[] = $whereTemp;		
					}
					//se for numero
					else{
						$arrayWhere[] = "".$key." = '".$value."'";
					}
				}
			}

			return $arrayWhere;

		}
		else{

			throw new Exception("Dados Inapropriados");
		}
	}

	public function buscar($obj){

		$this->sql = new SQLGenerator($this->tableName);
		$this->sql->setWhere(array("id = ".$obj->getId()." "));

		$this->conn->Conecta();

		$result = $this->conn->getResultAsVector($this->sql->generateSQL());

		$this->conn->Desconecta();

		if(count($result)==1){

			$obj = $this->criarObjeto($result[0]);

			return $obj;
		}
		else{
			throw new Exception("Nenhum objeto encontrado");
			return null;
		}

	}

	/*Metodo abstrato que deve mapear o objeto para array*/
	abstract public function mapear($obj);

	abstract public function validarTipo($obj);

	abstract public function validarTipoPesquisa($obj);

	abstract public function criarObjeto($array);

}

?>