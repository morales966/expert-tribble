var $listaDeDispositivosCD;
var $listaDeDispositivosCT;
var $listaDeDispositivosFP;

const tieneSoporteUserMedia = () =>
    !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);

// Declaramos elementos del DOM (select)
$listaDeDispositivosCD = document.querySelector("#listaDeDispositivosCD");
$listaDeDispositivosCT = document.querySelector("#listaDeDispositivosCT");
$listaDeDispositivosFP = document.querySelector("#listaDeDispositivosFP");

const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

const limpiarSelectCD = () => {
    for (let x = $listaDeDispositivosCD.options.length - 1; x >= 0; x--)
        $listaDeDispositivosCD.remove(x);
};

const limpiarSelectCT = () => {
    for (let x = $listaDeDispositivosCT.options.length - 1; x >= 0; x--)
        $listaDeDispositivosCT.remove(x);
};

const limpiarSelectFP = () => {
    for (let x = $listaDeDispositivosFP.options.length - 1; x >= 0; x--)
        $listaDeDispositivosFP.remove(x);
};
// La función que es llamada después de que ya se dieron los permisos
// Lo que hace es llenar el select con los dispositivos obtenidos
const llenarSelectConDispositivosDisponiblesCD = () => {
    limpiarSelectCD();
    obtenerDispositivos().then(dispositivos => {
        const dispositivosDeVideo = [];
        dispositivos.forEach(dispositivo => {
            const tipo = dispositivo.kind;
            if (tipo === "videoinput") {
                dispositivosDeVideo.push(dispositivo);
            }
        });

        // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
        if (dispositivosDeVideo.length > 0) {
            // Llenar el select
            dispositivosDeVideo.forEach(dispositivo => {
                const option = document.createElement('option');
                option.value = dispositivo.deviceId;
                option.text = dispositivo.label;
                $listaDeDispositivosCD.appendChild(option);
            });
        }
    });
}

const llenarSelectConDispositivosDisponiblesCT = () => {
    limpiarSelectCT();
    obtenerDispositivos().then(dispositivos => {
        const dispositivosDeVideo = [];
        dispositivos.forEach(dispositivo => {
            const tipo = dispositivo.kind;
            if (tipo === "videoinput") {
                dispositivosDeVideo.push(dispositivo);
            }
        });

        // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
        if (dispositivosDeVideo.length > 0) {
            // Llenar el select
            dispositivosDeVideo.forEach(dispositivo => {
                const option = document.createElement('option');
                option.value = dispositivo.deviceId;
                option.text = dispositivo.label;
                $listaDeDispositivosCT.appendChild(option);
            });
        }
    });
}

const llenarSelectConDispositivosDisponiblesFP = () => {
    limpiarSelectFP();
    obtenerDispositivos().then(dispositivos => {
        const dispositivosDeVideo = [];
        dispositivos.forEach(dispositivo => {
            const tipo = dispositivo.kind;
            if (tipo === "videoinput") {
                dispositivosDeVideo.push(dispositivo);

            }
        });

        // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
        if (dispositivosDeVideo.length > 0) {
            // Llenar el select
            dispositivosDeVideo.forEach(dispositivo => {
                const option = document.createElement('option');
                option.value = dispositivo.deviceId;
                option.text = dispositivo.label;
                $listaDeDispositivosFP.appendChild(option);
            });
        }
    });
}

$("body").on("click", ".btn_abrir_modalCD", function() {
	// Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        message_alert("Lo siento. Tu navegador no soporta esta característica","Error");
	    $('.cuadro_tomar_foto').hide();
	    quitar_required_cuadro_tomar_foto();
	    $('.cuadro_adjuntar_foto').show();
    }
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
	quitar_required_cuadro_adjuntar_foto();

    //Aquí guardaremos el stream globalmente
    let stream;

    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
        .then(dispositivos => {
            // Vamos a filtrarlos y guardar aquí los de vídeo
            const dispositivosDeVideo = [];

            // Recorrer y filtrar
            dispositivos.forEach(function(dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            // y le pasamos el id de dispositivo
            if (dispositivosDeVideo.length > 0) {
                // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                mostrarStream(dispositivosDeVideo[0].deviceId);
            }
        });

    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
            video: {
                // Justo aquí indicamos cuál dispositivo usar
                deviceId: idDeDispositivo,
            }
        },
        (streamObtenido) => {
            // Aquí ya tenemos permisos, ahora sí llenamos el select,
            // pues si no, no nos daría el nombre de los dispositivos
            llenarSelectConDispositivosDisponiblesCD();

            // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
            $listaDeDispositivosCD.onchange = () => {
                // Detener el stream
                if (stream) {
                    stream.getTracks().forEach(function(track) {
                        track.stop();
                    });
                }
                // Mostrar el nuevo stream con el dispositivo seleccionado
                mostrarStream($listaDeDispositivosCD.value);
            }

            // Simple asignación
            stream = streamObtenido;

            // Mandamos el stream de la cámara al elemento de vídeo
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

        }, (error) => {
        	$('.cuadro_botones').hide();
			$('.btn_tomar').hide();
			$('.resultTomarFoto').empty();
			$('.resultTomarFoto').html('<p>Revisa la configuración de tu navegador</p>');
        	message_alert("Has denegado el permiso para la camara","Error");
        });
    }
});
$("body").on("click", "#btn_cerrar_camaraCD", function() {
    $('#modalTomarFotoCD').modal('hide');
});

