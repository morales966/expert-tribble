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
		case 'CREDITS':
			$('#creditos').addClass("activeNavS");
		break;
		case 'USERS':
			$('#profile').addClass("activeNavS");
		break;
	}

	if (copy_js.user_id > 0) {
		evitar_expiracion();
	}
	
});

$(document).keyup(function(event){
	// event.preventDefault();
    // return false;
    if(event.which==13){
        login();
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
	if ( $("#btn_login_app").length > 0 ) {
		var contrasena 		= $('#UserPassword').val();
		var email 			= $('#UserEmail').val();
		$.post(copy_js.base_url+'Users/loginData',{email:email,contrasena:contrasena}, function(result){
			location.reload();
			// if (result == 1) {
			// 	location.href = copy_js.base_url+'pages/index';
			// } else {
			//     location.reload();
			// }
		});
	}
}

function evitar_expiracion(){
	var milisegundos = 10 * 1000;
	    setInterval(function(){
		$.post(copy_js.base_url+'Users/evitarExpiracion',{}, function(result){});
    },milisegundos);
}