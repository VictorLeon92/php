$("#form_registro").on("keypress click", function(){
  // variables que afectan a la verificación
  var nombre_registro = $("#nombre_registro").val();
  var apellidos_registro = $("#apellidos_registro").val();
  var email_registro = $("#email_registro").val();
  var password_registro = $("#password_registro").val();
  // llamada a la función de verificación del formulario
  verificar_registro(nombre_registro, apellidos_registro, email_registro, password_registro);

/*
  $("#form_registro").on("submit",function(e){
    // muestra el siguiente mensaje al enviar el formulario
    e.preventDefault();
    $("#error_registro").show();
    $("#send_registro").hide();

    $.ajax
      ({
        type: "POST",
        url: "/php/usuario/registro",
        data: { "nombre": nombre_registro, 
                "apellidos": apellidos_registro, 
                "email": email_registro, 
                "password": password_registro },
        success: function () {
          $("#form_registro")[0].reset();
          $("#error_registro").html("¡El registro se ha completado con éxito!");
        }
      });
    $("#error_registro").html("El correo electrónico ya está registrado");
  });*/
});


/* Función para verificar campos del formulario */

function verificar_registro(nombre, apellidos, email, password){
  var error = "ok";
  var patron_texto = "^[a-z A-Z]{4,30}$";
  var patron_correo = "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$";
  if (nombre.length < 1 || apellidos.length < 1 || email.length < 1 || password.length < 5) {
    error = "<ul>";
    if (!nombre.match(patron_texto)) {
      error += "<li>El nombre no es válido</li>";
    }
    if (!apellidos.match(patron_texto)) {
      error += "<li>Los apellidos no son válidos</li>";
    }
    if (!email.match(patron_correo)) {
      error += "<li>El correo electrónico no es válido</li>";
    }
    if (password.length < 5) {
      error += "<li>La contraseña debe tener un mínimo de 5 caracteres.</li>";
    }
    error += "</ul>";
  }
  else
  {
    error = "ok";
  }
  if (error != "ok") {
    $("#error_registro").show();
    $("#error_registro").html("Para poder registrarte, debes rellenar correctamente los siguientes campos: <br> " + error);
    $("#send_registro").hide();
  }
  else 
  {
    $("#error_registro").hide();
     $("#error_registro").html("El correo electrónico ya está registrado.");
    $("#send_registro").show();
  }
}
