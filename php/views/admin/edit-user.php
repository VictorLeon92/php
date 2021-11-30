<!-- Edición de usuario -->
<div class="row container-fluid">
	<section id="edit_user_form" class="margen-vertical col-12 col-lg-12 col-md-12 col-sm-12">
	<?php if(isset($_SESSION['identity'])  && $_SESSION['identity']->rango == 'admin'): ?>
		<div class="row container-fluid margen-vertical text-center">
			<div class="col-12 col-lg-12 col-md-12 col-sm-12">
			<?php if (isset($_SESSION['modify']['completado'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['modify']['completado']; ?></div>
			<?php elseif (isset($_SESSION['modify']['errores'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['modify']['errores']; ?></div>
			<?php elseif (isset($_SESSION['modify']['errores-general'])) : ?>
				<div id="error_registro" class="error-general"><?= $_SESSION['modify']['errores-general']; ?></div>
			<?php else : ?>
				<div id="error_registro" class="error-general">	Por favor, rellena los campos con asterisco (obligatorios) poder registrarte.</div>
			<?php endif; ?>
			<?php Utils::deleteSession('modify'); ?>
			<button class="boton-acceso volver-admin">Volver a admin</button><br>
			<h2>Modificar Usuario</h2>
			<?php 
				$db = Database::connect();
				$user_id = $_GET['editar'];
				$_SESSION['id_user'] = $user_id;
				$query = mysqli_query($db, "SELECT * FROM usuarios WHERE id = $user_id");    
				while ($usuario = mysqli_fetch_assoc($query)) {
					echo "<form id='form_edit_user' action='".base_url."usuario/editaradmin' method='POST' enctype='multipart/form-data'>
						<label for='user'>Nombre de usuario</label><br>
						<input class='input-acceso' type='text' name='user' value='".$usuario['user']."'><br>

						<label for='nombre'>Nombre</label><br>
						<input class='input-acceso' type='text' name='nombre' value='".$usuario['nombre']."'><br>
						
						<label for='apellidos'>Apellido</label><br>
						<input class='input-acceso' type='text' name='apellidos' value='".$usuario['apellidos']."'><br>

						<label for='email'>Email</label><br>
						<input class='input-acceso' type='email' name='email' value='".$usuario['email']."'><br>

						<label for='telefono'>Teléfono</label><br>
						<input class='input-acceso' type='number' name='telefono' value='".$usuario['telefono']."'><br>
						<br>	
						<div id='error_mod_usuario' class='error-general'></div>
						<br>			
						<input id='send_mod_usuario' class='boton-acceso' type='submit' name='send-mod' value='Modificar usuario'>
					</form>";
				}
			?>
			<button class="boton-acceso borrar-usuario">Borrar usuario</button><br>
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
