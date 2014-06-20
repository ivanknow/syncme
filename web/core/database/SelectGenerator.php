<?php

class SelectGenerator{
	private $tabela;
    private $ordem;
    private $porPagina;
    private $pagina;
    private $numItens;
    private $qtdPaginas;
    private $offset;
	
	public static function geraComboBoxPaginas($numReg,$porPagina){
	$qtdPaginas = ceil($numReg/$porPagina);
	$retorno = "";
	$retorno .= "<select name='pagina' onchange='o.setPagina(this.value)'>";
   
       for($i = 1;$i<=$qtdPaginas;$i++){
           $retorno .= "<option ";
          
           $retorno .= " value='$i'>$i";
           $retorno .= "</option>\n";
       }
       $retorno .= "</select>";
	return  $retorno;
	}
	
	//essa função não será usada porque ela interfere nos valores da anterior
	public static function geraComboBoxPorPagina(){
	$retorno = "";
	$retorno .= "<select name='porPagina' onchange='setPorPagina(this.value)'>";
     
       for($i = 25;$i<=100;$i+=25){
          
		  $retorno .= "<option ";
           
           $retorno .= " value='$i'>$i";
           
		   $retorno .= "</option>\n";
       }
       $retorno .= "</select>";
	
	return  $retorno;
	}
	
	public function __construct($tabela, $ordem, $pagina, $porPagina, $numItens, $where) {
		$this->tabela = $tabela;
        $this->ordem = $ordem;
        $this->pagina = 1;
		$this->porPagina = 1;
        $this->numItens = 1;
		
		if($pagina!=0){
		$this->pagina = $pagina;
		}
		if($numItens!=0){
		$this->numItens = $numItens;
		}
		
		if($porPagina!=0){
		$this->porPagina = $porPagina;
		}
		
		if($where!=""){
        $this->where = $where;
		}else{
		$this->where = 1;
		}
		
		
		$this->qtdPaginas = ceil($this->numItens/$this->porPagina);
		$this->offset = $this->porPagina * ($this->pagina - 1);
		
	}
	
	 public function geraSelectDb() {
        return "select * from ".$this->tabela." where ".$this->where." order by ".$this->ordem." LIMIT ".$this->porPagina." OFFSET ".$this->offset." ;";
    }

}

?>