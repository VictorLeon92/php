<!-- Login -->
<div class="row container-fluid margen-vertical">
	<div id="login" class="col-12 col-lg-12 col-md-12 col-sm-12">
		<h3>Identifícate</h3>

		<!-- Alerta de login incorrecto -->
		<?php if(isset($_SESSION['error-login']) && $_SESSION['error-login'] == 'incorrecto' ): ?>
			<div class="error-general">Datos incorrectos.</div>
		<?php elseif(isset($_SESSION['error-login']) && $_SESSION['error-login'] == 'vacio' ): ?>
			<div class="error-general">Debes rellenar ambos campos.</div>
		<?php else : ?>
			<div class="error-general">Introduce los siguientes datos:</div>
		<?php endif; ?>

		<form id="form_sesion" action="<?=base_url?>usuario/login" method="POST">
			<label for="email">Email</label><br>
			<input class="input-acceso" type="email" name="email"><br>

			<label for="password">Contraseña</label><br>
			<input class="input-acceso" type="password" name="password"><br>
			<br>

			<input class="boton-acceso" type="submit" value="Acceder">
		</form>
	</div>
</div>