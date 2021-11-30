<!-- Edición de proyecto -->
<div class="row container-fluid">
	<section id="edit_proyect_form" class="margen-vertical col-12 col-lg-12 col-md-12 col-sm-12">
	<?php if(isset($_SESSION['identity'])  && $_SESSION['identity']->rango == 'admin'): ?>
		<div class="row container-fluid margen-vertical text-center">
			<div class="col-12 col-lg-12 col-md-12 col-sm-12">
			<?php if (isset($_SESSION['proyecto']['modificado'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['proyecto']['modificado']; ?></div>
			<?php elseif (isset($_SESSION['proyecto']['errores'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['proyecto']['errores']; ?></div>
			<?php elseif (isset($_SESSION['proyecto']['errores-general'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['proyecto']['errores-general']; ?></div>
			<?php else : ?>
				<div id="error_registro" class="error-general">	Por favor, rellena los campos con asterisco (obligatorios) poder registrarte.</div>
			<?php endif; ?>
			<?php Utils::deleteSession('proyecto'); ?>
			<button class="boton-acceso volver-admin">Volver a admin</button><br>
			<h2>Modificar Proyectos</h2>
			<?php 
				$db = Database::connect();
				$proyecto_id = $_GET['editar'];
				$_SESSION['id_mod'] = $proyecto_id;
				$query = mysqli_query($db, "SELECT * FROM proyectos WHERE id = $proyecto_id");    
				while ($proyecto = mysqli_fetch_assoc($query)) {
					echo "<form id='form_editar_proyecto' action='".base_url."proyecto/editar' method='POST' enctype='multipart/form-data'>
						<label for='nombre'>Nombre del proyecto</label>
						<input class='input-acceso' type='text' name='nombre' value='".$proyecto["nombre"]."'><br>

						<label for='link'>Enlace web</label>
						<input class='input-acceso' type='text' name='link'  value='".$proyecto["link"]."'><br>

						<label for='tecnologia'>Tecnologías usadas</label>
						<input class='input-acceso' type='text' name='tecnologia' value='".$proyecto["tecnologia"]."'><br>

						<label for='descripcion'>Descripción</label><br>
						<textarea class='cuadro-texto' name='descripcion' cols='60' rows='4' >".$proyecto["descripcion"]."</textarea><br>

						<label for='imagen'>Imagen del proyecto</label>
						<input type='file' class='input-acceso' name='imagen'  value='".$proyecto["imagen"]."'><br>
						<br>	
						<div id='error_mod_proyecto' class='error-general'></div>
						<br>			
						<input id='send_mod_proyecto' class='boton-acceso' type='submit' name='send-mod' value='Modificar proyecto'>
					</form>";
				}
			?>
			<button class="boton-acceso borrar-proyecto">Borrar Proyecto</button><br>
			</div>
			<script type="text/javascript" src="<?=base_url?>assets/js/admin.js"></script>
		</div>
	<?php else : ?>
	<?php 
		header('Location:'.base_url);
	?>
	<?php endif; ?>
	</section>
</div>