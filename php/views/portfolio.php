<!-- Sección de portfolio -->
<div class="row container-fluid">
	<section id="cuerpo-portfolio" class="margen-vertical col-12 col-lg-9 col-md-12 col-sm-12">
		<?php 
		$db = Database::connect();
		$query = mysqli_query($db, "SELECT * FROM proyectos ORDER BY id DESC LIMIT 12");    
		?>
		<div class="row container-fluid margen-vertical text-center">
			<div class="col-12 col-lg-12 col-md-12 col-sm-12">
				<h2>Proyectos realizados</h2><hr>
			</div>
			<?php 
			while ($proyectos = mysqli_fetch_assoc($query)) {
			    echo "<div class='margen-vertical col-4 col-lg-4 col-md-4 col-sm-4'>
					<a href='".$proyectos["link"]."' target='_blank'>
						<img src='".$proyectos["imagen"]."' class='img-thumbnail' align='center' />
					</a>
					<p class='proyecto'>".$proyectos["nombre"]."</p>
					<p><strong>".$proyectos["tecnologia"]."</strong></p>
					<p>".$proyectos["descripcion"]."</p>
				</div>";
			}
			?>
			</div>
	</section>
