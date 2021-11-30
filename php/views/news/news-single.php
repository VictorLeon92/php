<!-- Noticia individual -->
<div class="row container-fluid">
	<section id="news-single" class="margen-vertical col-12 col-lg-9 col-md-12 col-sm-12">
		<div class="row container-fluid margen-vertical text-center">
			<div class="col-12 col-lg-12 col-md-12 col-sm-12">
			<?php 
				$db = Database::connect();
				$noticia_id = $_GET['ver'];
				$query = mysqli_query($db, "SELECT * FROM noticias WHERE id = $noticia_id");    
				while ($noticia = mysqli_fetch_assoc($query)) {
					echo "<h2>".$noticia["nombre"]."</h2>
						<div id='noticia_".$noticia["id"]."' class='margen-vertical col-12 col-lg-12 col-md-12 col-sm-12'>
						<img src='".$noticia["imagen"]."' class='img' align='center' />
						<br><hr><br>
						<p style='text-align:justify;'>".$noticia["texto"]."</p>
					</div>";
				}
			?>
		</div>
	</section>
