$(document).ready(function(){
	$(".next-form").hide();
	var form_count 			= 1, previous_form, next_form, total_forms;
	total_forms		 		= $("fieldset").length;
    setProgressBarValue(1,2);
	// setProgressBarValue(form_count,total_forms);
});

$("body").on("click", ".next-form", function() {
	previous_form = $(this).parent();
	next_form = $(this).parent().next();
	next_form.show();
	previous_form.hide();
	setProgressBarValue(2,2);
	// setProgressBarValue(++form_count,total_forms);
});

$("body").on("click", ".previous-form", function() {
	previous_form = $(this).parent();
	next_form = $(this).parent().prev();
	next_form.show();
	previous_form.hide();
	setProgressBarValue(1,2);
	// setProgressBarValue(--form_count,total_forms);
});

$("body").on("click", "#checkbox1", function() {
    if (!$(this).is(':checked')) {
		$(".next-form").hide();
    } else {
    	if ($('#CreditValorCuota').val() != '' || $('#CreditValorCuota').val() != 0) {
			$(".next-form").show();
		}
    }
});

$( "#register_form" ).submit(function(event) {
	var instance 		= $('#register_form').parsley();
	if (!instance.isValid()) {
		event.preventDefault();
    	message_alert("Algo esta mal, todos los campos son requeridos","Error");
	}
});

$("body").on("click", "#btn_solicitar_credito", function() {
    var instance 		= $('#register_form').parsley();
	if (!instance.isValid()) {
		event.preventDefault();
    	message_alert("Algo esta mal, todos los campos son requeridos","Error");
	} else {
		var formData               = new FormData($('#register_form')[0]);
        $.ajax({
            type: 'POST',
            url: copy_js.base_url+'Users/addSolicitudCreditoUsuario',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                $('#modalGrande').modal('hide');
    			message_alert("Se ha registrado tu solicitud a nombre del cliente del código ingresado","Bien");
            }
        });
	}
});


$("body").on("change", "#CreditNumeroMeses", function() {
	var meses 				= $('#CreditNumeroMeses').val();
	if(meses != '') {
		calcular_valor();
	}
});

$("body").on("keyup", "#CreditValorCredito", function() {
	var valor 				= $('#CreditValorCredito').val();
	var meses 				= $('#CreditNumeroMeses').val();
	if (parseInt(valor) <= 1500000) {
	    if (parseInt(valor) >= 50000) {
			opcionesSelect(valor);
			calcular_valor();
		} else {
			$('.meses_credito').empty();
			$('#CreditValorCuota').val('0');
    		message_alert("El valor del crédito debe ser mayor o igual a 50.000","Error");
		}
	} else {
		$('.meses_credito').empty();
		$('#CreditValorCuota').val('0');
    	message_alert("El valor del crédito debe ser menor o igual a 1.500.000","Error");
	}
});

$("body").on("click", "#TerminosCondiciones", function() {
	$('#modalTerminosCondiciones').modal('show');
});

$("body").on("click", "#btn_aceptar_documento", function() {
	$("input[type=checkbox]").prop("checked",true);
	$('#modalTerminosCondiciones').modal('hide');
});

function setProgressBarValue(value,total_forms) {
	var percent = parseFloat(100 / total_forms) * value;
	percent = percent.toFixed();
	$(".progress-bar")
	.css("width",percent+"%")
	.html("Formulario "+percent+"%");
}

function calcular_valor() {
	var valor 				= $('#CreditValorCredito').val();
	var meses 				= $('#CreditNumeroMeses').val();
	var resultado 			= 0;
 	resultado 				= valorCuota(valor,meses);
	$('#CreditValorCuota').val(number_format(resultado));
}

