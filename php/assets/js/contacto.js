$("#form_contacto").on("keyup",function(){
	// variables que afectan a la verificación
	var nombre_contacto = $("#nombre_contacto").val();
	var apellidos_contacto = $("#apellidos_contacto").val();
	var telefono_contacto = $("#telefono_contacto").val();
	var correo_contacto = $("#correo_contacto").val();
	var fecha_contacto = $("#fecha_contacto").val();
	var motivo_contacto = $("#motivo_contacto").val();
	// llamada a la función de verificación del formulario
	verificar_contacto(nombre_contacto, apellidos_contacto, telefono_contacto, correo_contacto, fecha_contacto, motivo_contacto);
});

$("#form_contacto").on("submit",function(e){
	// muestra el siguiente mensaje al enviar el formulario
	$("#error_contacto").show();
	$("#enviar_contacto").hide();
	$("#error_contacto").html("¡Gracias por contactar con nosotros! Responderemos a tu mensaje en breve.");
});

/* Función para verificar campos del formulario */

function verificar_contacto(nombre, apellidos, telefono, correo, fecha, motivo){
	var error = "ok";
	var patron_texto = "^[a-z A-Z]{4,30}$";
	var patron_correo = "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$";
	var patron_telefono = "^[0-9]{9}$";
	var formato = fecha.split("-");
    var y = parseInt(formato[0]);
    var m = parseInt(formato[1]);
    var d = parseInt(formato[2]);
    var fecha_completa = new Date(formato[0],(formato[1] - 1),formato[2]);
    var hoy = new Date();
	if (nombre.length < 1 || apellidos.length < 1 || telefono.length < 1 || correo.length < 1 || fecha.length < 1 || motivo.length < 1) {
		error = "<ul>";
		if (!nombre.match(patron_texto)) {
			error += "<li>El nombre no es válido</li>";
		}
		if (!apellidos.match(patron_texto)) {
			error += "<li>Los apellidos no son válidos</li>";
		}
		if (!telefono.match(patron_telefono)) {
			error += "<li>El teléfono no es válido</li>";
		}
		if (!correo.match(patron_correo)) {
			error += "<li>El correo electrónico no es válido</li>";
		}
		if (isNaN(d) || isNaN(m) || isNaN(y) || fecha_completa <= hoy) {
			error += "<li>La fecha no es válida, debe ser posterior al día actual</li>";
		}
		if (motivo.length < 1) {
			error += "<li>El motivo no puede estar vacío</li>";
		}
		error += "</ul>";
	}
	else
	{
		error = "ok";
	}
	if (error != "ok") {
		$("#error_contacto").show();
		$("#error_contacto").html("Para poder enviar el formulario, debes rellenar correctamente los siguientes campos: <br> " + error);
		$("#enviar_contacto").hide();
	}
	else 
	{
		$("#error_contacto").hide();
		$("#enviar_contacto").show();
	}
}
