$(document).ready(function(){
	/* Inicio del menu de admin*/
	menuAdmin();

	// Secciones admin
	$("#btn_crear_proyecto").on("click", function(){
		menuAdmin("crear");
	});
	$("#btn_editar_proyecto").on("click", function(){
		menuAdmin("proyecto");
	});
	$("#btn_admin_usuario").on("click", function(){
		menuAdmin("usuario");
	});
	$("#btn_admin_cita").on("click", function(){
		menuAdmin("cita");
	});
	$("#btn_admin_volver").on("click", function(){
		menuAdmin("volver");
	});
	$(".volver-admin").on("click", function(){
		menuAdmin("volver-admin");
	});
	$(".borrar-proyecto").on("click", function(){
		menuAdmin("borrar-proyecto");
	});
	$(".borrar-usuario").on("click", function(){
		menuAdmin("borrar-usuario");
	});
});

// Botones administración
function menuAdmin(seccion){
	switch(seccion){
		case 'crear': 
			window.location.href = "http://localhost/php/proyecto/crear";
		break;
		case 'proyecto': 
			$("#cont_editar_proyecto").show();
			$("#cont_editar_cita").hide();
			$("#cont_admin_usuario").hide();
		break;
		case 'usuario': 
			$("#cont_admin_usuario").show();
			$("#cont_admin_cita").hide();
			$("#cont_editar_proyecto").hide();
		break;
		case 'cita': 
			$("#cont_admin_cita").show();
			$("#cont_admin_usuario").hide();
			$("#cont_editar_proyecto").hide();
		break;
		case 'volver': 
			window.location.href = "http://localhost/php/main/index";
		break;
		case 'volver-admin': 
			window.location.href = "http://localhost/php/admin/index";
		break;
		case 'borrar-proyecto': 
			window.location.href = "http://localhost/php/proyecto/borrar";
		break;
		case 'borrar-usuario': 
			window.location.href = "http://localhost/php/usuario/borrar";
		break;
		default:
			$("#cont_editar_proyecto").hide();
			$("#cont_admin_cita").hide();
			$("#cont_admin_usuario").hide();
		break;
	}
}