function tieneSoporteUserMedia() {
    return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
}

function _getUserMedia() {
    return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
}

$("body").on("click", ".btn_abrir_modalCD", function() {
	loadBotones();
	$('#modalTomarFoto').modal('show');
	var $video 									= document.getElementById("video");
	var $cerrar 								= document.getElementById("btn_cerrar_camara");
	var $canvas 								= document.getElementById("canvas");
	var $btn_tomar 								= document.getElementById("btn_tomar");
	var $btn_guardar_foto 						= document.getElementById("btn_guardar_foto");
	var $btn_cancelar_foto 						= document.getElementById("btn_cancelar_foto");
	var $CreditFotoCedulaDelantera1 			= document.getElementById("CreditFotoCedulaDelantera1");
	if (tieneSoporteUserMedia()) {
		quitar_required_cuadro_adjuntar_foto();
    	_getUserMedia({video: true},function (stream) {
			$video.srcObject = stream;
			$video.play();

			$btn_tomar.addEventListener("click", function(){
				$video.pause();
			});

			$btn_cancelar_foto.addEventListener("click", function(){
				$video.play();
			});

			$btn_guardar_foto.addEventListener("click", function(){
				var contexto 		= $canvas.getContext("2d");
				$canvas.width 		= $video.videoWidth;
				$canvas.height 		= $video.videoHeight;
				contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

				var foto 			= $canvas.toDataURL(); //Esta es la foto, en base 64

				var xhr 			= new XMLHttpRequest();
				xhr.open("POST", copy_js.base_url+copy_js.controller+"/guardar_fotoCD", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.send(encodeURIComponent(foto)); //Codificar y enviar
				xhr.onreadystatechange = function() {
				    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
						CreditFotoCedulaDelantera1.value = xhr.responseText;
				        stream.getTracks().forEach(function(track) {
							track.stop();
						});
				    }
				}
			});

			$cerrar.addEventListener("click", function(){
				stream.getTracks().forEach(function(track) {
					track.stop();
				});
			});
        }, function (error) {
        	message_alert("Has denegado el permiso para la camara","error");
		    $('.cuadro_tomar_foto').hide();
		    $('.cuadro_adjuntar_foto').show();
        });
	} else {
        message_alert("Lo siento. Tu navegador no soporta esta característica","error");
	    // message_alert("El NIT esta disponible","Bien");
	    $('.cuadro_tomar_foto').hide();
	    quitar_required_cuadro_tomar_foto();
	    $('.cuadro_adjuntar_foto').show();
	}
});

function quitar_required_cuadro_tomar_foto() {
	$('#CreditFotoCedulaDelantera1').removeAttr("required");
    $('#CreditFotoCedulaTrasera1').removeAttr("required");
    $('#CreditFotoPerfil1').removeAttr("required");
}

function quitar_required_cuadro_adjuntar_foto() {
    $('#CreditFotoCedulaDelantera').removeAttr("required");
    $('#CreditFotoCedulaTrasera').removeAttr("required");
    $('#CreditFotoPerfil').removeAttr("required");
}

