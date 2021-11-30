<?php
// Función para autocargar los modelos o clases
function controllers_autoload($classname){
	include 'controllers/' . $classname . '.php';
}

spl_autoload_register('controllers_autoload');