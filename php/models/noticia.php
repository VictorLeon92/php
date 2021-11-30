<?php

// Clase Noticia
class Noticia {

	// Propiedades del modelo
	private $id;
	private $autor;
	private $nombre;
	private $short;
	private $texto;
	private $imagen;
	private $db;

// Constructor de la clase con la conexión a la base de datos
	public function __construct(){
		$this->db = Database::connect();
	}

// Métodos get
	public function getId(){
		return $this->id;
	}
	public function getAutor(){
		return $this->autor;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function getShort(){
		return $this->short;
	}
	public function getTexto(){
		return $this->texto;
	}
	public function getImagen(){
		return $this->imagen;
	}

// Métodos set
	public function setId($id){
		$this->id = $this->db->real_escape_string($id);
	}
	public function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}
	public function setShort($short){
		$this->short = $this->db->real_escape_string($short);
	}
	public function setTexto($texto){
		$this->texto = $this->db->real_escape_string($texto);
	}
	public function setImagen($imagen){
		$this->imagen = $this->db->real_escape_string($imagen);
	}
	
	// Método para listar noticias
	public function mostrarNoticias(){
		
		$result = false;
		$sql = "SELECT * FROM noticias ORDER BY id DESC LIMIT 6;";
		$noticias = $this->db->query($sql);

		if($noticias){
			$result = $noticias;
		}
		return $result;

	}

}
