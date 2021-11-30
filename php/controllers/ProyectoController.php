<?php

// Carga del modelo de proyecto
require_once 'models/proyecto.php';

class ProyectoController {
	// Método para mostrar el listado de proyectos
	public function listar() {
		$mostrar = new Proyecto();
		$proyectos = $mostrar->mostrarProyectos();
		foreach ($proyectos as $proyecto) {
	    echo "<div id='proyecto_".$proyecto["id"]."' class='margen-vertical col-4 col-lg-4 col-md-4 col-sm-4'>
			Imagen: <img width='40%' height='40%' src='".$proyecto["imagen"]."' class='img-thumbnail' align='center' />
			<p>Nombre: ".$proyecto["nombre"]."</p>
			<div>Enlace: ".$proyecto["link"]."</div>
			<p>Tecnología: ".$proyecto["tecnologia"]."</p>
			<p>Descripción: ".$proyecto["descripcion"]."</p>
			<p>
				<form method='POST' action='".base_url."admin/editarproyecto&editar=".$proyecto["id"]."'>
					<input id='proyecto_".$proyecto["id"]."'type='submit' class='boton-acceso editar-p' value='Editar'>
				</form>
			</p>
		</div>";
		}
	}

	// Carga la págiba de creación de proyectos
	public function crear() {
		require_once 'views/admin/create-proyect.php';
	}

	// Añade el proyecto creado a la base de datos
	public function guardarCreado() {

		if (!empty($_POST)) {

			// Recoger valores del formulario de proyecto
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$imagen = isset($_FILES['img']) ? $_FILES['img'] : false;
			$nombre_imagen = isset($imagen['name']) ? $imagen['name'] : false;
			$tipo_imagen = isset($imagen['type']) ? $imagen['type'] : false;
			$tecnologia = isset($_POST['tecnologia']) ? $_POST['tecnologia'] : false;
			$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
			$link = isset($_POST['link']) ? $_POST['link'] : false;
			
			// Array de errores
			$errores = array();

			// Validar nombre
			if (!empty($nombre)){
				$nombre_val = true;
			} else { 
				$nombre_val = false;
				$errores['nombre'] = 'Nombre vacío.';
			}

			// Validar tecnología
			if (!empty($tecnologia)){
				$tecno_val = true;
			} else { 
				$tecno_val = false;
				$errores['tecnologia'] = 'Tecnología vacía.';
			}


			// Comprobar que los campos requeridos sean correctos
			$crear_proyecto = false;
			if (count($errores) == 0) {
				$crear_proyecto = true;

				// Añadir proyecto a la base de datos
				$proyecto = new Proyecto();

				$proyecto->setNombre($nombre);
				$proyecto->setTecnologia($tecnologia);
				
				// Si existe descripción, añadirla
				if (isset($descripcion)){	
					$proyecto->setDescripcion($descripcion);
				}
				// Si existe enlace, añadirlo
				if (isset($link)){
					$proyecto->setLink($link);
				}

				// Si existe imagen, añadirla
				if (isset($img)){
					if ($tipo_imagen == 'image/jpg' || $$tipo_imagen == 'image/jpeg' || $tipo_imagen == 'image/png') {
						if (!is_dir('assets/images')) {
							mkdir('assets/images', 0777);
						}
					}
					move_uploaded_file($img_mod['tmp_name'], 'assets/images/'.$nombre_imagen);
					
					$proyecto->setImagen($nombre_imagen);
				}

				$create = $proyecto->create();
				
				// Validar si se han guardado los cambios
				if ($create) {
					$_SESSION['proyecto']['creado'] = "El proyecto se ha creado correctamente.";
				} else {
					$_SESSION['proyecto']['errores-general'] = "No se ha podido guardar el proyecto.";
				}
			} else {
				// Errores con la verificación de los campos
				$_SESSION['proyecto']['errores'] = $errores;
			}

		}
		header('location: '.base_url.'proyecto/crear');
	}

	// Método para editar los proyectos
	public function editar() {	
		if (isset($_POST)) {

			// Recoger valores del formulario 
			$id = $_SESSION['id_mod'];
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$link = isset($_POST['link']) ? $_POST['link'] : false;
			$tecnologia = isset($_POST['tecnologia']) ? $_POST['tecnologia'] : false;
			$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
			
			// Comprueba si se ha añadido imagen nueva
			if(isset($_FILES['img'])){	
				$img = $_FILES['img'];
				$nombre_imagen = $img['name'];
				$tipo_imagen = $img['type'];
			}

			// Array de errores
			$errores = array();

			// Validar nombre
			if (!empty($nombre)){
				$nombre_val = true;
			} else { 
				$nombre_val = false;
				$errores['nombre'] = 'Nombre vacío.';
			}

			// Validar tecnología
			if (!empty($tecnologia)){
				$tecno_val = true;
			} else { 
				$tecno_val = false;
				$errores['tecnologia'] = 'Tecnología vacía.';
			}


			// Comprobar que todos los datos requeridos sean correctos
			$modificar_proyecto = false;
			if (count($errores) == 0) {
				$modificar_proyecto = true;

				// Modificar datos del proyecto en la base de datos
				$proyecto = new Proyecto();
				$proyecto->setId($id);
				$proyecto->setNombre($nombre);
				$proyecto->setTecnologia($tecnologia);

				// Modificar la descripción si existe
				if (isset($descripcion)){	
					$proyecto->setDescripcion($descripcion);
				}

				// Modificar el enlace si existe
				if (isset($link)){
					$proyecto->setLink($link);
				}

				// Modificar la imagen si existe
				if (isset($img)){
					if ($tipo_imagen == 'image/jpg' || $$tipo_imagen == 'image/jpeg' || $tipo_imagen == 'image/png') {
						if (!is_dir('assets/images')) {
							mkdir('assets/images', 0777);
						}
					}
					move_uploaded_file($img_mod['tmp_name'], 'assets/images/'.$nombre_imagen);
					
					$proyecto->setImagen($nombre_imagen);
				}

				$modify = $proyecto->modify();
				
				// Validar si se han guardado los cambios
				if ($modify) {
					// Proyecto modificado
					$_SESSION['proyecto']['modificado'] = "El proyecto se ha actualizado correctamente.";
				} else {
					// Error al guardar los cambios
					$_SESSION['proyecto']['errores-general'] = "Fallo al guardar el usuario.";
				}
			} else {
				// Errores en los campos
				$_SESSION['proyecto']['errores'] = $errores;
			}

		}
header('location: '.base_url.'admin/editarproyecto&editar='.$id);
	}

	// Método para borrar proyectos
	public function borrar() {	
		$id = $_SESSION['id_mod'];

		$delete = new Proyecto();
		$delete->setId($id);

		$delete->delete();

		if ($delete){
			$_SESSION['proyecto']['borrado'] = "El proyecto se ha eliminado correctamente.";
		} else {
			$_SESSION['proyecto']['error-borrado'] = "Ha ocurrido un error al borrar el proyecto.";
		}
		

	header('location: '.base_url.'admin/index');
	}
}
