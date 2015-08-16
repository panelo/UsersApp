<?php

class database {
	private $host = "localhost";
	private $user = "panelo";
	private $db = "users";
	private $pass = "users";
	private $conn;

	public function __construct() {
		$this->conn = new PDO("mysql:host = ".$this->host."; dbname=".$this->db, $this->user, $this->pass);
	}

 	public function retrieve() {
		$sql = "SELECT u.*, ur.name AS role, ud.name AS department    
				FROM users__ u
				LEFT JOIN users__role ur ON ur.id = u.role_id
				LEFT JOIN users__department ud ON ud.id = u.department_id";
 		$q = $this->conn->query($sql) or die("failed!");
 		while($row = $q->fetch(PDO::FETCH_ASSOC)) {
 			$data[]=$row;
 		}
 		return $data;
 	}

 	public function getId($id){
		$sql = "SELECT u.*, ur.name AS role, ud.name AS department, gco.name AS country, gst.name AS state, gsu.name AS suburb, gpc.postcode    
				FROM users__ u
				LEFT JOIN users__role ur ON ur.id = u.role_id
				LEFT JOIN users__department ud ON ud.id = u.department_id
				LEFT JOIN geo__country gco ON gco.id = u.country_id
				LEFT JOIN geo__state gst ON gst.id = u.state_id
				LEFT JOIN geo__suburb gsu ON gsu.id = u.suburb_id
				LEFT JOIN geo__postcode gpc ON gpc.id = u.postcode_id
				WHERE u.id = :id";
		$q = $this->conn->prepare($sql);
		$q->execute(array(':id' => $id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		return $data;
 	}
}
?>
