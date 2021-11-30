<!-- Header -->
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Web">
		<script src="https://kit.fontawesome.com/ce44b34fe0.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?=base_url?>assets/js/jquery.js"></script>
		<script type="text/javascript" src="<?=base_url?>assets/js/ajax.js"></script>
		<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/styles.css">
		<title>Víctor León</title>
	</head>
	<body>
		<header>
			<h1>Víctor León</h1>
		</header>
		<?php 
			$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			$admin = Utils::checkUrl($url);
			if(!$admin) : ?>
		<nav id="menu" class="sticky-top">
			<i id="menu-responsive" class="fas fa-bars fa-2x fa-solid"></i>
			<ul id="lista_menu">
				<li id="index" class="<?php if ($primera_parte=="") {echo "menu-activo"; } else  {echo "menu-inactivo";}?>">Inicio</li>
				<li id="portfolio" class="<?php if ($primera_parte=="portfolio") {echo "menu-activo"; } else  {echo "menu-inactivo";}?>">Proyectos</li>
				<li id="presupuesto" class="<?php if ($primera_parte=="presupuesto") {echo "menu-activo"; } else  {echo "menu-inactivo";}?>">Solicita presupuesto</li>
				<li id="contacto" class="<?php if ($primera_parte=="contacto") {echo "menu-activo"; } else  {echo "menu-inactivo";}?>">Contacto</li>
			</ul>
		</nav>
		<?php endif; ?>