<?php 

class Pmenu{
	
	public $objDb;
	public $result;
	
	public function __construct(){ 
		$this->objDb = new Database();
	}
	
	public function show_menu(){
		
		$query = "SELECT * FROM menu ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
}

?>