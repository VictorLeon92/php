<!-- Modificar perfil -->
<div class="row container-fluid">
	<section id="cuerpo-profile" class="margen-vertical col-12 col-lg-9 col-md-12 col-sm-12">
		<div class="row container-fluid margen-vertical">
			<div class="col-12 col-lg-12 col-md-12 col-sm-12 text-center">
				<?php if(isset($_SESSION['identity'])): ?>
				<h3>Modificar mis datos</h3>
				<form id="form_perfil" action="<?=base_url?>usuario/modify" method="POST">
					<label for="user">Nombre de usuario</label><br>
					<input class="input-acceso" type="text" name="user" value="<?= $_SESSION['identity']->user?>"><br>

					<label for="nombre">Nombre</label><br>
					<input class="input-acceso" type="text" name="nombre" value="<?= $_SESSION['identity']->nombre ?>"><br>
					
					<label for="apellidos">Apellido</label><br>
					<input class="input-acceso" type="text" name="apellidos" value="<?= $_SESSION['identity']->apellidos ?>"><br>

					<label for="email">Email</label><br>
					<input class="input-acceso" type="email" name="email" value="<?= $_SESSION['identity']->email ?>"><br>

					<label for="telefono">Teléfono</label><br>
					<input class="input-acceso" type="number" name="telefono" value="<?= $_SESSION['identity']->telefono ?>"><br>
					<br>
					<?php if (isset($_SESSION['modify']['completado'])) : ?>
					<div id="error_perfil" class="error-general"><?=$_SESSION['modify']['completado']?></div>
					<?php elseif (isset($_SESSION['modify']['error-general'])) : ?>
					<div id="error_perfil" class="error-general"><?=$_SESSION['modify']['error-general']?></div>
					<?php else : ?>
					<div id="error_perfil" class="error-general">Para poder modificar los datos, introduce la nueva información en el campo correspondiente.</div>
					<?php endif; ?>
					<?php Utils::deleteSession('modify'); ?>
					<br>			
					<input class="boton-acceso" type="submit" name="enviar_perfil" value="Modificar datos">
				</form>
				<?php else : ?>
				<?php 
					header('Location;'.base_url);
				?>
				<?php endif; ?>
			</div>
		</div>
	</section>

