<?php
class ProfileController extends AbstractController{

	private $textController;

	public function __construct(){
		$this->setDao(new ProfileDAO());
		$this->textController = new TextController();
	}

	public function cadastrar(Profile $profile){

		$this->validarCadastrar($profile);
		$retorno = $this->getDao()->inserir($profile);
		$profile->setId($retorno);
		$text = new Text();
		$text->setAuthor($profile);
		
		$this->textController->cadastrar($text);
		
		return $retorno;

	}
	
	public function login(Profile $profile){
	
		$this->validarLogin($profile);
		
		$profileBusca = new Profile();
		
		$profileBusca->setEmail($profile->getEmail());
		
		$profileResult = $this->buscarTodos($profileBusca);
		
		if(count($profileResult)==1){ //existe um usuario com aquele email
			if($profileResult[0]->getEmail() === $profile->getEmail() && $profileResult[0]->getPassword() === $profile->getPassword()){
				return $profileResult[0];	
			}
			else{
				//senha incorreta
				throw new Exception("Incorrect Password");
			}
		}else{//usuario não cadastrado
			throw new Exception("This email is not registred");
		}
	
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
		
		//Validar unicidade do email
		$profilePesquisada = new Profile();
		$profilePesquisada->setEmail($profile->getEmail());
		
		$profiles = $this->buscarTodos($profilePesquisada);
		
		if(count($profiles)){
			foreach($profiles as $p){
				if($p->getId()!=$profile->getId()){
					throw new Exception("Email in use");
				}
			}
		}
	}
	
	private function validarLogin(Profile $profile){

		if(trim($profile->getEmail())==""){
			throw new Exception("Email is a required field");
		}
		if(trim($profile->getPassword())==""){
			throw new Exception("Password is a required field");
		}
	}
	
}