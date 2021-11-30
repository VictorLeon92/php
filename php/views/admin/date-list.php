<!-- Listado de proyectos -->
<div class="col-12 col-lg-12 col-md-12 col-sm-12">
	<h2>Citas concertadas</h2>
</div>
<?php 
	$lista = new CitaController;
	$lista->listar(); 
?>

