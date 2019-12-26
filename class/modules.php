<?php

class Modules{
	
	public $nameMod;
	public $objDb;
	public $result;
	
	public function __construct(){ 
	
		$this->objDb = new Database();
	
	}
	
	public function show_modules(){
		
		$query = "SELECT * FROM modules";
		$this->result = $this->objDb->select($query);
		return $this->result;		
		
	}
	
	public function new_module(){
		
		date_default_timezone_set("America/Bogota");
		$date = date("Y") . "-" . date("m") . "-" . date("d");
		
		$query = "INSERT INTO modules VALUES(default, '".$_POST["code"]."', '".$_POST["name"]."', 
			'".$_POST["desc"]."', '".$date."', '".$_POST["status"]."')";
		$this->objDb->insert($query);
		
	}
	
	public function single_module($idmodule){
		
		$query = "SELECT * FROM modules WHERE idmodule = '".$idmodule."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function modify_module(){
		
		$query = "UPDATE modules SET codeModule = '".$_POST["code"]."', nameModule = '".$_POST["name"]."', 
			descModule = '".$_POST["desc"]."', statusModu = '".$_POST["status"]."' WHERE idmodule = '".$_POST["idmodule"]."' ";
		$this->objDb->update($query);
		
	}
	
	public function delete_module(){
		
		$query = "DELETE FROM modules WHERE idmodule = '".$_GET["idmodule"]."' ";
		$this->objDb->delete($query);
		
	}
	
}

?>