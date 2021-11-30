<?php

// Clase AdminController
class AdminController {

	// Carga de la página de inicio de la administración
	public function index(){
		require_once 'views/admin/admin.php';
	}

	// Carga de la página de listado de proyectos
	public function listarProyecto(){
		require_once 'views/admin/proyect-list.php';
	}

	// Carga de la página de edición de proyecto
	public function editarProyecto(){
		require_once 'views/admin/edit-proyect.php';
	}

	// Carga de la página de listado de usuarios
	public function listarUsuario(){
		require_once 'views/admin/user-list.php';
	}

	// Carga de la página de edición de usuario
	public function editarUsuario(){
		require_once 'views/admin/edit-user.php';
	}

	// Carga de la página de listado de citas
	public function listarCita(){
		require_once 'views/admin/date-list.php';
	}

}