function valorCuota(valor,meses) {
	var resultado 			= 0;
	var tasa2				= 8.63/100;
	var tasa3				= 6.12/100;
	var tasa4				= 5.87/100;
	var tasa5				= 4.72/100;
	var tasa6				= 4.12/100;
	var tasa7 				= 3.55/100;
	var tasa8 				= 3.25/100;
	var tasa9 				= 2.9/100;
	var tasa10 				= 2.63/100;
	var tasa11 				= 2.41/100;
	var tasa12				= 2.22/100;
	var tasa13				= 2.06/100;
	var tasa14				= 1.93/100;
	var tasa15				= 1.88/100;
	var tasa16				= 1.78/100;
	var tasa17 				= 1.62/100;
	var tasa18 				= 1.6/100;
	var tasa19 				= 1.53/100;
	var tasa20 				= 1.46/100;
	var tasa21 				= 1.36/100;
	var tasa22				= 1.31/100;
	var tasa23				= 1.26/100;
	var tasa24				= 1.6/100;

	switch (meses) {
		case '2':
			resultado 		= calculateValor(valor,meses,tasa2);
			break;
		case '3':
			resultado 		= calculateValor(valor,meses,tasa3);
			break;
		case '4':
			resultado 		= calculateValor(valor,meses,tasa4);
			break;
		case '5':
			resultado 		= calculateValor(valor,meses,tasa5);
			break;
		case '6':
			resultado 		= calculateValor(valor,meses,tasa6);
			break;
		case '7':
			resultado 		= calculateValor(valor,meses,tasa7);
			break;
		case '8':
			resultado 		= calculateValor(valor,meses,tasa8);
			break;
		case '9':
			resultado 		= calculateValor(valor,meses,tasa9);
			break;
		case '10':
			resultado 		= calculateValor(valor,meses,tasa10);
			break;
		case '11':
			resultado 		= calculateValor(valor,meses,tasa11);
			break;
		case '12':
			resultado 		= calculateValor(valor,meses,tasa12);
			break;
		case '13':
			resultado 		= calculateValor(valor,meses,tasa13);
			break;
		case '14':
			resultado 		= calculateValor(valor,meses,tasa14);
			break;
		case '15':
			resultado 		= calculateValor(valor,meses,tasa15);
			break;
		case '16':
			resultado 		= calculateValor(valor,meses,tasa16);
			break;
		case '17':
			resultado 		= calculateValor(valor,meses,tasa17);
			break;
		case '18':
			resultado 		= calculateValor(valor,meses,tasa18);
			break;
		case '19':
			resultado 		= calculateValor(valor,meses,tasa19);
			break;
		case '20':
			resultado 		= calculateValor(valor,meses,tasa20);
			break;
		case '21':
			resultado 		= calculateValor(valor,meses,tasa21);
			break;
		case '22':
			resultado 		= calculateValor(valor,meses,tasa22);
			break;
		case '23':
			resultado 		= calculateValor(valor,meses,tasa23);
			break;
		case '24':
			resultado 		= calculateValor(valor,meses,tasa24);
			break;

		default:
			resultado 		= 0;
		break;
	}
	return resultado;
}

