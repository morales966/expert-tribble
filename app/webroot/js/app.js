$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
	switch (copy_js.controller_menu) {
		case 'PAGES':
		    if (copy_js.action == 'home') {
	            $("#home").removeClass('itemNegro');
				$('#home').addClass("activeNav");
		    } else if(copy_js.action == 'about') {
	            $("#about").removeClass('itemNegro');
		        $('#about').addClass("activeNav");
		    } else if (copy_js.action == 'businnes') {
	            $("#businnes").removeClass('itemNegro');
		        $('#businnes').addClass("activeNav");
		    } else {
		        $('#homeS').addClass("activeNavS");
		    }
		break;
		case 'USERS':
			if (copy_js.action == 'profile') {
				$('#profile').addClass("activeNavS");
			} else {
				$('#usuarios').addClass("activeNavS");
			}
		break;
		case 'CREDITS':
			$('#creditos').addClass("activeNavS");
		break;
		case 'XXX':
			$('#pagos').addClass("activeNavS");
		break;
	}

	if (copy_js.user_id > 0) {
		evitar_expiracion();
	}
	
});

$(document).keyup(function(event){
    if(event.which==13){
		if ( $("#btn_login_app").length > 0 ) {
	        login();
	    }
    }
});

$("body").on("click", ".closess", function() {
  $("#message_alert").hide();
  $("#flashMessage").hide();
})

$("body").on("click", "#btn_login", function() {
	$.post(copy_js.base_url+'Users/login',{}, function(result){
    	$('#resultModal').html(result);
		$('#modalTitle').text('Iniciar sesión');
		$('#modalLogin').modal('show');
    });
});

$("body").on("click", "#btn_login_app", function() {
	login();
});

$("body").on("click", "#btn_agregar_cliente", function() {
    $.post(copy_js.base_url+'Users/add_client',{}, function(result){
        $('#resultModalGrande').html(result);
        $('#modalTitleGrande').text('Regístrate con nosotros');
    	$('#modalGrande').modal('show');
    });
});

$("body").on("click", "#btn_add_client_save", function() {
	var instance 		= $('#formAddCliemt').parsley();
	if (instance.isValid() == true) {
		$('#validacion_texto').empty();
		var formData               = new FormData($('#formAddCliemt')[0]);
        $.ajax({
            type: 'POST',
            url: copy_js.base_url+'Users/addClientSave',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
				location.reload();
            }
        });
	} else {
		validarcampos();
        message_alert("Algo esta mal, por ejemplo todos los campos son requeridos","Error");
	}
});

function validarcampos(){
	var email 						= $('#UserEmail').val();
	var validacion_number 			= validarEmail(email);
	switch (validacion_number) {
		case 1:
			$('#validacion_texto').text("Todos los campos son requeridos");
		break;
		case 2:
			$('#validacion_texto').text("El correo eléctronico es incorrecto");
		break;
		default:
			$('#validacion_texto').text("Todos los campos son requeridos");
		break;
	}
}

function validarEmail(valor) {
	var validacion 			= '';
	if (valor == '') {
		validacion 				= 1;
	} else {
		var emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
	    if (emailRegex.test(valor)) {
			validacion 			= 1;
	    } else {
	    	validacion 			= 2;
	    }
	}
    return validacion
}

function message_alert(mensaje,type){
    $("#message_alert").css("display", "block");
    if (type == 'Bien') {
    	var alert = '<div class="message success"><i class="fa fa-4 fa-thumbs-up"></i><i class="fa fa-times closess"></i><div class="copiealertmin">BIEN!</div><div>'+mensaje+'</div></div>';
    } else { //Error
    	var alert = '<div class="message error"><i class="fa fa-4 fa-exclamation-triangle"></i><i class="fa fa-times closess"></i><div class="copiealertmin">ERROR!</div><div>'+mensaje+'</div></div>';
    }
    $("#message_alert").html(alert);
    setTimeout(function() {$("#message_alert").fadeOut("slow");},9000);
    $(".closess").click(function() {
        $("#message_alert").hide();
        $("#flashMessage").hide();
    })
}
setTimeout(function() {$("#flashMessage").fadeOut("slow");},9000);

function login(){
	var instance 		= $('#formLogin').parsley();
	if (instance.isValid() == true) {
		$('#validacion_texto').text("");
		var contrasena 		= $('#UserPassword').val();
		var email 			= $('#UserEmail').val();
		$.post(copy_js.base_url+'Users/loginData',{email:email,contrasena:contrasena}, function(result){
			location.reload();
		});
	} else {
		$('#validacion_texto').text("Todos los campos son requeridos");
	}
}

function string_valdate_Number(string){
    var out = '';
    var filtro = '1234567890';
    for (var i=0; i<string.length; i++){
        if (filtro.indexOf(string.charAt(i)) != -1) {
            out += string.charAt(i);
        }
    }
    return out;
}

function number_format(numero){
    numero                  = String(numero);
    numero                  = numero.replace(/\,/g, "");
    numero                  = numero.replace(/\./g, "");
    var resultado           = "";
    for (var j, i = numero.length - 1, j = 0; i >= 0; i--, j++){
        resultado = numero.charAt(i) + ((j > 0) && (j % 3 == 0)? ".": "") + resultado;
    }
    return resultado;
}

function format_number(numero,suma){
    numero              = String(numero);
    var res             = numero.replace(/\./g, "");
    res                 = res.replace(/\,/g, "");
    var precio          = parseFloat(res);
    var sum             = suma + precio;
    return sum;
}

function evitar_expiracion(){
	var milisegundos = 10 * 1000;
	    setInterval(function(){
		$.post(copy_js.base_url+'Users/evitarExpiracion',{}, function(result){});
    },milisegundos);
}