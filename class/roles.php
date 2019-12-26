<?php

class Roles{
	
	public $nameRol;
	public $objDb;
	public $result;
	
	public function __construct(){ 
	
		$this->objDb = new Database();
	
	}
	
	public function show_roles(){
		
		$query = "SELECT * FROM roles, modules WHERE roles.idmodule = modules.idmodule ORDER BY idRole ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_role(){
		
		date_default_timezone_set("America/Bogota");
		$date = date("Y") . "-" . date("m") . "-" . date("d");
		
		$query = "INSERT INTO roles VALUES(default, '".$_POST["code"]."', '".$_POST["name"]."', 
			'".$_POST["desc"]."', '".$date."', '".$_POST["status"]."', '".$_POST["module"]."')";
		$this->objDb->insert($query);
		
	}
	
	public function single_role($idrole){
		
		$query = "SELECT * FROM roles, modules WHERE roles.idRole = '".$idrole."' 
			AND roles.idmodule = modules.idmodule";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function modify_role(){
		
		$query = "UPDATE roles SET codeRole = '".$_POST["code"]."', nameRole = '".$_POST["name"]."', 
			descRole = '".$_POST["desc"]."', statRole = '".$_POST["status"]."', idmodule = '".$_POST["modules"]."' 
			WHERE idRole = '".$_POST["idrole"]."' ";
		$this->objDb->update($query);
		
	}
	
	public function module_role($idmodule){
		
		$query = "SELECT * FROM roles WHERE idmodule = '".$idmodule."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function delete_role(){
		
		$query = "DELETE FROM roles WHERE idRole = '".$_GET["idrole"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function assign_roles(){
		
		$query = "DELETE FROM role_user WHERE idUsers = '".$_POST["idUser"]."' ";
		$this->objDb->delete($query);
		
		$counter = 1;
		
		$result = $this->show_roles();
		
		//print_r($_POST);
		
		

		while($row=mysql_fetch_array($result)){
			
			$namerole = 'role' . $counter;
			if(isset($_POST[$namerole])){
				/*echo "<br>";
				echo $namerole . "--";
				echo $_POST[$namerole]. "<BR>";*/
				$query = "INSERT INTO role_user VALUES(default,'".$_POST["idUser"]."','".$_POST[$namerole]."')";
				$this->objDb->insert($query);
			}
			
			$counter = $counter + 1;
			
		}

	}
	
}

?>