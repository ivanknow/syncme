<?php
abstract class AbstractConnection
{
	abstract public function Conecta();
	/*Esse metodo encerra a conexao*/
	abstract public function Desconecta();
	/*Esse metodo Executa comando sem retorno de dados(insert,delete ou update)*/
	abstract public function Executa($comando);
	/*Esse metodo eh o responsavel por retornar dados para a aplicacao*/
	abstract public function Consulta($consulta);

	abstract public function getResultAsVector($consulta);
	
	abstract public function getMaxId($tableName);

}
?>
