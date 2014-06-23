<?php
class ProfileFacade extends AbstractFacade {
	public function __construct() {
		parent::__construct ();
		$this->setController ( new ProfileController());
	}
	public function SIGNUP($array) {
	
		$profile = Profile::construct($array);
		$this->getController()->cadastrar($profile);
		
		return array (
				"msg" => "Sign Up Sucessfully"
		);
	}
	
	public function CHECK_LOGIN($array) {
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
		return array (
				"msg" => $this->getController ()->sayHelloController ( $array ['name'] ) 
		);
	}
	public function GET_TEXT($array) {
		$pessoa = Pessoa::construct ( $array );
		
		if ($this->getController ()->inserir ( $pessoa )) {
			
			return array (
					"msg" => "Inserido com sucesso" 
			);
		} else {
			return array (
					"msg" => "error" 
			);
		}
	}
}
?>