function opcionesSelect(valor) {
	$('.meses_credito').empty();
	$('#CreditValorCuota').val('0');
	var sel = $('<select class="form-control" id="CreditNumeroMeses" name="select_dias">').appendTo('.meses_credito');
	if (parseInt(valor) >= 50000 && parseInt(valor) <= 100000) {
		var arr = [
			{val : 2, text: '2 meses'},
			{val : 3, text: '3 meses'},
			{val : 4, text: '4 meses'}
		];
		$(arr).each(function() {
			sel.append($("<option>").attr('value',this.val).text(this.text));
		});
	}
	if (parseInt(valor) >= 100001 && parseInt(valor) <= 300000) {
		var arr = [
			{val : 3, text: '3 meses'},
			{val : 4, text: '4 meses'},
			{val : 5, text: '5 meses'},
			{val : 6, text: '6 meses'},
			{val : 7, text: '7 meses'}
		];
		$(arr).each(function() {
			sel.append($("<option>").attr('value',this.val).text(this.text));
		});
	}
	if (parseInt(valor) >= 300001 && parseInt(valor) <= 400000) {
		var arr = [
			{val : 4, text: '4 meses'},
			{val : 5, text: '5 meses'},
			{val : 6, text: '6 meses'},
			{val : 7, text: '7 meses'},
			{val : 8, text: '8 meses'},
			{val : 9, text: '9 meses'}
		];
		$(arr).each(function() {
			sel.append($("<option>").attr('value',this.val).text(this.text));
		});
	}
	if (parseInt(valor) >= 400001 && parseInt(valor) <= 500000) {
		var arr = [
			{val : 4, text: '4 meses'},
			{val : 5, text: '5 meses'},
			{val : 6, text: '6 meses'},
			{val : 7, text: '7 meses'},
			{val : 8, text: '8 meses'},
			{val : 9, text: '9 meses'},
			{val : 10, text: '10 meses'},
			{val : 11, text: '11 meses'},
			{val : 12, text: '12 meses'}
		];
		$(arr).each(function() {
			sel.append($("<option>").attr('value',this.val).text(this.text));
		});
	}
	if (parseInt(valor) >= 500001 && parseInt(valor) <= 700000) {
		var arr = [
			{val : 4, text: '4 meses'},
			{val : 5, text: '5 meses'},
			{val : 6, text: '6 meses'},
			{val : 7, text: '7 meses'},
			{val : 8, text: '8 meses'},
			{val : 9, text: '9 meses'},
			{val : 10, text: '10 meses'},
			{val : 11, text: '11 meses'},
			{val : 12, text: '12 meses'},
			{val : 13, text: '13 meses'},
			{val : 14, text: '14 meses'},
			{val : 15, text: '15 meses'}
		];
		$(arr).each(function() {
			sel.append($("<option>").attr('value',this.val).text(this.text));
		});
	}
	if (parseInt(valor) >= 700001 && parseInt(valor) <= 1000000) {
		var arr = [
			{val : 4, text: '4 meses'},
			{val : 5, text: '5 meses'},
			{val : 6, text: '6 meses'},
			{val : 7, text: '7 meses'},
			{val : 8, text: '8 meses'},
			{val : 9, text: '9 meses'},
			{val : 10, text: '10 meses'},
			{val : 11, text: '11 meses'},
			{val : 12, text: '12 meses'},
			{val : 13, text: '13 meses'},
			{val : 14, text: '14 meses'},
			{val : 15, text: '15 meses'},
			{val : 16, text: '16 meses'},
			{val : 17, text: '17 meses'},
			{val : 18, text: '18 meses'}
		];
		$(arr).each(function() {
			sel.append($("<option>").attr('value',this.val).text(this.text));
		});
	}
	if (parseInt(valor) >= 1000001 && parseInt(valor) <= 1500000) {
		var arr = [
			{val : 4, text: '4 meses'},
			{val : 5, text: '5 meses'},
			{val : 6, text: '6 meses'},
			{val : 7, text: '7 meses'},
			{val : 8, text: '8 meses'},
			{val : 9, text: '9 meses'},
			{val : 10, text: '10 meses'},
			{val : 11, text: '11 meses'},
			{val : 12, text: '12 meses'},
			{val : 13, text: '13 meses'},
			{val : 14, text: '14 meses'},
			{val : 15, text: '15 meses'},
			{val : 16, text: '16 meses'},
			{val : 17, text: '17 meses'},
			{val : 18, text: '18 meses'},
			{val : 19, text: '19 meses'},
			{val : 20, text: '20 meses'},
			{val : 21, text: '21 meses'},
			{val : 22, text: '22 meses'},
			{val : 23, text: '23 meses'},
			{val : 24, text: '24 meses'}
		];
		$(arr).each(function() {
			sel.append($("<option>").attr('value',this.val).text(this.text));
		});
	}
}

function calculateValor(valor,meses,tasa) {
	// var capital 		= (parseInt(valor) * 10/100) + parseInt(valor);
	// var interes 		= capital * tasa / 100 * meses;
	// var total 			= parseInt(capital) + parseInt(interes);
	// var resultado 		= parseInt(total) / parseInt(meses);
	var comision 		= parseInt(valor) * 10/100;
	var capital 		= parseInt(valor) + parseInt(comision) + 10000;
	var interes 		= parseInt(capital) * tasa * parseInt(meses);
	var cuota 			= parseInt(capital) + parseInt(interes);
	var resultado 		= parseInt(cuota) / parseInt(meses);
	return resultado.toFixed(0);
}