function tieneSoporteUserMedia() {
    return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
}

function _getUserMedia() {
    return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
}

$("body").on("click", ".btn_abrir_modalCD", function() {
	loadBotones();
	$('#modalTitleTomarFotoCD').text('Foto de la cédula frontal');
	$('#modalTomarFotoCD').modal('show');
	var $video 									= document.getElementById("videoCD");
	var $cerrar 								= document.getElementById("btn_cerrar_camaraCD");
	var $canvas 								= document.getElementById("canvasCD");
	var $btn_tomar 								= document.getElementById("btn_tomarCD");
	var $btn_guardar_foto 						= document.getElementById("btn_guardar_fotoCD");
	var $btn_cancelar_foto 						= document.getElementById("btn_cancelar_fotoCD");
	var $CreditFotoCedulaDelantera1 			= document.getElementById("CreditFotoCedulaDelantera1");
	if (tieneSoporteUserMedia()) {
		quitar_required_cuadro_adjuntar_foto();
    	_getUserMedia({video: true},function (stream) {
			$video.srcObject = stream;
			$video.play();

			$btn_tomar.addEventListener("click", function(){
				$video.pause();
				$('#btn_tomarCD').hide();
				$('.cuadro_botones').show();
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
						$('#modalTomarFotoCD').modal('hide');
				    }
				}
			});

			$cerrar.addEventListener("click", function(){
				stream.getTracks().forEach(function(track) {
					track.stop();
				});
			});
        }, function (error) {
        	$('.cuadro_botones').hide();
			$('.btn_tomar').hide();
			$('.resultTomarFoto').empty();
			$('.resultTomarFoto').html('<p>Revisa la configuración de tu navegador</p>');
        	message_alert("Has denegado el permiso para la camara","Error");
        });
	} else {
        message_alert("Lo siento. Tu navegador no soporta esta característica","Error");
	    $('.cuadro_tomar_foto').hide();
	    quitar_required_cuadro_tomar_foto();
	    $('.cuadro_adjuntar_foto').show();
	}
});

$("body").on("click", ".btn_abrir_modalCT", function() {
	loadBotones();
	$('#modalTitleTomarFotoCT').text('Foto de la cédula trasera');
	$('#modalTomarFotoCT').modal('show');
	var $video 									= document.getElementById("videoCT");
	var $cerrar 								= document.getElementById("btn_cerrar_camaraCT");
	var $canvas 								= document.getElementById("canvasCT");
	var $btn_tomar 								= document.getElementById("btn_tomarCT");
	var $btn_guardar_foto 						= document.getElementById("btn_guardar_fotoCT");
	var $btn_cancelar_foto 						= document.getElementById("btn_cancelar_fotoCT");
	var $CreditFotoCedulaTrasera1 				= document.getElementById("CreditFotoCedulaTrasera1");
	if (tieneSoporteUserMedia()) {
		quitar_required_cuadro_adjuntar_foto();
    	_getUserMedia({video: true},function (stream) {
			$video.srcObject = stream;
			$video.play();

			$btn_tomar.addEventListener("click", function(){
				$video.pause();
				$('#btn_tomarCT').hide();
				$('.cuadro_botones').show();
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
						$('#modalTomarFotoCT').modal('hide');
				    }
				}
			});

			$cerrar.addEventListener("click", function(){
				stream.getTracks().forEach(function(track) {
					track.stop();
				});
			});
        }, function (error) {
        	$('.cuadro_botones').hide();
			$('.btn_tomar').hide();
			$('.resultTomarFoto').empty();
			$('.resultTomarFoto').html('<p>Revisa la configuración de tu navegador</p>');
        	message_alert("Has denegado el permiso para la camara","Error");
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
	$('#modalTitleTomarFotoFP').text('Foto del cliente');
	$('#modalTomarFotoFP').modal('show');
	var $video 									= document.getElementById("videoFP");
	var $cerrar 								= document.getElementById("btn_cerrar_camaraFP");
	var $canvas 								= document.getElementById("canvasFP");
	var $btn_tomar 								= document.getElementById("btn_tomarFP");
	var $btn_guardar_foto 						= document.getElementById("btn_guardar_fotoFP");
	var $btn_cancelar_foto 						= document.getElementById("btn_cancelar_fotoFP");
	var $CreditFotoPerfil1 						= document.getElementById("CreditFotoPerfil1");
	if (tieneSoporteUserMedia()) {
		quitar_required_cuadro_adjuntar_foto();
    	_getUserMedia({video: true},function (stream) {
			$video.srcObject = stream;
			$video.play();

			$btn_tomar.addEventListener("click", function(){
				$video.pause();
				$('#btn_tomarFP').hide();
				$('.cuadro_botones').show();
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
						$('#modalTomarFotoFP').modal('hide');
				    }
				}
			});

			$cerrar.addEventListener("click", function(){
				stream.getTracks().forEach(function(track) {
					track.stop();
				});
			});
        }, function (error) {
        	$('.cuadro_botones').hide();
			$('.btn_tomar').hide();
			$('.resultTomarFoto').empty();
			$('.resultTomarFoto').html('<p>Revisa la configuración de tu navegador</p>');
        	message_alert("Has denegado el permiso para la camara","Error");
        });
	} else {
	    alert("Lo siento. Tu navegador no soporta esta característica");
	    $('.cuadro_tomar_foto').hide();
	    quitar_required_cuadro_tomar_foto();
	    $('.cuadro_adjuntar_foto').show();
	}
});

$("body").on("click", ".btn_cancelar_foto", function() {
	loadBotones();
});

$("body").on("click", "#btn_guardar_foto", function() {
	$('#modalTomarFoto').modal('hide');
});

function loadBotones() {
	$('.cuadro_botones').hide();
	$('.btn_tomar').show();
}

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