<?php
	
// Carga los modelos o clases que se van a usar en el controlador
require_once 'models/cliente.php';
require_once 'models/cita.php';

// Controlador de citas
class CitaController {
	public function reserva(){
		if (!empty($_POST)) {

			// Recoger valores del formulario de citas
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? trim($_POST['email']) : false;
			$phone = isset($_POST['telefono']) ? $_POST['telefono'] : false;
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
			$motivo = isset($_POST['motivo']) ? $_POST['motivo'] : false;
			
			// Array de errores
			$errores_cita = array();

		
		// Validar datos antes de guardarlos en la base de datos
			// Validar nombre
			if (!empty($nombre) && !is_numeric($nombre)) {
				$nombre_cita_val = true;
			} else {
				$nombre_cita_val = false;
				$errores_cita['nombre'] = "Error nombre.";
			}

			// Validar email
			if (!empty($email) && !is_numeric($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_cita_val = true;
			} else {
				$email_cita_val = false;
				$errores_cita['email'] = "Error email.";
			}

			// Validar fecha
			if (!empty($fecha)) {
				$fecha_cita_val = true;
			} else {
				$fecha_cita_val = false;
				$errores_cita['fecha'] = "Error fecha.";
			}

			// Validar motivo
			if (!empty($motivo) && !is_numeric($motivo)) {
				$motivo_cita_val = true;
			} else {
				$motivo_cita_val = false;
				$errores_cita['motivo'] = "Error motivo.";
			}

			// Comprobar si todos los campos son correctos
			$guardar_cita = false;
			if (count($errores_cita) == 0) {
				$guardar_cita = true;

				// Añadir los datos del cliente a la base de datos
				$cliente = new Cliente();
				$cliente->setNombre($nombre);
				$cliente->setApellidos($apellidos);
				$cliente->setEmail($email);
				$cliente->setPhone($phone);

				$resultado = $cliente->crear();
				
				$cliente_id = $resultado->id;

				// Añadir los datos de la cita a la base de datos
				$reserva = new Cita();
				$reserva->setClienteId($cliente_id);
				$reserva->setFecha($fecha);
				$reserva->setMotivo($motivo);

				$guardar = $reserva->reserva();

				// Comprobar que las operaciones en la base de datos sean correctas
				if ($guardar) {
					// Cita concertada
					$_SESSION['cita']['completado'] = "La cita se ha concertado con éxito.";
				}
				else {
					// Cita no creada
					$_SESSION['cita']['errores-general'] = "No ha sido posible concertar la cita.";
				}
				
			} else {
				// Errores en los campos
				$_SESSION['cita']['errores'] = $errores;
			}
		}
		// Redirigir a inicio
		header('location: '.base_url.'main/contacto');
	}


	// Método para mostrar el listado de citas
	public function listar() {
		$mostrar = new Cita();
		$citas = $mostrar->mostrarCitas();
		foreach ($citas as $cita) {
	    echo "<div id='cita_".$cita["cita_id"]."' class='margen-vertical col-4 col-lg-4 col-md-4 col-sm-4'>
			<p>Nombre y apellidos: ".$cita["nombre"]." ".$cita["apellidos"]."</p>
			<p>Email: ".$cita["email"]."</p>
			<p>Teléfono: ".$cita["phone"]."</p>
			<p>Fecha: ".$cita["fecha"]."</p>
			<p>Motivo: ".$cita["motivo"]."</p>
			<p>
				<form method='POST' action='".base_url."cita/borrarAdmin&cita=".$cita["cita_id"]."'>
					<input type='submit' class='boton-acceso editar-p' value='Cancelar cita'>
				</form>
			</p>
		</div>";
		}
	}

	// Método para mostrar el listado de citas
	public function misCitas() {
		$mostrar = new Cita();
		$citas = $mostrar->misCitas();
		foreach ($citas as $cita) {
	    echo "<div id='cita_".$cita["cita_id"]."' class='margen-vertical col-4 col-lg-4 col-md-4 col-sm-4'>
			<p>Nombre y apellidos: ".$cita["nombre"]." ".$cita["apellidos"]."</p>
			<p>Email: ".$cita["email"]."</p>
			<p>Teléfono: ".$cita["phone"]."</p>
			<p>Fecha: ".date('d-m-Y',strtotime($cita["fecha"]))."</p>
			<p>Motivo: ".$cita["motivo"]."</p>
			
			<p>
				<form method='POST' action='".base_url."cita/cambiarFecha&cita=".$cita["cita_id"]."'>
					<input type='date' name='fecha' value='".$cita["fecha"]."'>
					<input type='submit' class='boton-acceso editar-p' value='Cambiar fecha'>
				</form>
			</p>
			<p>
				<form method='POST' action='".base_url."cita/borrar&cita=".$cita["cita_id"]."&actual=".$cita["fecha"]."'>
					<input type='submit' class='boton-acceso editar-p' value='Cancelar cita'>
				</form>
			</p>
		</div>";
		}
	}

	// Método para borrar citas
	public function borrar() {	
		$id = $_GET['cita']; 

		$delete = new Cita();
		$delete->setId($id);

		$delete->delete();

		if ($delete) {
			$_SESSION['cita']['borrado'] = "La cita se ha cancelado correctamente.";
		} else {
			$_SESSION['cita']['error-borrado'] = "Ha ocurrido un error al cancelar la cita.";
		}

	header('location: '.base_url.'usuario/citas');
	}

	// Método para borrar citas
	public function cambiarFecha() {
			
		$id = $_GET['cita']; 
		$fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : false;

		$check_cita = new Cita();
		$check_cita->setId($id);
		$checked = $check_cita->checkCita();
		$actual = $checked->fecha;
	
		$hoy = date("d-m-Y");
		$cita = date('d-m-Y', strtotime($actual));	
		$undia = date('d-m-Y', strtotime($actual . '-1 day')); 
		$dosdias = date('d-m-Y', strtotime($actual . '-2 day'));
		$tresdias = date('d-m-Y', strtotime($actual . '-3 day'));

		if ($hoy == $cita || $hpy == $undia || $hoy == $dosdias || $hoy == $tresdias) {
			$_SESSION['cita']['limite'] = 'No se puede modificar la fecha con menos de 72 horas de antelación.';
		} else {
			$cambiar = new Cita();
			$cambiar->setId($id);
			$cambiar->setFecha($fecha);

			$cambiar->changeDate();

			// Comprobar que las operaciones en la base de datos sean correctas
			if ($cambiar) {
				// Cita concertada
				$_SESSION['cita']['modificado'] = "La fecha se ha modificado correctamente.";
			}
			else {
				// Cita no creada
				$_SESSION['cita']['error-insercion'] = "No ha sido posible cambiar la fecha.";
			}
				
		}

	header('location: '.base_url.'usuario/citas');
	}

	// Método para borrar citas
	public function borrarAdmin() {	
		$id = $_GET['cita']; 

		$delete = new Cita();
		$delete->setId($id);

		$delete->delete();

		if ($delete) {
			$_SESSION['cita']['borrado'] = "La cita se ha cancelado correctamente.";
		} else {
			$_SESSION['cita']['error-borrado'] = "Ha ocurrido un error al cancelar la cita.";
		}
		

	header('location: '.base_url.'admin/index');
	}
}