<?php
class User {
	
	private $id;
	private $first_name;
	private $last_name;
	private $email;
	
	
	public function __construct($first_name, $last_name, $email) {
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email = $email;
	}
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getFirstName(){
		return $this->first_name;
	}

	public function setFirstName($first_name){
		$this->first_name = $first_name;
	}
	public function getLastName(){
		return $this->last_name;
	}

	public function setLastName($last_name){
		$this->last_name = $last_name;
	}
	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}
}
?>