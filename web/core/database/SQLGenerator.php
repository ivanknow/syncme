<?php

class SQLGenerator{

private $tableName;
private $fields;
private $where;
private $orderBy;
private $limit;
private $offset;

public function __construct($tableName,$fields=array(),$where= array(),$orderBy= "" ,$limit = 0,$offset = 0){
$this->tableName = $tableName;
$this->fields = $fields;
$this->where = $where;
$this->orderBy = $orderBy;
$this->limit = $limit;
$this->offset = $offset;

}

public function getTableName(){
return $this->tableName;
}

public function setTableName($tableName){
 $this->tableName=$tableName;
}

public function getFields(){
return $this->fields;
}

public function setFields($fields){
 $this->fields=$fields;
}

public function getWhere(){
return $this->where;
}

public function setWhere($where){
 $this->where=$where;
}

public function getOrderBy(){
return $this->orderBy;
}

public function setOrderBy($orderBy){
 $this->orderBy=$orderBy;
}

public function getLimit(){
return $this->limit;
}

public function setLimit($limit){
 $this->limit=$limit;
}

public function getOffset(){
return $this->offset;
}

public function setOffset($offset){
 $this->offset=$offset;
}
public function toString(){

 return "  [tableName:" .$this->tableName. "]  [fields:" .$this->fields. "]  [where:" .$this->where. "]  [orderBy:" .$this->orderBy. "]  [limit:" .$this->limit. "]  [offset:" .$this->offset. "]  " ;
}

public function generateSQL(){
	
	$comando = "SELECT";
	
	if(is_array($this->fields) && count($this->fields)>0){
			
			$comando .= " ".implode(", ", $this->fields);
		
		}
		else{
			
			$comando .= " * ";
			
		}	
	
		$comando .= " from  ".$this->tableName." ";
		
		if(is_array($this->where) && count($this->where)>0){
		
			$comando .= " where ";
			
			foreach ($this->where as $value){
				
				$comando .= " $value and ";
			}
			
			$comando .= " 1 ";
		
		}
		
		if($this->orderBy != ""){
			
			$comando .= " order by ".$this->orderBy." ";
		}
		
		if($this->limit != 0){
		
			$comando .= " limit =".$this->limit." ";
		}
		
		if($this->offset != 0){
		
			$comando .= " offset =".$this->offset." ";
		}
	
		$comando .= ";";
	
	return $comando;
}

}
?>
