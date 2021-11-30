$(document).ready(function(){

	/* Inicio del formulario en Login */
	cambiarFormulario();

	/* Cambios de página al hacer click en el menú correspondiente */
	$("#index").on("click", function(){
		activarMenu("index");
	});
	$("#portfolio").on("click", function(){
		activarMenu("portfolio");
	});
	$("#presupuesto").on("click", function(){
		activarMenu("presupuesto");
	});
	$("#donde").on("click", function(){
		activarMenu("donde");
	});
	$("#contacto").on("click", function(){
		activarMenu("contacto");
	});

	/* Cambiar de menú a admin, perfil o cerrar sesión cuando se está registrado */
	$("#btn-admin").on("click", function(){
		activarMenu("admin");
	});
	$("#btn-citas").on("click", function(){
		activarMenu("citas");
	});
	$("#btn-perfil").on("click", function(){
		activarMenu("perfil");
	});
	$("#btn-cerrar").on("click", function(){
		activarMenu("cerrar");
	});

	// Cambiar entre registro y login
	$("#btn-login").on("click", function(){
		cambiarFormulario("login");
	});
	$("#btn-register").on("click", function(){
		cambiarFormulario("register");
	});

	/* Menú responsive */
	var dispositivo = $(document).width();
	if (dispositivo <= 1024){
		$("#menu-responsive").show();
		$("#lista_menu").hide();
		$("#menu").css({
			"width": "auto",
			"min-width": "50px",
			"background-color": "#000",
			
		});
		$("nav ul").css({
			"margin": "none",
			"margin-left": "0",
			"margin-roght": "0"
		});
		$("nav ul li").addClass("secciones-responsive");
		$("#menu-responsive").on("click",function(){
			$("#lista_menu").toggle(300);
		});
	}
	else 
	{
		$("#menu-responsive").hide();	
	}

	//inicia el temporizador del popup
	//temporizador();
});

/* Cambio entre páginas y estilos activos del menú */
function activarMenu(menu){
	switch(menu){
		case 'index': 
			window.location.href = "http://localhost/php/";
		break;

		case 'portfolio':
			window.location.href = "http://localhost/php/main/portfolio";
		break;
		
		case 'presupuesto':
			window.location.href = "http://localhost/php/main/presupuesto";
		break;
		
		case 'donde':
			window.location.href = "http://localhost/php/main/donde";
		break;
		
		case 'contacto':
			window.location.href = "http://localhost/php/main/contacto";
		break;

		case 'admin':
			window.location.href = "http://localhost/php/admin/index";
		break;

		case 'citas':
			window.location.href = "http://localhost/php/usuario/citas";
		break;

		case 'perfil':
			window.location.href = "http://localhost/php/usuario/perfil";
		break;

		case 'cerrar':
			window.location.href = "http://localhost/php/usuario/logout";
		break;

	}
}

// Selecciona el tiempo para la carga y la función que llama al alert
/*function temporizador(){
	var t = setTimeout("mostrarAlert();", 5000);
}*/

// Muestra el alert con el mensaje
/*function mostrarAlert(){
	alert("¡Bienvenido a la página web, esperamos que disfrutes del contenido!");
}
*/
	
/* Cambiar de registro a login */
function cambiarFormulario(cuenta){
	switch(cuenta){
		case 'login': 
			window.location.href = "http://localhost/php/usuario/login";
		break;
		case 'register': 
			window.location.href = "http://localhost/php/usuario/registro";
		break;
	}
}
