<?php 

class Utils{

	// Método estático para borrar sesiones
	public static function deleteSession($name){
		if (isset($_SESSION[$name])) {
			unset($_SESSION[$name]);
		}
		return $name;
	}

	// Método estático para comprobar la url, para mostrar o no el sidebar y el menú (si es administracion o no)
	public static function checkUrl($host){
		if($host == 'localhost/php/admin/index' || $host == 'localhost/php/admin/citas' || $host == 'localhost/php/proyecto/listar' || $host == 'localhost/php/proyecto/crear'){
			$admin = true;
		} else {
			$admin = false;
		}
		if(isset($_GET['editar'])){
			$proyecto_id = $_GET['editar'];
			if($host == 'localhost/php/admin/editarproyecto&editar='.$proyecto_id){
				$admin = true;
			} else {
				$admin = false;
			}
		}
		if(isset($_GET['editar'])){
			$edicion_id = $_GET['editar'];
			if($host == 'localhost/php/admin/editarproyecto&editar='.$edicion_id || $host == 'localhost/php/admin/editarusuario&editar='.$edicion_id){
				$admin = true;
			} else {
				$admin = false;
			}
		}
		return $admin;
	}

}