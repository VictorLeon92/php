<!-- Listado de citas de usuario -->
<div class="row container-fluid">
	<section id="cuerpo" class="margen-vertical col-12 col-lg-9 col-md-12 col-sm-12 text-center">
		<?php if (isset($_SESSION['cita']['limite'])) : ?>
			<div id="error_citas" class="error-general"><?= $_SESSION['cita']['limite']; ?></div>
		<?php elseif (isset($_SESSION['cita']['modificado'])) : ?>
			<div id="error_citas" class="error-general"><?= $_SESSION['cita']['modificado']; ?></div>
		<?php elseif (isset($_SESSION['cita']['error-general'])) : ?>		
			<div id="error_citas" class="error-insercion"><?= $_SESSION['cita']['error-insercion']; ?></div>
		<?php elseif (isset($_SESSION['cita']['borrado'])) : ?>		
			<div id="error_citas" class="error-insercion"><?= $_SESSION['cita']['borrado']; ?></div>
		<?php elseif (isset($_SESSION['cita']['error-borrado'])) : ?>		
			<div id="error_citas" class="error-insercion"><?= $_SESSION['cita']['error-borrado']; ?></div>
		<?php else : ?>
			<div id="error_citas" class="error-general" style="display: none;"></div>
		<?php endif; ?>
		<?php Utils::deleteSession('cita'); ?>
		<div class="row container-fluid margen-vertical">
			<div class="col-12 col-lg-12 col-md-12 col-sm-12 text-center">
				<h2>Mis citas</h2>
			</div>
			<?php 
				$lista = new CitaController;
				$lista->misCitas(); 
			?>
		</div>
</section>
