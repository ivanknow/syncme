<?php
class Profile extends ObjetoSerializavel{

	private $id;
	private $email;
	private $password;
	public function __construct($id = 0,$email= "" ,$password= "" ){
		$this->id = $id;
		$this->email = $email;
		$this->password = $password;

	}

	public static function construct($array){
		return new Profile( $array['id'], $array['email'], $array['password']);

	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password=$password;
	}
	public function equals($object){
		if($object instanceof Profile){

			if($this->id!=$object->id){
				return false;

			}

			if($this->email!=$object->email){
				return false;

			}

			if($this->password!=$object->password){
				return false;

			}

			return true;

		}
		else{
			return false;
		}

	}
	public function toString(){

		return "  [id:" .$this->id. "]  [email:" .$this->email. "]  [password:" .$this->password. "]  " ;
	}

}
?>