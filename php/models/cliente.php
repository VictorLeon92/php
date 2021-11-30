<?php

// Clase Cliente
class Cliente {

	// Propiedades del modelo
	private $id;
	private $nombre;
	private $apellidos;
	private $email;
	private $phone;
	private $db;

// Constructor de la clase que conecta con la base de datos
	public function __construct(){
		$this->db = Database::connect();
	}

// Métodos get
	public function getId(){
		return $this->id;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function getApellidos(){
		return $this->apellidos;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getPhone(){
		return $this->phone;
	}

// Métodos set
	public function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}
	public function setApellidos($apellidos){
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}
	public function setEmail($email){
		$this->email = $this->db->real_escape_string($email);
	}
	public function setPhone($phone){
		$this->phone = $this->db->real_escape_string($phone);
	}
	
	// Crea un registro en la tabla de clientes
	public function crear(){
		
		$result = false;
		
		$sql = "SELECT * FROM clientes WHERE email = '{$this->getEmail()}'";
		$check = $this->db->query($sql);

		if ($check->num_rows < 1) {
			$sql = "INSERT INTO clientes VALUES(
				null, 
				'{$this->getNombre()}', 
				'{$this->getApellidos()}', 
				'{$this->getEmail()}', 
				{$this->getPhone()}
				);";
			$save = $this->db->query($sql);
		}

		$sql = "SELECT * FROM clientes WHERE email = '{$this->getEmail()}';";
		$search = $this->db->query($sql);

		if($search){
			$data = $search->fetch_object();
			$result = $data;
		}
		return $result;
	}
}
