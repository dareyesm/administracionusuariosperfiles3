<?php

class Database{
	
	public $result;
	
	public function __construct(){ }
	
	public function insert($query){
		mysql_query($query);
	}
	
	public function select($query){
		return $this->result = mysql_query($query);
	}
	
	public function update($query){
		mysql_query($query);
	}
	
	public function delete($query){
		mysql_query($query);
	}
	
}

?>