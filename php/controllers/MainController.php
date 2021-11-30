<?php

// Clase MainController
class MainController {

	// Carga la página de inicio
	public function index(){
		require_once 'views/index.php';
	}

	// Carga la sección portfolio
	public function portfolio(){
		require_once 'views/portfolio.php';
	}
	
	// Carga la sección presupuesto
	public function presupuesto(){
		require_once 'views/presupuesto.php';
	}

	// Carga la sección contacto
	public function contacto(){
		require_once 'views/contacto.php';
	}
}
