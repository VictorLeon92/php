<?php

// Clase Cita
class Cita {
	
	// Propiedades del modelo
	private $id;
	private $cliente_id;
	private $fecha;
	private $motivo;
	private $db;

// Constructor de la clase que conecta con la base de datos
	public function __construct(){
		$this->db = Database::connect();
	}

// Métodos get
	public function getId(){
		return $this->id;
	}
	public function getClienteId(){
		return $this->cliente_id;
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getMotivo(){
		return $this->motivo;
	}

// Métodos set
	public function setId($id){
		$this->id = $id;
	}
	public function setClienteId($cliente_id){
		$this->cliente_id =  $cliente_id;
	}
	public function setFecha($fecha){
		$this->fecha =  $this->db->real_escape_string($fecha);
	}
	public function setMotivo($motivo){
		$this->motivo =  $this->db->real_escape_string($motivo);
	}
	
	// Método para reservar cita
	public function reserva(){
		$result = false;
		$sql = "INSERT INTO citas VALUES(
			null, 
			{$this->getClienteId()}, 
			'{$this->getFecha()}', 
			'{$this->getMotivo()}'
			);";
		$save = $this->db->query($sql);

		if($save){
			$result = true;
		}
		return $result;

	}


	// Método para listar citas
	public function mostrarCitas(){
		
		$result = false;
		$sql = "SELECT ci.id AS 'cita_id', ci.cliente_id, ci.fecha, ci.motivo, cl.id, cl.nombre, cl.apellidos, cl.email, cl.phone FROM citas ci, clientes cl
			WHERE ci.cliente_id = cl.id;";
		$citas = $this->db->query($sql);

		if($citas){
			$result = $citas;
		}
		return $result;

	}

	// Método para listar las citas de un usuario logueado
	public function misCitas(){
		
		$result = false;
		$sql = "SELECT ci.id AS 'cita_id', ci.cliente_id, ci.fecha, ci.motivo, cl.id, cl.nombre, cl.apellidos, cl.email, cl.phone FROM citas ci, clientes cl
			WHERE ci.cliente_id = cl.id AND cl.email = '".$_SESSION['identity']->email."';";
		$citas = $this->db->query($sql);

		if($citas){
			$result = $citas;
		}
		return $result;

	}

	// Método para eliminar las citas de un usuario
	public function delete(){

		$result = false;
		
		$sql = "DELETE FROM citas WHERE id = {$this->getId()};";

		$deleted = $this->db->query($sql);

		if($deleted){
			$result = true;
		}

		return $result;

	}

	public function changeDate(){
		$result = false;
		$sql = "UPDATE citas SET
				fecha = '{$this->getFecha()}'
				WHERE id = {$this->getId()};";
		$modify = $this->db->query($sql);

		if($modify){
			$result = true;
		}

		return $result;
	}

	// Método para buscar una fecha concreta
	public function checkCita(){

		$result = false;
		
		$sql = "SELECT fecha FROM citas WHERE id = {$this->getId()};";

		$date = $this->db->query($sql);

		if($date){
			$result = $date->fetch_object();
		}

		return $result;

	}

}
