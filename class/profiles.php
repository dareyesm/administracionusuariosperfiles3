<?php

class Profiles{
	
	//atributos
	public $nameProf;
	public $objDb;
	public $result;
	
	public function __construct(){ 
	
		$this->objDb = new Database();
	
	}
	
	public function show_profiles(){
		
		$query = "SELECT * FROM profiles";
		$this->result = $this->objDb->select($query);
		return $this->result;		
		
	}
	
	public function new_profile(){
		
		date_default_timezone_set("America/Bogota");
		$date = date("Y") . "-" . date("m") . "-" . date("d");
		
		$query = "INSERT INTO profiles VALUES(default, '".$_POST["code"]."', '".$_POST["name"]."', 
			'".$_POST["desc"]."', '".$date."', '".$_POST["status"]."')";
		$this->objDb->insert($query);
		
	}
	
	public function single_profile($idProf){
		
		$query = "SELECT * FROM profiles WHERE idProfile = '".$idProf."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function modify_profile(){
		
		$query = "UPDATE profiles SET codeProfi = '".$_POST["code"]."', nameProfi = '".$_POST["name"]."', 
			descProfi = '".$_POST["desc"]."', statusPro = '".$_POST["status"]."' WHERE idProfile = '".$_POST["idProf"]."' ";
		$this->objDb->update($query);
		
	}
	
	public function delete_profile(){
		
		$query = "DELETE FROM profiles WHERE idProfile = '".$_GET["idPerfil"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function assign_module(){
		
		$query = "DELETE FROM mod_profile WHERE idProfile = '".$_POST["idPerfil"]."' ";
		$this->objDb->delete($query);
		$query = "SELECT * FROM modules";
		$this->result = $this->objDb->select($query);
		while($row=mysql_fetch_array($this->result)){
			$name_module = str_replace(' ', '_', $row["nameModule"]);
			if(isset($_POST[$name_module])){
				mysql_query("INSERT INTO mod_profile VALUES(default, '".$row["idmodule"]."', '".$_POST["idPerfil"]."')");
			}
		}
		
	}
	
	public function look_assign($idModule, $idProf){
		
		$query = "SELECT * FROM mod_profile WHERE idmodule = '".$idModule."' AND idProfile = '".$idProf."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function user_pro($pro){
		
		echo $pro; die();
		
		$query = "SELECT * FROM mod_profile, user_pro WHERE user_pro.idUsers = '".$_SESSION["iduser"]."' 
			AND mod_profile.idProfile = user_pro.idProfile ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
}

?>