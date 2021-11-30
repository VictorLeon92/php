<!-- Sidebar -->
	<aside id="lateral" class="margen-vertical col-12 col-lg-3 col-md-12 col-sm-12">
		<!-- Bloque de usuario registrado -->
		<?php if(isset($_SESSION['identity'])): ?>
			<div id="usuario-logueado" class="block-aside">
				<h3>Hola, <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?></h3>
				 <!--Botones de acción -->
				<?php if(isset($_SESSION['admin'])): ?>
					<button id="btn-admin" class="boton-acceso">Administración</button>
				<?php else: ?>
					<button id="btn-citas" class="boton-acceso">Mis citas</button>
				<?php endif; ?>
				<button id="btn-perfil" class="boton-acceso">Mis datos</button>
				<button id="btn-cerrar" class="boton-acceso">Cerrar sesión</button>
				<br><br>
			</div>
		<?php else : ?>
			<div class="row container-fluid margen-vertical">
				<button id="btn-register" class="boton-acceso">Crear cuenta</button>
				<?php require_once 'views/users/login.php' ?>
			</div>
		<?php endif; ?>
		<div id="rss">
			Cargando Rss...
		</div>
	</aside>
	<script type="text/javascript" src="<?=base_url?>assets/js/rss-load.js"></script>
</div>