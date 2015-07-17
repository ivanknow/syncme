<?php
class DefaultDAO extends AbstractDAO{
	
	public function mapear($obj){
		$array = $obj->toArray();
		 
		$this->getConn()->Conecta();
		 
		if(!isset($array['id']) || $array['id']==0){
			$array['id'] = $this->getMaxId($this->tableName) + 1;
		}
		$this->getConn()->Desconecta();
		 
		return $array;
		
	}
}

?>