$("body").on("click", ".btn_abrir_modalCT", function() {
	loadBotones();
	$('#modalTomarFoto').modal('show');
	var $video 									= document.getElementById("video");
	var $cerrar 								= document.getElementById("btn_cerrar_camara");
	var $canvas 								= document.getElementById("canvas");
	var $btn_tomar 								= document.getElementById("btn_tomar");
	var $btn_guardar_foto 						= document.getElementById("btn_guardar_foto");
	var $btn_cancelar_foto 						= document.getElementById("btn_cancelar_foto");
	var $CreditFotoCedulaTrasera1 				= document.getElementById("CreditFotoCedulaTrasera1");
	if (tieneSoporteUserMedia()) {
		quitar_required_cuadro_adjuntar_foto();
    	_getUserMedia({video: true},function (stream) {
			$video.srcObject = stream;
			$video.play();

			$btn_tomar.addEventListener("click", function(){
				$video.pause();
			});

			$btn_cancelar_foto.addEventListener("click", function(){
				$video.play();
			});

			$btn_guardar_foto.addEventListener("click", function(){
				var contexto 		= $canvas.getContext("2d");
				$canvas.width 		= $video.videoWidth;
				$canvas.height 		= $video.videoHeight;
				contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

				var foto 			= $canvas.toDataURL(); //Esta es la foto, en base 64

				var xhr 			= new XMLHttpRequest();
				xhr.open("POST", copy_js.base_url+copy_js.controller+"/guardar_fotoCT", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.send(encodeURIComponent(foto)); //Codificar y enviar
				xhr.onreadystatechange = function() {
				    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
						CreditFotoCedulaTrasera1.value = xhr.responseText;
				        stream.getTracks().forEach(function(track) {
							track.stop();
						});
				    }
				}
			});

			$cerrar.addEventListener("click", function(){
				stream.getTracks().forEach(function(track) {
					track.stop();
				});
			});
        }, function (error) {
            alert("Permiso denegado");
		    $('.cuadro_tomar_foto').hide();
		    $('.cuadro_adjuntar_foto').show();
        });
	} else {
	    alert("Lo siento. Tu navegador no soporta esta característica");
	    $('.cuadro_tomar_foto').hide();
	    quitar_required_cuadro_tomar_foto();
	    $('.cuadro_adjuntar_foto').show();
	}
});

$("body").on("click", ".btn_abrir_modalFP", function() {
	loadBotones();
	$('#modalTomarFoto').modal('show');
	var $video 									= document.getElementById("video");
	var $cerrar 								= document.getElementById("btn_cerrar_camara");
	var $canvas 								= document.getElementById("canvas");
	var $btn_tomar 								= document.getElementById("btn_tomar");
	var $btn_guardar_foto 						= document.getElementById("btn_guardar_foto");
	var $btn_cancelar_foto 						= document.getElementById("btn_cancelar_foto");
	var $CreditFotoPerfil1 						= document.getElementById("CreditFotoPerfil1");
	if (tieneSoporteUserMedia()) {
		quitar_required_cuadro_adjuntar_foto();
    	_getUserMedia({video: true},function (stream) {
			$video.srcObject = stream;
			$video.play();

			$btn_tomar.addEventListener("click", function(){
				$video.pause();
			});

			$btn_cancelar_foto.addEventListener("click", function(){
				$video.play();
			});

			$btn_guardar_foto.addEventListener("click", function(){
				var contexto 		= $canvas.getContext("2d");
				$canvas.width 		= $video.videoWidth;
				$canvas.height 		= $video.videoHeight;
				contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

				var foto 			= $canvas.toDataURL(); //Esta es la foto, en base 64

				var xhr 			= new XMLHttpRequest();
				xhr.open("POST", copy_js.base_url+copy_js.controller+"/guardar_fotoFP", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.send(encodeURIComponent(foto)); //Codificar y enviar
				xhr.onreadystatechange = function() {
				    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
						CreditFotoPerfil1.value = xhr.responseText;
				        stream.getTracks().forEach(function(track) {
							track.stop();
						});
				    }
				}
			});

			$cerrar.addEventListener("click", function(){
				stream.getTracks().forEach(function(track) {
					track.stop();
				});
			});
        }, function (error) {
            console.log("Permiso denegado");
		    $('.cuadro_tomar_foto').hide();
		    $('.cuadro_adjuntar_foto').show();
        });
	} else {
	    alert("Lo siento. Tu navegador no soporta esta característica");
	    $('.cuadro_tomar_foto').hide();
	    quitar_required_cuadro_tomar_foto();
	    $('.cuadro_adjuntar_foto').show();
	}
});

$("body").on("click", "#btn_tomar", function() {
	$('.cuadro_botones').show();
	$('#btn_tomar').hide();
});

$("body").on("click", "#btn_cancelar_foto", function() {
	loadBotones();
});

$("body").on("click", "#btn_guardar_foto", function() {
	$('#modalTomarFoto').modal('hide');
});

function loadBotones() {
	$('.cuadro_botones').hide();
	$('#btn_tomar').show();
}