<?php
class ProfileFacade extends AbstractFacade {
	
	private $textController;
	public function __construct() {
		parent::__construct ();
		$this->setController ( new ProfileController());
		$this->textController = new TextController();
	}
	public function SIGNUP($array) {
	
		$profile = Profile::construct($array);
		
		$this->getController()->cadastrar($profile);
		
		return array (
				"msg" => "Sign Up Sucessfully"
		);
	}
	
	public function CHECK_LOGIN($array=array()) {
		session_start();
		if(isset($_SESSION['user'])){
			$profile = Profile::construct($_SESSION['user']);
			$array =  $profile->toArray();
			$array['password'] = "";
			 
			
		}else{
			$array =  array("error"=>1,"msgError"=>"You need to do the login");
		}
		return $array;
	
	}
	public function LOGIN($array) {
		$profile = new Profile();
		$profile->setEmail($array['email']);
		$profile->setPassword($array['password']);
		
		session_start();
		$_SESSION['user'] = $this->getController()->login($profile)->toArray();
		
		return array (
				"msg" => "Login Successfull"
		);
		
	}
	
	public function LOGOUT($array) {
		session_start();
		session_destroy();
		return array (
				"msg" => "Login Successfull"
		);
		
	}
	
	public function UPDATE_TEXT($array) {
		$retorno = $this->CHECK_LOGIN();
		if(!isset($retorno['error'])){
			$profile = Profile::construct($_SESSION['user']);
			$text = new Text();
			$text->setAuthor($profile);
			$text->setText($array['text']);
			$text->setId($array['id']);
			$this->textController->atualizar($text);
			return array("msg"=>"Updated");
			
		}else{
			throw new Exception("You must login");
		}
		
	}
	public function GET_TEXT($array) {
		$retorno = $this->CHECK_LOGIN();
		if(!isset($retorno['error'])){
			$profile = Profile::construct($_SESSION['user']);
			$text = new Text();
			$text->setAuthor($profile);
			$result = $this->textController->buscarTodos($text);
			$novo = $result[0];
			return $novo->toArray();
		}else{
			throw new Exception("You must login");
		}
		
		
		
	}
}
?>