<?php

// Resalta el menú actual 
	$directoryURI = $_SERVER['REQUEST_URI'];
	$ruta = parse_url($directoryURI, PHP_URL_PATH);
	$componentes = explode('/', $ruta);

	if (count($componentes) == 3) {
		$primera_parte = $componentes[2];
	} elseif (count($componentes) == 4) {
		$primera_parte = $componentes[3];
	}