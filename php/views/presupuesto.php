<!-- Sección de presupuesto -->
<div class="row container-fluid">
	<section id="cuerpo-presupuesto" class="margen-vertical col-12 col-lg-9 col-md-12 col-sm-12">
		<div class="row container-fluid margen-vertical">
			<form id="form_presupuesto" method="POST" action="" enctype="multipart/form-data">
			<div class="col-12 col-lg-12 col-md-12 col-sm-12">
				<h3>Datos de contacto</h3><hr>
				<div class="row">
					<div class="col-6 col-lg-6 col-md-12 col-sm-12">		
						<label for="nombre">Nombre *: </label><br>
							<input type="text" id="nombre_presupuesto" name="nombre"><br>
						
					</div>
					<div class="col-6 col-lg-6 col-md-12 col-sm-12">

						<label for="apellidos">Apellidos *: </label><br>
							<input type="text" id="apellidos_presupuesto" name="apellidos"><br>
						
					</div>
				</div>
				<div class="row">
					<div class="col-6 col-lg-6 col-md-12 col-sm-12">	

						<label for="telefono">Teléfono *: </label><br>
							<input type="number" id="telefono_presupuesto" name="telefono"><br>
					
					</div>
					<div class="col-6 col-lg-6 col-md-12 col-sm-12">

						<label for="correo">Correo electrónico *: </label><br>
							<input type="email" id="correo_presupuesto"name="correo"><br>
					</div>
				</div>
				<p>
					<h3>Datos sobre el proyecto</h3>
					<div class="row">
						<div class="col-6 col-lg-6 col-md-12 col-sm-12">
							<label for="tipo_web">Tipo de página: </label><br>
							<select id="tipo_web" name="tipo_web" >
								<option value="bronce" selected="selected">Bronce</option>
								<option value="plata">Plata</option>
								<option value="oro">Oro</option>
								<option value="platino">Platino</option>
							</select>
						</div>
						<div class="col-6 col-lg-6 col-md-12 col-sm-12">
						<label for="plazo">Plazo en meses: </label><br>
							<input  id="plazo" type="number" name="plazo" value="1" />
						</div>
					</div>
					<label for="secciones">Secciones: </label>
					<div class="row">
						<div class="col-3 col-lg-3 col-md-6 col-sm-6">
							<input type="checkbox" id="quienes" class="secciones" /><label for="quienes" class="label-check">Quienes Somos</label>
						</div>
						<div class="col-3 col-lg-3 col-md-6 col-sm-6">
							<input type="checkbox" id="donde_estamos" class="secciones" /><label for="donde_estamos" class="label-check">Donde Estamos</label>
						</div>
						<div class="col-3 col-lg-3 col-md-6 col-sm-6">
							<input type="checkbox" id="galeria" class="secciones" /><label for="galeria" class="label-check">Galería de Fotos</label>
						</div>
						<div class="col-3 col-lg-3 col-md-6 col-sm-6">
							<input type="checkbox" id="tienda" class="secciones" /><label for="tienda" class="label-check">E-Commerce</label>
						</div>
						<div class="col-3 col-lg-3 col-md-6 col-sm-6">
							<input type="checkbox" id="gestion" class="secciones" /><label for="gestion" class="label-check">Gestión Interna</label>
						</div>
						<div class="col-3 col-lg-3 col-md-6 col-sm-6">
							<input type="checkbox" id="noticias" class="secciones" /><label for="noticias" class="label-check">Noticias</label>
						</div>
						<div class="col-3 col-lg-3 col-md-6 col-sm-6">
							<input type="checkbox" id="red_facebook" class="secciones" /><label for="red_facebook" class="label-check">Facebook</label>
						</div>
						<div class="col-3 col-lg-3 col-md-6 col-sm-6">
							<input type="checkbox" id="red_twitter" class="secciones" /><label for="red_twitter" class="label-check">Twitter</label>
						</div>
					</div>
				</p>

			</div>
			<div class="col-12 col-lg-12 col-md-12 col-sm-12 text-center">

						<h3>Presupuesto estimado<br>
							<span class="texto-peque">El coste puede variar, en función de cada web.</span>
						</h3><br>
						<input id="precio_final" type="text" name="precio_final" value="1200 €" disabled="disabled" />
						<hr style="border: 2px solid #0a0a2a;">
						<div id="error_presupuesto">Por favor, rellena los campos con asterisco (obligatorios) para que puedas enviarnos tu presupuesto.</div>
						<input type="submit" id="enviar_presupuesto" value="Solicitar presupuesto">
			</div>
			</form>
			<script type="text/javascript" src="<?=base_url?>assets/js/presupuesto.js"></script>
		</div>
	</section>