<!-- Creación de proyecto -->
<div class="row container-fluid text-center">
	<section id="cuerpo_admin" class="margen-vertical col-12 col-lg-12 col-md-12 col-sm-12">
	<?php if(isset($_SESSION['identity']) && $_SESSION['identity']->rango == 'admin'): ?>
		<div class="row container-fluid margen-vertical text-center">
			<div class="margen-vertical col-12 col-lg-12 col-md-12 col-sm-12">
			<?php if (isset($_SESSION['proyecto']['creado'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['proyecto']['creado']; ?></div>
			<?php elseif (isset($_SESSION['proyecto']['errores'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['proyecto']['errores']; ?></div>
			<?php elseif (isset($_SESSION['proyecto']['errores-general'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['proyecto']['errores-general']; ?></div>
			<?php else : ?>
				<div id="error_registro" class="error-general">	Por favor, rellena los campos con asterisco (obligatorios) poder registrarte.</div>
			<?php endif; ?>
			<?php Utils::deleteSession('proyecto'); ?>
			<br>
			<button class="boton-acceso volver-admin">Volver atrás</button>
			<button id="btn_admin_volver" class="boton-acceso">Volver a la web</button>
			<br>
			<hr>
			<h2>Crear Proyecto</h2><hr>
				<form id="form_crear_proyecto" action="<?=base_url?>proyecto/guardarcreado" method="POST" enctype="multipart/form-data">
					<label for="nombre">Nombre del proyecto</label>
					<input class="input-acceso" type="text" name="nombre"><br>

					<label for="link">Enlace web</label>
					<input class="input-acceso" type="text" name="link"><br>

					<label for="tecnologia">Tecnologías usadas</label>
					<input class="input-acceso" type="text" name="tecnologia"><br>

					<label for="descripcion">Descripción</label><br>
					<textarea class="cuadro-texto" name="descripcion" cols="60" rows="4"></textarea><br>

					<label for="imagen">Imagen del proyecto</label>
					<input type="file" class="input-acceso" name="imagen"><br>
					<br>	
					<div id="error_crear_proyecto" class="error-general"></div>
					<br>			
					<input id="send_crear_proyecto" class="boton-acceso" type="submit" name="send-crear" value="Añadir proyecto">
				</form>
				<script type="text/javascript" src="<?=base_url?>assets/js/admin.js"></script>	
			</div>
		</div>
		<hr>
	<?php else : ?>
	<?php 
		header('Location:'.base_url);
	?>
	<?php endif; ?>
	</section>
</div>