<!-- Registro y contacto -->
<div class="row container-fluid">
	<section id="cuerpo-contacto" class="margen-vertical col-12 col-lg-9 col-md-12 col-sm-12">
		<div class="row container-fluid margen-vertical">
			<div class="col-12 col-lg-12 col-md-12 col-sm-12 text-center">
			<?php if(isset($_SESSION['identity'])): ?>
				<h2>Contactanos</h2><hr>
			<?php else: ?>
				<h2>Registrarse</h2><hr>
			<?php endif; ?>
			</div>
			<div class="col-6 col-lg-6 col-md-12 col-sm-12">

			<?php if(isset($_SESSION['identity'])): ?>
				<form id="form_contacto" method="POST" action="<?=base_url?>cita/reserva" enctype="multipart/form-data">
				<p>
					<h3>Datos de contacto</h3><hr>
					
					<label for="nombre">Nombre *: </label><br>
						<input type="text" id="nombre_contacto" name="nombre" value="<?= $_SESSION['identity']->nombre ?>"><br>
					
					<label for="apellidos">Apellidos: </label><br>
						<input type="text" id="apellidos_contacto" name="apellidos" value="<?= $_SESSION['identity']->apellidos ?>"><br>
					
					<label for="telefono">Teléfono *: </label><br>
						<input type="number" id="telefono_contacto" name="telefono" value="<?= $_SESSION['identity']->telefono ?>"><br>
					
					<label for="email">Correo electrónico *: </label><br>
						<input type="email" id="correo_contacto" name="email" value="<?= $_SESSION['identity']->email ?>"><br>

					<label for="fecha">Fecha para la reunión *: </label><br>
						<input type="date" id="fecha_contacto"name="fecha"><br>

					<label for="motivo">Motivo del contacto *: </label><br>
						<textarea id="motivo_contacto"name="motivo" cols="60" rows="4"></textarea><br>

					<br>
					<div id="error_contacto">Por favor, rellena los campos con asterisco (obligatorios) para que puedas contactar con nosotros.</div>
					<input type="submit" id="enviar_contacto" value="Enviar">
				</p>
				</form>
			<?php else : ?>
				<div id="register" class="col-12 col-lg-12 col-md-12 col-sm-12">
				<!-- REGISTRO -->
					<h3>Regístrate</h3>
					<!-- Mostrar errores -->
					<form id="form_registro" action="<?=base_url?>usuario/save" method="POST">
						<label for="nombre">Nombre *</label><br>
						<input id="nombre_registro" class="input-acceso" type="text" name="nombre"><br>

						<label for="apellidos">Apellidos *</label><br>
						<input id="apellidos_registro" class="input-acceso" type="text" name="apellidos"><br>

						<label for="email">Email *</label><br>
						<input id="email_registro" class="input-acceso" type="email" name="email"><br>
						
						<label for="password">Contraseña *</label><br>
						<input id="password_registro" class="input-acceso" type="password" name="password"><br>
						<br>
						<?php if (isset($_SESSION['register']['completado'])) : ?>
							<div id="error_registro" class="error-general"><?= $_SESSION['register']['completado']; ?></div>
						<?php elseif (isset($_SESSION['register']['errores'])) : ?>
							<div id="error_registro" class="error-general"><!--<?= $_SESSION['register']['errores']; ?>--></div>
						<?php elseif (isset($_SESSION['register']['error-general'])) : ?>		
							<div id="error_registro" class="error-general"><?= $_SESSION['register']['error-general']; ?></div>
						<?php else : ?>
							<div id="error_registro" class="error-general">	Por favor, rellena los campos con asterisco (obligatorios) poder registrarte.</div>
						<?php endif; ?>
						<?php Utils::deleteSession('register'); ?>

						<input id="send_registro" class="boton-acceso" type="submit" name="register" value="Registrarse" style="display: none;">
					</form>
					<script type="text/javascript" src="<?=base_url?>assets/js/registro.js"></script>
				</div>
			<?php endif; ?>
			</div>
			<div class="col-6 col-lg-6 col-md-12 col-sm-12 text-center">
				<p>
					<h3>Información de contacto</h3><hr>
					<div class="datos-contacto">Víctor León</div>
					<div class="datos-contacto">Gran Vía 1 - 28001 Madrid</div>
					<div class="datos-contacto">91 123 45 67</div>
					<div class="datos-contacto">info@victorleon.com</div>
				</p>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="<?=base_url?>assets/js/contacto.js"></script>