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
	public function LOGIN($array) {
		
		return array (
				"msg" => "Hi" 
		);
	}
	
	public function LOGOUT($array) {
		return array (
				"msg" => "Hello," . $array ['name'] 
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