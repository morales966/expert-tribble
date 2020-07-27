$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
	var value = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
	$accionesEjecutivo 		= ['comercios','view'+value,'add_client','messages_data'];
	if(!isNaN(value)) {
		copy_js.action = 'view'+value;
	}
	switch (copy_js.controller_menu) {
		case 'PAGES':
		    $('#homeS').addClass("activeNavS");
		break;
		case 'USERS':
			if (copy_js.action == 'profile') {
				$('#profile').addClass("activeNavS");
			} else if($accionesEjecutivo.indexOf(copy_js.action) != '-1') {
                if (copy_js.action == 'messages_data') {
                    $('#usuarios').removeClass("activeNavS");
                    $('#comercios').removeClass("activeNavS");
                    $('#datosDejados').addClass("activeNavS");
                } else {
                    $('#usuarios').removeClass("activeNavS");
                    $('#datosDejados').removeClass("activeNavS");
                    $('#comercios').addClass("activeNavS");
                }
			} else {
				$('#comercios').removeClass("activeNavS");
                $('#datosDejados').removeClass("activeNavS");
				$('#usuarios').addClass("activeNavS");
			}
		break;
		case 'CREDITS':
            if (copy_js.action == 'payments_available') {
                $('#pagos').addClass("activeNavS");
            } else if (copy_js.action == 'paid_customers') {
                $('#pagos').addClass("activeNavS");
            } else {
                $('#creditos').addClass("activeNavS");
            }
		break;
	}

	if (copy_js.user_id > 0) {
		cargar_notificaciones();
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

$("body").on("click", "#notificaciones_leidas", function() {
    swal({
        title: "¿Estas seguro de marcar todas las notificaciones en leidas?",
        text: "¿Deseas continuar con la acción?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonText:"Cancelar",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
    },
    function(){
        $.post(copy_js.base_url+'Messages/marcarNotificacionesLeidas',{}, function(result){
            location.href =copy_js.base_url+copy_js.controller+'/'+copy_js.action;
        });
    });
});

$("body").on( "click", ".stateNotificacion", function() {
    var notificacion_id         = $(this).data('uid');
    var state                   = $(this).data('state');
    $.post(copy_js.base_url+'Messages/changestate',{notificacion_id:notificacion_id,state:state}, function(result){
        location.href = result;
    });
});

$("body").on( "click", ".stateContact", function() {
    var contact_id              = $(this).data('uid');
    var state                   = $(this).data('state');
    $.post(copy_js.base_url+'Users/changestateContact',{contact_id:contact_id,state:state}, function(result){
        location.reload();
    });
});

$("body").on( "click", ".stateUserHabilitar", function() {
    var user_id                 = $(this).data('uid');
    var state                   = $(this).data('state');
    $.post(copy_js.base_url+'Users/changestate',{user_id:user_id,state:state}, function(result){
        location.reload();
    });
});

$("body").on( "click", ".stateUserInhabilitado", function() {
    var user_id                 = $(this).data('uid');
    var state                   = $(this).data('state');
    $.post(copy_js.base_url+'Users/changestate',{user_id:user_id,state:state}, function(result){
        location.reload();
    });
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

$("body").on( "click", "#btn_guardar_form_datos", function() {
	var instance 		   		 = $('#form_datos_id').parsley();
	if (instance.isValid() == true) {
		var formData             	= new FormData($('#form_datos_id')[0]);
        $.ajax({
            type: 'POST',
            url: copy_js.base_url+'Users/saveContact',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
				$('#ContactName').val('');
				$('#ContactTelephone').val('');
				$('#ContactEmail').val('');
				$('#ContactEstablishment').val('');
        		message_alert("Registro satisfactorio, un asesor especializado te contactará para demostrarte cómo aumentar tus ventas","Bien");
            }
        });
	} else {
        message_alert("Algo esta mal, por ejemplo todos los campos son requeridos","Error");
	}
});

function cargar_notificaciones(){
    $.post(copy_js.base_url+'Messages/notificaciones',{}, function(result){
        $('#paint_notificaciones').html(result);
    });
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