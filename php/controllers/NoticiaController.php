<?php

// Carga del modelo de noticias
require_once 'models/noticia.php';

class NoticiaController {
	// Método para mostrar el listado de noticias
	public function listar() {
		$mostrar = new Noticia();
		$noticias = $mostrar->mostrarNoticias();
		foreach ($noticias as $noticia) {
			echo "<div id='noticia_".$noticia["id"]."' class='margen-vertical col-4 col-lg-4 col-md-4 col-sm-4'>
				<img width='40%' height='40%' src='".$noticia["imagen"]."' class='img-thumbnail' align='center' />
				<p>".$noticia["nombre"]."</p>
				<p>".$noticia["short"]."</p>
				<p>
					<form method='POST' action='".base_url."noticia/vernoticia&ver=".$noticia["id"]."'>
						<input id='noticia_".$noticia["id"]."'type='submit' class='boton-acceso editar-p' value='Noticia completa'>
					</form>
				</p>
			</div>";
		}
	}

	public function verNoticia(){
		include 'views/news/news-single.php';

	}

}
