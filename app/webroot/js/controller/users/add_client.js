$("body").on("change", "#plan_cliente_val", function() {
	var plan_cliente_val 				= $('#plan_cliente_val').val();
	if (plan_cliente_val == '') {
		$('.cuanto_paga').empty();
		var sel = $('<select class="form-control" id="cuanto_paga_val" name="cuanto_paga">').appendTo('.cuanto_paga');
	} else {
		calculateValor();
	}
});

$("body").on("change", "#cantidad_comercios_val", function() {
	calculateValor();
});

function calculateValor() {
	var plan_cliente_val 				= $('#plan_cliente_val').val();
	var cantidad_comercios_val 			= $('#cantidad_comercios_val').val();
	var resultado 						= parseInt(plan_cliente_val) * parseInt(cantidad_comercios_val);
	$('.cuanto_paga').empty();
	if (plan_cliente_val == '' || cantidad_comercios_val == '') {
		var sel = $('<select class="form-control" id="cuanto_paga_val" name="cuanto_paga">').appendTo('.cuanto_paga');
	} else {
		var sel = $('<select class="form-control" id="cuanto_paga_val" name="cuanto_paga">').appendTo('.cuanto_paga');
		var arr = [
			{val : resultado, text: resultado}
		];
		$(arr).each(function() {
			sel.append($("<option>").attr('value',this.val).text(this.text));
		});
	}
}