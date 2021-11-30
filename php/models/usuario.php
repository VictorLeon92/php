<?php 

class Usuario {
	// Propiedades del modelo
	private $id;
	private $user;
	private $nombre;
	private $apellidos;
	private $email;
	private $password;
	private $telefono;
	private $rango;
	private $db;

	// Método constructor con la conexión a la base de datos
	public function __construct(){
		$this->db = Database::connect();
	}

/* Métodos get */
	public function getId(){
		return $this->id;
	}
	public function getUser(){
		return $this->user;
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
	public function getPassword(){
		return $this->password;
	}
	public function getTelefono(){
		return $this->telefono;
	}
	public function getRango(){
		return $this->rango;
	}

/* Métodos set */
	public function setId($id){
		$this->id = $id;
	}
	public function setUser($user){
		$this->user = $this->db->real_escape_string($user);
	}
	public function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}
	public function setApellidos($apellidos){
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}
	public function setEmail($email){
		$this->email = $this->db->real_escape_string($email);
	}
	public function setPassword($password){
		$this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
	}
	public function setTelefono($telefono){
		$this->telefono = $this->db->real_escape_string($telefono);
	}
	public function setImagen($rango){
		$this->rango = $rango;
	}

	// Método para guardar el nuevo registro de usuario 
	public function save(){
		$sql = "INSERT INTO usuarios VALUES(
				NULL,
				'{$this->getNombre()}',
				'{$this->getNombre()}',
				'{$this->getApellidos()}',
				'{$this->getEmail()}',
				'{$this->getPassword()}',
				NULL,
				'user'
				);";
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	// Método para comprobar los datos de acceso y crear la sesión
	public function login($email, $password){
		$result = false;

		// Comprobar si existe el ususario
		$sql = "SELECT * FROM usuarios WHERE email = '$email';";
		$login = $this->db->query($sql);

		if ($login && $login->num_rows == 1) {
			$usuario = $login->fetch_object();

			// Verificar la contraseña
			$verify = password_verify($password, $usuario->password);

			if ($verify) {
				$result = $usuario;
			}
		}
		return $result;
	}

	// Editar datos de perfil
	public function modify(){
		$result = false;

		$sql = "UPDATE usuarios SET
				user = '{$this->getUser()}',
				nombre = '{$this->getNombre()}',
				apellidos = '{$this->getApellidos()}',
				email = '{$this->getEmail()}',
				telefono = {$this->getTelefono()}
				WHERE id = {$this->getId()};";

		$modify = $this->db->query($sql);

		if($modify){
			$sql = "SELECT * FROM usuarios WHERE id = {$this->getId()};";
			$modified = $this->db->query($sql);

			if ($modified && $modified->num_rows == 1) {
				$usuario = $modified->fetch_object();
				$result = $usuario;
			}
		}
		return $result;
	}

	// Método para listar usuarios
	public function mostrarUsuarios(){
		
		$result = false;
		$sql = "SELECT * FROM usuarios;";
		$usuarios = $this->db->query($sql);

		if($usuarios){
			$result = $usuarios;
		}
		return $result;

	}

	// Método para borrar proyectos
	public function delete(){

		$result = false;
		
		$sql = "DELETE FROM usuarios WHERE id = {$this->getId()};";

		$deleted = $this->db->query($sql);

		if($deleted){
			$result = true;
		}
		return $result;

	}

}