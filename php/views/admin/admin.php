<!-- Administración -->
<div class="row container-fluid">
	<section id="cuerpo_admin" class="margen-vertical col-12 col-lg-12 col-md-12 col-sm-12">
		<?php if(isset($_SESSION['admin']) && $_SESSION['identity']->rango == 'admin'): ?>
			<div class="row container-fluid margen-vertical text-center">
				<button id="btn_crear_proyecto" class="boton-acceso">Crear proyecto</button>
				<button id="btn_editar_proyecto" class="boton-acceso">Modificar proyectos</button>
				<button id="btn_admin_usuario" class="boton-acceso">Administrar usuarios</button>
				<button id="btn_admin_cita" class="boton-acceso">Citas concertadas</button>
				<button id="btn_admin_volver" class="boton-acceso">Volver a la web</button>
				<br>
				<hr>
				<?php if (isset($_SESSION['cita']['borrado'])) : ?>
					<div id="error_citas" class="error-general"><?= $_SESSION['cita']['borrado']; ?></div>
				<?php elseif (isset($_SESSION['cita']['error-borrado'])) : ?>
					<div id="error_citas" class="error-general"><?= $_SESSION['cita']['error-borrado']; ?></div>
				<?php elseif (isset($_SESSION['proyecto']['borrado'])) : ?>
					<div id="error_citas" class="error-general"><?= $_SESSION['proyecto']['borrado']; ?></div>
				<?php elseif (isset($_SESSION['proyecto']['error-borrado'])) : ?>		
					<div id="error_citas" class="error-insercion"><?= $_SESSION['proyecto']['error-borrado']; ?></div>
				<?php elseif (isset($_SESSION['usuario']['borrado'])) : ?>
					<div id="error_citas" class="error-general"><?= $_SESSION['usuario']['borrado']; ?></div>
				<?php elseif (isset($_SESSION['usuario']['error-borrado'])) : ?>		
					<div id="error_citas" class="error-insercion"><?= $_SESSION['usuario']['error-borrado']; ?></div>
				<?php else : ?>
					<div id="error_citas" class="error-general" style="display: none;"></div>
				<?php endif; ?>
				<?php Utils::deleteSession('cita'); ?>
				<?php Utils::deleteSession('proyecto'); ?>
				<?php Utils::deleteSession('usuario'); ?>
			</div>
			<div style="min-height: 500px;">
				<div id="cont_editar_proyecto" class="row container-fluid text-center" style="display: none;">
					<?php 
						AdminController::listarProyecto();
					?>
				</div>
				<div id="cont_admin_usuario" class="row container-fluid text-center" style="display: none;">
					<?php 
						AdminController::listarUsuario();
					?>	
				</div>
				<div id="cont_admin_cita" class="row container-fluid text-center" style="display: none;">
					<?php 
						AdminController::listarCita();
					?>	
				</div>
			</div>
			<script type="text/javascript" src="<?=base_url?>assets/js/admin.js"></script>
		</div>
		<?php else : ?>
			<?php 
				header('Location:'.base_url);
			?>
		<?php endif; ?>
	</section>