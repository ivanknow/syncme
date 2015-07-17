<?php
class ConnectionMysql extends AbstractConnection
{
	/*A seguir se encontram os paramatros que sao usados para fazer a conexao com o Mysql*/
	private $user = "root";
	private $password = "";
	private $host = "localhost";
	private $database = "syncme";

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
		/*O atributo link quarda a conexao estabelecida*/
		$this->link = mysql_connect($this->host,$this->user,$this->password);
		if (!$this->link)
		{
			die("Problema na Conexao com o Banco de Dados");
		}
		elseif (!mysql_select_db($this->database,$this->link))
		{
			die("Problema na Conexao com o Banco de Dados");
		}

	}
	/*Esse metodo encerra a conexao*/
	public function Desconecta()
	{
		return mysql_close($this->link);
	}
	/*Esse metodo Executa comando sem retorno de dados(insert,delete ou update)*/
	public function Executa($comando)
	{
		$this->query = $comando;
		$sql = mysql_query($this->query,$this->link)
		or die(mysql_error($this->link));
	}
	/*Esse metodo eh o responsavel por retornar dados para a aplicacao*/
	public function Consulta($consulta)
	{
		$this->query = $consulta;
		if ($resultado = mysql_query($this->query,$this->link))
		{
			return $resultado;
		} else {
			return 0;
		}
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
		$valor = $this->Consulta("select max(id) max from $tableName");
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
