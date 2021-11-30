<!-- Listado de usuarios -->
<div class="col-12 col-lg-12 col-md-12 col-sm-12">
	<h2>Modificar Usuarios</h2>
</div>
<?php 
	$lista = new UsuarioController;
	$lista->listar(); 
?>

