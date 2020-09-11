$('body').bind('keypress', function(e) {
    if(e.keyCode == 13){
    	buscadorFiltro();
    }
});

$("body").on("click", ".btn_buscar", function() {
	buscadorFiltro();
});

$("body").on("click", "#texto_busqueda", function() {
	location.href = copy_js.base_url+copy_js.controller+'/'+copy_js.action;
});

$("body").on("click", ".ver_datos_cliente", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/view_user_client',{credit_id:credit_id}, function(result){
        $('#resultModalGrande').html(result);
        $('#modalTitleGrande').text('Datos cliente');
    	$('#modalGrande').modal('show');
    }); 
});

$("body").on("click", ".txt_add_numero", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/add_numero',{credit_id:credit_id}, function(result){
        $('#resultModalGrande').html(result);
        $('#modalTitleGrande').text('Registrar número de comprobante y añadir nota');
        $('#modalGrande').modal('show');
    }); 
});

$("body").on("click", "#btn_add_numero_credito", function() {
    var credit_id            = $(this).data('uid');
    var txt_nota             = $('#txt_nota').val();
    var txt_numero           = $('#txt_numero_comprobante').val();
    $.post(copy_js.base_url+'Credits/addNumeroComprobanteNota',{credit_id:credit_id,txt_nota:txt_nota,txt_numero:txt_numero}, function(result){
        location.reload();
    });
});

$("body").on("click", ".finalizar_credito", function() {
    var credit_id           = $(this).data('uid');
    swal({
        title: "¿Estas seguro de finalizar el crédito?",
        text: "¿Deseas continuar con la acción?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonText:"Cancelar",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
    },
    function(){
        $.post(copy_js.base_url+'Credits/finalizarCredito',{credit_id:credit_id}, function(result){
            location.reload();
        });
    });
});

$("body").on("click", ".rechazar_credito", function() {
    var credit_id           = $(this).data('uid');
    swal({
        title: "¿Estas seguro de rechazar el crédito?",
        text: "¿Deseas continuar con la acción?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonText:"Cancelar",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
    },
    function(){
        $.post(copy_js.base_url+'Credits/rechazarCredito',{credit_id:credit_id}, function(result){
            location.reload();
        });
    });
});

$("body").on("click", ".ver_credito", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/view_modal',{credit_id:credit_id}, function(result){
        $('#resultModalGrande').html(result);
        $('#modalTitleGrande').text('Información del Crédito');
    	$('#modalGrande').modal('show');
    }); 
});

$("body").on("click", ".datos_banco_cliente", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/ver_datos_banco_cliente',{credit_id:credit_id}, function(result){
        $('#resultModalGrande').html(result);
        $('#modalTitleGrande').text('Información del banco del cliente');
        $('#modalGrande').modal('show');
    }); 
});

function buscadorFiltro() {
	var texto 							= $('#txt_buscador').val();
	if (texto != '') {
		var hrefURL 						= copy_js.base_url+copy_js.controller+'/'+copy_js.action;
		var hrefFinal 						= hrefURL+"?q="+texto;
		location.href 						= hrefFinal;
	}
}