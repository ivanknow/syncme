<?php

class ModuleConfig{

	private $moduleName;
	private $dependences;

	public function __construct($moduleName,$dependences = array())
	{
		$this->moduleName = $moduleName;
		$this->dependences = $dependences;
		$this->dependences[] = $moduleName;
		
		spl_autoload_register(array($this, 'findClass'));
	}

	function findClass($className){

		$folders = $this->loadModules();

		foreach ($folders as $folder){
			$value = $folder."/".$className.".php";

			if(file_exists($value)){
				include($value);
			}

		}

	}

	function findFolders($folder,$retorno = array()){

		$retorno[] = $folder;

		if ($handle = opendir($folder)) {
			while (false !== ($entry = readdir($handle))) {

				if($entry!="." && $entry!=".." && substr($entry,0,4)!=".svn"){
					$subFolder = $folder."/".$entry;

					if(is_dir($subFolder)){
						$retorno[] = $subFolder;
						$this->findFolders($subFolder,$retorno);
					}
				}
			}
			closedir($handle);
		}

		return $retorno;
	}

	function loadModules(){

		$allFolders = array();
		foreach($this->dependences as $module){
			$allFolders =	array_merge($allFolders,$this->findFolders("../".$module));
		}

		return $allFolders;
	}
	
	public function callMethod($entrada,$fachada){
		
		$class = new ReflectionClass(get_class($fachada));
		
		if($class->hasMethod($entrada['opt'])){
			$method = $class->getMethod($entrada['opt']);
		
			return $method->invoke($fachada,$entrada);
		}
	}

}



?>