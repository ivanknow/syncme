<?php

class DMLGenerator{

	public static  function createInsert($tabela,$attr = array(),$prefixo=""){

		foreach($attr as $chave => $valor){
				
			$campos[] = $prefixo.$chave;
			$valores[] = "'".str_replace("'","\"",$valor)."'";

		}

		$insert = "insert into ".$tabela." (".implode($campos,",").") values ( ".implode($valores,",").");";

		return $insert;
	}

	public static  function createUpdate($tabela,$attr = array(),$prefixo="",$where=""){

		if(isset($attr['id'])){
		$id = $attr['id'];
		}
		foreach($attr as $chave => $valor){

				
			$atualiza[] = $prefixo.$chave." = '".str_replace("'","\"",$valor)."'";

		}
		
		if($where == ""){
			
			$where = " where ".$prefixo."id = $id;";
		}
		

		$update = "update $tabela set ".implode($atualiza,",").$where;
		return $update;
	}
	
	public static  function createDelete($tabela,$id,$prefixo="",$where=""){
		
		if($where == ""){
			
			$where = " where ".$prefixo."id = $id;";
			
		} 
		
		
		$delete = "delete from $tabela".$where;
	
		return $delete;
	}
	
	public static  function createMultInsert($tabela,$multiAttr = array(),$prefixo=""){
	
		$attr = $multiAttr[0];
	
		//guarda campos
		foreach($attr as $chave => $valor){
	
			$campos[] = $prefixo.$chave;
				
		}
	
		//guarda atributos
	
		foreach($multiAttr as  $attrItem){
				
			$valoresItens = array();
			
			foreach($attrItem as  $value){
	
				$valoresItens[] = "'".str_replace("'","\"",$value)."'";
					
			}
				
			$valoresItensString[] = "(".implode($valoresItens,",").")";
	
		}
	
	
		$insert = "insert into ".$tabela." (".implode($campos,",").") values ".implode($valoresItensString,",").";";
	
		return $insert;
	}
}

?>