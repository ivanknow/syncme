<?php
class ConnectionMysql extends AbstractConnection
{
	/*A seguir se encontram os paramatros que sao usados para fazer a conexao com o Mysql*/
	private $user = "root";
	private $password = "";
	private $host = "localhost";
	private $database = "example_eleve";
	private $conn = null;
	
	/*Essa variavel guarda as consultas que servico feitas no banco*/
	private $query = "";
	/*Essa variavel guarda uma variavel de conexao*/
	private $link = "";
	public function __construct()
	{
			
	}
	/*Esse metodo e o responsavel por fazer a conexao*/
	public function Conecta()
	{
		$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->user, $this->password);

	}
	/*Esse metodo encerra a conexao*/
	public function Desconecta()
	{
		$this->conn = null;
	}
	/*Esse metodo Executa comando sem retorno de dados(insert,delete ou update)*/
	public function Executa($comando)
	{
		return $this->conn->exec($cmd);
	}
	/*Esse metodo eh o responsavel por retornar dados para a aplicacao*/
	public function Consulta($consulta)
	{
		try {
			$result = $this->conn->query($cmd);
		} 
		catch(PDOException $e){
			throw  $e->getMessage();
		}
		
		return $result;
	}

	public function contaRegistros($tabela){
		$valor = $this->Consulta("select count(*) from $tabela");
		if($valor != 0){
			$result = mysql_fetch_assoc($valor);

			return $result['count(*)'];
		}
		else{
			return 0;
		}
	}

	public function getMaxId($tableName){
		$this->Conecta();
		$valor = $this->Consulta("select max(id) max from $tabela");
		$this->Desconecta();
		if($valor != 0){
			$result = mysql_fetch_assoc($valor);

			if($result['max']!=null){
				return $result['max'];
			}
			else{
				return 0;
			}
		}
		else{
			return null;
		}
	}

	public function grav($consulta){
		return $this->getResultAsVector($consulta);
	}

	public function getResultAsVector($consulta){

		$arrayRetorno = array();

		$busca = $this->Consulta($consulta);

		if($busca != 0){

			while($result = mysql_fetch_assoc($busca)){

				$arrayRetorno[] = $result;
					
			}

			return $arrayRetorno;

		}

		else{

			return null;

		}
	}


}
?>
