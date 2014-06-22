<?php
class ProfileController extends AbstractController{


	public function __construct(){
		$this->setDao(new ProfileDAO());
	}


	public function cadastrar(Profile $profile){

		$this->validarCadastrar($profile);
		return $this->getDao()->inserir($profile);

	}

	public function atualizar(Profile $profile){

		$this->validarCadastrar($profile);

		return $this->getDao()->atualizar($profile);

	}

	public function apagar(Profile $profile){
		return $this->getDao()->apagar($profile);
	}

	public function buscarTodos(Profile $profile){
		return $this->getDao()->buscarTodos($profile);
	}

	public function buscarUnico(Profile $profile){
		return $this->getDao()->buscar($profile);
	}


	private function validarCadastrar(Profile $profile){

		if(trim($profile->getEmail())==""){
			throw new Exception("Email is a required field");
		}
		if(trim($profile->getPassword())==""){
			throw new Exception("Password is a required field");
		}
	}
	
}