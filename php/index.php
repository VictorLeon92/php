<?php 

// Iniciar uso de sesiones
session_start();

// Ficheros cargados de funciones y estructura
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'database/database.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'helpers/highlight_menu.php';
require_once 'views/layout/header.php';

// Mostrar página de error cuando no se encuentra ´la url
function show_error(){
	$error = new errorController();
	$error->index();
}
if (isset($_GET['controller'])) {
	$controller_name = $_GET['controller'].'controller';
}elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
	$controller_name = controller_default;
}else{
	show_error();
	exit();
}

if (class_exists($controller_name)) {
	$controller = new $controller_name();

	if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
		$action = $_GET['action'];
		$controller->$action();
	}elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
		$action_default = action_default;
		$controller->$action_default();
	}else{
		show_error();
	}
}else{
	show_error();
}

// Muestra la barra lateral si la url no pertenece a la administración de la web
$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$admin = Utils::checkUrl($url);
if(!$admin) {
	require_once 'views/layout/sidebar.php';
}

// Carga el footer
require_once 'views/layout/footer.php';
