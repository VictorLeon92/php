<?php

// Clase Proyecto
class Proyecto {

	// Propiedades del modelo
	private $id;
	private $nombre;
	private $imagen;
	private $tecnologia;
	private $descripcion;
	private $link;
	private $db;

// Constructor de la clase con la conexión de la base de datos
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
	public function getImagen(){
		return $this->imagen;
	}
	public function getTecnologia(){
		return $this->tecnologia;
	}
	public function getDescripcion(){
		return $this->descripcion;
	}
	public function getLink(){
		return $this->link;
	}

// Métodos set
	public function setId($id){
		$this->id = $this->db->real_escape_string($id);
	}
	public function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}
	public function setImagen($imagen = null){
		$this->imagen = $this->db->real_escape_string($imagen);
	}
	public function setTecnologia($tecnologia){
		$this->tecnologia = $this->db->real_escape_string($tecnologia);
	}
	public function setDescripcion($descripcion = null){
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}
	public function setLink($link = null){
		$this->link = $this->db->real_escape_string($link);
	}

	// Método para listar proyectos
	public function mostrarProyectos(){
		
		$result = false;
		$sql = "SELECT * FROM proyectos;";
		$proyectos = $this->db->query($sql);

		if($proyectos){
			$result = $proyectos;
		}
		return $result;

	}

	// Método para crear un nuevo proyecto
	public function create(){

		$result = false;
		$sql = "INSERT INTO proyectos VALUES(
				null, 
				'{$this->getNombre()}', 
				'images/{$this->getImagen()}', 
				'{$this->getTecnologia()}', 
				'{$this->getDescripcion()}', 
				'{$this->getLink()}')
				;";
		$creation = $this->db->query($sql);

		if($creation){
			$result = $creation;
		}
		return $result;

	}

	// Método para editar proyectos
	public function modify(){

		$result = false;
		
		$sql = "UPDATE proyectos SET 
				nombre = '{$this->getNombre()}', ";
		
		if($this->getLink() != null) {
			$sql .=	"link = '{$this->getLink()}', "; 
		}
		
		$sql .= "tecnologia = '{$this->getTecnologia()}'";

		if($this->getDescripcion() != null) {
			$sql .= ", descripcion = '{$this->getDescripcion()}'";
		}
		
		$sql .= " WHERE id = {$this->getId()};";

		$save = $this->db->query($sql);

		if($this->getImagen() != null){
			$sql = "UPDATE proyectos SET imagen = 'images/{$this->getImagen()}' WHERE id = {$this->getId()};";
			$save_img = $this->db->query($sql);
		}

		if($save){
			$result = true;
		}
		return $result;

	}
	
	// Método para borrar proyectos
	public function delete(){

		$result = false;
		
		$sql = "DELETE FROM proyectos WHERE id = {$this->getId()};";

		$deleted = $this->db->query($sql);

		if($deleted){
			$result = true;
		}
		return $result;

	}

}