$("body").on("click", ".btn_abrir_modalCT", function() {
	// Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        message_alert("Lo siento. Tu navegador no soporta esta característica","Error");
	    $('.cuadro_tomar_foto').hide();
	    quitar_required_cuadro_tomar_foto();
	    $('.cuadro_adjuntar_foto').show();
    }
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
	quitar_required_cuadro_adjuntar_foto();

    //Aquí guardaremos el stream globalmente
    let stream;

    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
        .then(dispositivos => {
            // Vamos a filtrarlos y guardar aquí los de vídeo
            const dispositivosDeVideo = [];

            // Recorrer y filtrar
            dispositivos.forEach(function(dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            // y le pasamos el id de dispositivo
            if (dispositivosDeVideo.length > 0) {
                // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                mostrarStream(dispositivosDeVideo[0].deviceId);
            }
        });

    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
            video: {
                // Justo aquí indicamos cuál dispositivo usar
                deviceId: idDeDispositivo,
            }
        },
        (streamObtenido) => {
            // Aquí ya tenemos permisos, ahora sí llenamos el select,
            // pues si no, no nos daría el nombre de los dispositivos
            llenarSelectConDispositivosDisponiblesCT();

            // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
            $listaDeDispositivosCT.onchange = () => {
                // Detener el stream
                if (stream) {
                    stream.getTracks().forEach(function(track) {
                        track.stop();
                    });
                }
                // Mostrar el nuevo stream con el dispositivo seleccionado
                mostrarStream($listaDeDispositivosCT.value);
            }

            // Simple asignación
            stream = streamObtenido;

            // Mandamos el stream de la cámara al elemento de vídeo
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

        }, (error) => {
        	$('.cuadro_botones').hide();
			$('.btn_tomar').hide();
			$('.resultTomarFoto').empty();
			$('.resultTomarFoto').html('<p>Revisa la configuración de tu navegador</p>');
        	message_alert("Has denegado el permiso para la camara","Error");
        });
    }
});
$("body").on("click", "#btn_cerrar_camaraCT", function() {
    $('#modalTomarFotoCT').modal('hide');
});

$("body").on("click", ".btn_abrir_modalFP", function() {
	// Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        message_alert("Lo siento. Tu navegador no soporta esta característica","Error");
	    $('.cuadro_tomar_foto').hide();
	    quitar_required_cuadro_tomar_foto();
	    $('.cuadro_adjuntar_foto').show();
    }
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
	quitar_required_cuadro_adjuntar_foto();

    //Aquí guardaremos el stream globalmente
    let stream;

    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
        .then(dispositivos => {
            // Vamos a filtrarlos y guardar aquí los de vídeo
            const dispositivosDeVideo = [];

            // Recorrer y filtrar
            dispositivos.forEach(function(dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            // y le pasamos el id de dispositivo
            if (dispositivosDeVideo.length > 0) {
                // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                mostrarStream(dispositivosDeVideo[0].deviceId);
            }
        });

    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
            video: {
                // Justo aquí indicamos cuál dispositivo usar
                deviceId: idDeDispositivo,
            }
        },
        (streamObtenido) => {
            // Aquí ya tenemos permisos, ahora sí llenamos el select,
            // pues si no, no nos daría el nombre de los dispositivos
            llenarSelectConDispositivosDisponiblesFP();

            // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
            $listaDeDispositivosCT.onchange = () => {
                // Detener el stream
                if (stream) {
                    stream.getTracks().forEach(function(track) {
                        track.stop();
                    });
                }
                // Mostrar el nuevo stream con el dispositivo seleccionado
                mostrarStream($listaDeDispositivosFP.value);
            }

            // Simple asignación
            stream = streamObtenido;

            // Mandamos el stream de la cámara al elemento de vídeo
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

        }, (error) => {
        	$('.cuadro_botones').hide();
			$('.btn_tomar').hide();
			$('.resultTomarFoto').empty();
			$('.resultTomarFoto').html('<p>Revisa la configuración de tu navegador</p>');
        	message_alert("Has denegado el permiso para la camara","Error");
        });
    }
});
$("body").on("click", "#btn_cerrar_camaraFP", function() {
    $('#modalTomarFotoFP').modal('hide');
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