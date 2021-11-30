<?php

// Carga de modelo de usuario
require_once 'models/usuario.php';

class UsuarioController {

	// Carga de la página de registro
	public function registro(){
		require_once 'views/users/register.php';
	}

	// Guardar nuevo usuario registrado
	public function save(){
		if (isset($_POST)) {

			// Recibir la información del registro de usuario
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;

			// Array de errores
			$errores_registro = array();

			// Verificar nombre
			if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
				$nombre_validate = true;
			} else {
				$nombre_validate = false;
				$errores_registro['nombre'] = "Error nombre.";
			}

			// Validar apellidos
			if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
				$apellidos_validate = true;
			} else {
				$apellidos_validate = false;
				$errores_registro['apellidos'] = "Error apellidos.";
			}

			// Validar email
			if (!empty($email) && !is_numeric($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_validate = true;
			} else {
				$email_validate = false;
				$errores_registro['email'] = "Error email.";
			}

			// Validar password
			if (!empty($password)) {
				$password_validate = true;
			} else {
				$password_validate = false;
				$errores_registro['password'] = "Error pass.";
			}

			// Comprobar si los datos requeridos son correctos
			$guardar_usuario = false;
			if (count($errores_registro) == 0) {
				$guardar_usuario = true;

				// Guardar nuevo usuario en la base de datos
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setPassword($password);

				$save = $usuario->save();
				if ($save) {
					// Registro completado
					$_SESSION['register']['completado'] = "El registro se ha completado con éxito.";
				}else{
					// Error al guardar los datos
					$_SESSION['register']['error-general'] = "Fallo al guardar el usuario.";
				}
			}else{
				// Errores en los campos
				$_SESSION['register']['errores'] = $errores_registro;
			}
		}else{
			// Error si algún campo está vacío
			$_SESSION['register']['error-general'] = "Todos los campos son obligatorios.";
		}
		header("Location: ".base_url."usuario/registro");
	}

	// Método para acceder a la web con cuenta ya creada
	public function login(){
		if (isset($_POST)) {

			// Identificar al usuario
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;

			// Comprobar si los campos tienen contenido
			if (!empty($email) || !empty($password) )  {

				// Consulta a la base de datps
				$usuario = new Usuario();
				$identity = $usuario->login($email, $password);

				// Crear sesión con los datos del usuario de la base de datos
				if ($identity && is_object($identity)) {
					$_SESSION['identity'] = $identity;

					// Comprobar si el usuario tiene rango de administrador
					if ($identity->rango == 'admin') {
						// Crea una sesión para definir que el usuario es administrador
						$_SESSION['admin'] = true;
					}
				} else {
					// Los datos ingresados no coinciden con un usuario
					$_SESSION['error-login'] = 'incorrecto';
				}

			} else {
				// Algún campo está vacío
				$_SESSION['error-login'] = 'vacio';		
			}
		}
		header('Location:'.base_url);
	}

	// Método para cerrar sesión
	public function logout(){
		// Comprueba si existe una sesión con datos de usuario
		if(isset($_SESSION['identity'])){
			// Vacía la sesión
			$_SESSION['identity'] = null;
		}
		// Comprueba si hay datos en la sesión admin
		if(isset($_SESSION['admin'])){
			// Vacía la sesión
			$_SESSION['admin'] = null;
		}
		header('Location:'.base_url);
	}

	// Carga la página de edición de perfil
	public function perfil(){
		require_once 'views/users/profile.php';
	}
	
	// Método para editar el perfil de usuario
	public function modify(){
		if (isset($_POST)) {

			// Obtener los datos del formulario
			$id = $_SESSION['identity']->id;		
			$user = isset($_POST['user']) ? $_POST['user'] : false;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$telefono = $_POST['telefono'];

			// Array de errores
			$errores_registro = array();

			// Verificar usuario
			if (!empty($user) && !is_numeric($user) && !preg_match("/[0-9]/", $user)) {
				$user_validate = true;
			} else {
				$user_validate = false;
				$errores_registro['user'] = "Error user.";
			}

			// Verificar nombre
			if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
				$nombre_validate = true;
			} else {
				$nombre_validate = false;
				$errores_registro['nombre'] = "Error nombre.";
			}

			// Validar apellidos
			if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
				$apellidos_validate = true;
			} else {
				$apellidos_validate = false;
				$errores_registro['apellidos'] = "Error apellidos.";
			}

			// Validar email
			if (!empty($email) && !is_numeric($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_validate = true;
			} else {
				$email_validate = false;
				$errores_registro['email'] = "Error email.";
			}

			// Validar telefono
			if (is_numeric($telefono) && preg_match("/[0-9]/", $telefono)){
				$telefono_validate = true;
			} else {
				$telefono_validate = false;
				$errores_registro['telefono'] = "Error telefono.";
			}

			// Comprueba que los datos de usuario sean correctos
			$editar_usuario = false;
			if (count($errores_registro) == 0) {
				$editar_usuario = true;

				// Modifica los datos del usuario en la base de datos
				$usuario = new Usuario();
				$usuario->setId($id);
				$usuario->setUser($user);
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setTelefono($telefono);

				$modify = $usuario->modify();
				
				// COmprueba si se ha modificado el usuario correctamente
				if ($modify) {
					// Elimina la sesión de usuario antigua para actualizar los datos en tiempo real
					unset($_SESSION['identity']);
					// Carga los nuevos datos en la sesión
					$_SESSION['identity'] = $modify;
					// Edición de perfil completada
					$_SESSION['modify']['completado'] = "Los datos se han modificado con éxito.";
				}else{
					// Error al guardar los datos nuevos
					$_SESSION['modify']['error-general'] = "Fallo al modificar el usuario.";
				}
			}else{
				// Errores en los campos
				$_SESSION['modify']['errores'] = $errores_registro;
			}
		}else{
			// Campos vacíos 
			$_SESSION['modify']['error-general'] = "No hay datos para modificar los existentes.";
		}
		header("Location: ".base_url."usuario/perfil");
	}

	// Método para mostrar el listado de usuarios
	public function listar() {
		$mostrar = new Usuario();
		$usuarios = $mostrar->mostrarUsuarios();
		foreach ($usuarios as $usuario) {
	    echo "<div id='usuario_".$usuario["id"]."' class='margen-vertical col-4 col-lg-4 col-md-4 col-sm-4'>
			<h3>".$usuario["user"]."</h3>
			<p><strong>Nombre y apellidos:</strong> ".$usuario["nombre"]." ".$usuario["apellidos"]."</p>
			<p><strong>Email:</strong> ".$usuario["email"]."</p>
			<p><strong>Rango:</strong> ".$usuario["rango"]."</p>
			<p>
				<form method='POST' action='".base_url."admin/editarusuario&editar=".$usuario["id"]."'>
					<input id='usuario_".$usuario["id"]."'type='submit' class='boton-acceso editar-p' value='Editar'>
				</form>
			</p>
		</div>";
		}
	}

	// Método para editar el perfil de usuarios desde la administración
	public function editarAdmin(){
		if (isset($_POST)) {

			// Obtener los datos del formulario
			$id = $_SESSION['id_user'];		
			$user = isset($_POST['user']) ? $_POST['user'] : false;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$telefono = $_POST['telefono'];

			// Array de errores
			$errores_registro = array();

			// Verificar usuario
			if (!empty($user) && !is_numeric($user) && !preg_match("/[0-9]/", $user)) {
				$user_validate = true;
			} else {
				$user_validate = false;
				$errores_registro['user'] = "Error user.";
			}

			// Verificar nombre
			if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
				$nombre_validate = true;
			} else {
				$nombre_validate = false;
				$errores_registro['nombre'] = "Error nombre.";
			}

			// Validar apellidos
			if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
				$apellidos_validate = true;
			} else {
				$apellidos_validate = false;
				$errores_registro['apellidos'] = "Error apellidos.";
			}

			// Validar email
			if (!empty($email) && !is_numeric($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_validate = true;
			} else {
				$email_validate = false;
				$errores_registro['email'] = "Error email.";
			}

			// Validar telefono
			if (is_numeric($telefono) && preg_match("/[0-9]/", $telefono)){
				$telefono_validate = true;
			} else {
				$telefono_validate = false;
				$errores_registro['telefono'] = "Error telefono.";
			}

			// Comprueba que los datos de usuario sean correctos
			$editar_usuario = false;
			if (count($errores_registro) == 0) {
				$editar_usuario = true;

				// Modifica los datos del usuario en la base de datos
				$usuario = new Usuario();
				$usuario->setId($id);
				$usuario->setUser($user);
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setTelefono($telefono);

				$modify = $usuario->modify();
				
				// COmprueba si se ha modificado el usuario correctamente
				if ($modify) {
					// Elimina la sesión de usuario antigua para actualizar los datos en tiempo real
					unset($_SESSION['identity']);
					// Carga los nuevos datos en la sesión
					$_SESSION['identity'] = $modify;
					// Edición de perfil completada
					$_SESSION['modify']['completado'] = "Los datos se han modificado con éxito.";
				}else{
					// Error al guardar los datos nuevos
					$_SESSION['modify']['error-general'] = "Fallo al modificar el usuario.";
				}
			}else{
				// Errores en los campos
				$_SESSION['modify']['errores'] = $errores_registro;
			}
		}else{
			// Campos vacíos 
			$_SESSION['modify']['error-general'] = "No hay datos para modificar los existentes.";
		}
		header("Location: ".base_url."admin/index");
	}

	// Método para borrar usuarios
	public function borrar() {	
		$id = $_SESSION['id_user'];

		$delete = new Usuario();
		$delete->setId($id);

		$delete->delete();

		if ($delete){
			$_SESSION['usuario']['borrado'] = "El usuario se ha eliminado correctamente.";
		} else {
			$_SESSION['usuario']['error-borrado'] = "Ha ocurrido un error al borrar el usuario.";
		}
		

	header('location: '.base_url.'admin/index');
	}

	public function citas(){
		require_once 'views/users/dates.php';
	}

}