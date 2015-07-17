<?php
class Text extends ObjetoSerializavel{

	private $id;
	private $text;
	private $author;
	public function __construct($id = 0,$text = "",$author= null){
		$this->id = $id;
		$this->text = $text;
		$this->author = $author;

	}

	public static function construct($array){
		return new Text( $array['id'], $array['text'], $array['author']);

	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function getText(){
		return $this->text;
	}

	public function setText($text){
		$this->text=$text;
	}

	public function getAuthor(){
		return $this->author;
	}

	public function setAuthor($author){
		$this->author=$author;
	}
	public function equals($object){
		if($object instanceof Text){

			if($this->id!=$object->id){
				return false;

			}

			if($this->text!=$object->text){
				return false;

			}

			if($this->author!=$object->author){
				return false;

			}

			return true;

		}
		else{
			return false;
		}

	}
	public function toString(){

		return "  [id:" .$this->id. "]  [text:" .$this->text. "]  [author:" .$this->author. "]  " ;
	}

}