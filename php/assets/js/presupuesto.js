/* Eventos de presupuesto */

$("#precio_final,#tipo_web,#plazo,.secciones").bind("change keyup",function(){
	// variables que afectan a la función rango
	var secciones = [];
    $(".secciones:checked").each(function(i){
        secciones[i] = $(this).val();
    });
	var tipo_web = $("#tipo_web").val();
	var plazo = parseInt($("#plazo").val());
	// llamada a la función rango con los valores de las variables
	rango(tipo_web, plazo, secciones.length);
});


$("#form_presupuesto").on("keyup",function(){
	// variables que afectan a la verificación
	var nombre_presupuesto = $("#nombre_presupuesto").val();
	var apellidos_presupuesto = $("#apellidos_presupuesto").val();
	var telefono_presupuesto = $("#telefono_presupuesto").val();
	var correo_presupuesto = $("#correo_presupuesto").val();
	// llamada a la función de verificación del formulario
	verificar_presupuesto(nombre_presupuesto, apellidos_presupuesto, telefono_presupuesto, correo_presupuesto);
});

$("#form_presupuesto").on("submit",function(e){
	// muestra el siguiente mensaje al enviar el formulario
	e.preventDefault();
	$("#error_presupuesto").show();
	$("#enviar_presupuesto").hide();
	$("#error_presupuesto").html("¡Gracias por enviarnos tu presupuesto! Nos pondremos en contacto contigo en breve.");
});

/* Función para calcular precio */

function rango(opcion, meses, extras) {
 	var precio_total;
    switch(opcion) {
        case "bronce":
        	precio_total = 1200;
	        if (meses == 1) {
	        	precio_total;
	        } else if (meses == 2) {
	        	precio_total -= (1200 * 0.05);
	        } else if (meses == 3) {
	        	precio_total -= (1200 * 0.1);
	        } else if (meses == 4) {
	        	precio_total -= (1200 * 0.15);
	        } else if (meses >= 5) {
	        	precio_total -= (1200 * 0.2);
	        }
	        for(var bucle = 1; bucle <= extras; bucle++){
				precio_total += 400;
			}
        break;
        case "plata":
        	precio_total = 1500;
	        if (meses == 1) {
	        	precio_total;
	        } else if (meses == 2) {
	        	precio_total -= (1500 * 0.05);
	        } else if (meses == 3) {
	        	precio_total -= (1500 * 0.1);
	        } else if (meses == 4) {
	        	precio_total -= (1500 * 0.15);
	        } else if (meses >= 5) {
	        	precio_total -= (1500 * 0.2);
	        }
	        for(var bucle = 1; bucle <= extras; bucle++){
				precio_total += 400;
			}
        break;
        case "oro":
        	precio_total = 1800;
	        if (meses == 1) {
	        	precio_total;
	        } else if (meses == 2) {
	        	precio_total -= (1800 * 0.05);
	        } else if (meses == 3) {
	        	precio_total -= (1800 * 0.1);
	        } else if (meses == 4) {
	        	precio_total -= (1800 * 0.15);
	        } else if (meses >= 5) {
	        	precio_total -= (1800 * 0.2);
	        }
	        for(var bucle = 1; bucle <= extras; bucle++){
				precio_total += 400;
			}
        break;
        case "platino":
        	precio_total = 2000;
	        if (meses == 1) {
	        	precio_total;
	        } else if (meses == 2) {
	        	precio_total -= (2000 * 0.05);
	        } else if (meses == 3) {
	        	precio_total -= (2000 * 0.1);
	        } else if (meses == 4) {
	        	precio_total -= (2000 * 0.15);
	        } else if (meses >= 5) {
	        	precio_total -= (2000 * 0.2);
	        }
	        for(var bucle = 1; bucle <= extras; bucle++){
				precio_total += 400;
			}
        break;
        default:
        	precio_total = 1200;
	        if (meses == 1) {
	        	precio_total;
	        } else if (meses == 2) {
	        	precio_total -= (1200 * 0.05);
	        } else if (meses == 3) {
	        	precio_total -= (1200 * 0.1);
	        } else if (meses == 4) {
	        	precio_total -= (1200 * 0.15);
	        } else if (meses >= 5) {
	        	precio_total -= (1200 * 0.2);
	        }
	        for(var bucle = 1; bucle <= extras; bucle++){
				precio_total += 400;
			}
        break;
	}  
	return $("#precio_final").val(precio_total + ' €');       
};

/* Función para verificar campos del formulario */

function verificar_presupuesto(nombre, apellidos, telefono, correo){
	var error = "ok";
	var patron_texto = "^[a-z A-Z]{4,30}$";
	var patron_correo = "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$";
	var patron_telefono = "^[0-9]{9}$";
	if (nombre.length < 1 || apellidos.length < 1 || telefono.length < 1 || correo.length < 1) {
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
		error += "</ul>";
	}
	else
	{
		error = "ok";
	}
	if (error != "ok") {
		$("#error_presupuesto").show();
		$("#error_presupuesto").html("Para poder enviar el formulario, debes rellenar correctamente los siguientes campos: <br> " + error);
		$("#enviar_presupuesto").hide();
	}
	else 
	{
		$("#error_presupuesto").hide();
		$("#enviar_presupuesto").show();
	}
}

