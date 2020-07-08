$("#btn_cambiar").click(function() {
	var instance 		= $('#form').parsley();
	var actual 			= $('#actual').val();
	var nueva 			= $('#nueva').val();
	var r_nueva 		= $('#r_nueva').val();
	if (instance.isValid() == true) {
		$('#validacion_texto').text("");
		$.post(copy_js.base_url+copy_js.controller+'/changePasswordUser',{actual:actual,nueva:nueva,r_nueva:r_nueva}, function(result){
			if (result == '2') {
				$('#validacion_texto').text("La contraseña es diferente a la guardada en base de datos");
			} else if(result == '1'){
				$('#cambiarContrasenaModal').modal('hide');
				$('#actual').val('');
				$('#nueva').val('');
				$('#r_nueva').val('');
				$('#validacion_texto').empty();
				message_alert("Se ha actualizado tu contraseña satisfactoriamente","Bien");
			} else {
				$('#validacion_texto').text("No hemos podido guardar tu contraseña, por favor inténtalo mas tarde");
			}
    	});
	} else {
		if (actual == '') {
			$('#validacion_texto').text("Todos los campos son requeridos");
		} else if(nueva == '') {
			$('#validacion_texto').text("Todos los campos son requeridos");
		} else if (nueva != r_nueva) {
			$('#validacion_texto').text("Las contraseñas ingresadas no coinciden");
		}
	}
});