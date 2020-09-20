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

$("body").on("click", ".ver_deducion", function() {
    var user_id       = $(this).data('user');
    $.post(copy_js.base_url+'Credits/ver_deduciones',{user_id:user_id}, function(result){
        $('#resultModalGrande').html(result);
        $('#modalTitleGrande').text('Deducciones');
        $('#modalGrande').modal('show');
    }); 
});

$("body").on("click", ".ver_datos_cliente", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/view_user_client',{credit_id:credit_id}, function(result){
        $('#resultModalGrande').html(result);
        $('#modalTitleGrande').text('Datos cliente');
    	$('#modalGrande').modal('show');
    }); 
});

$("body").on("click", ".add_monto_deducir", function() {
    $.post(copy_js.base_url+'Credits/add_monto_reducir',{}, function(result){
        $('#resultModalCancelar').html(result);
        $('#modalTitleCancelar').text('Registrar monto a deducir');
        $('#modalSessionCancelar').modal('show');
        $('#btn_monto_deducir').hide();
    });
});

$("body").on( "click", "#btn_buscar_codigo_negocio", function() {
    var txt_codigo                 = $('#txt_codigo_negocio').val();
    if (txt_codigo == "") {
        message_alert("Por favor ingresa el código del comercio","Error");
    } else {
        $.post(copy_js.base_url+'Users/find_code_clients_deducir',{txt_codigo:txt_codigo}, function(result){
            if (result == 0) {
                message_alert("Por favor valida el código ya que no se encuentra un cliente asociado","Error");
            } else {
                message_alert("Se ha encontrado un comercio asociado al código ingresado","Bien");
                $('#txt_codigo_negocio').val(result);
                $('#txt_codigo_negocio').prop('readonly', true);
                $("#btn_buscar_codigo_negocio").hide();
                $('#btn_monto_deducir').show();
            }
        });
    }
});

$("body").on("click", "#btn_monto_deducir", function() {
    var user_id                         = $('#txt_codigo_negocio').val();
    var monto_deducir                   = $('#monto_deducir').val();
    var txt_descripcion_deducir         = $('#txt_descripcion_deducir').val();
    $.post(copy_js.base_url+'Credits/addMontoReducir',{user_id:user_id,monto_deducir:monto_deducir,txt_descripcion_deducir:txt_descripcion_deducir}, function(result){
        location.reload();
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


$("body").on("click", ".eliminar_deduccion", function() {
    var deduccion_id           = $(this).data('uid');
    swal({
        title: "¿Estas seguro de eliminar la deducción?",
        text: "¿Deseas continuar con la acción?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonText:"Cancelar",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
    },
    function(){
        $.post(copy_js.base_url+'Credits/eliminarDeduccion',{deduccion_id:deduccion_id}, function(result){
            location.reload();
        });
    });
});

$("body").on("click", ".actualizar_deducion", function() {
    location.reload();
});

$("body").on("click", ".finalizar_credito", function() {
    var credit_id           = $(this).data('uid');
    var user_id             = $(this).data('user');
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
        $.post(copy_js.base_url+'Credits/finalizarCredito',{credit_id:credit_id,user_id:user_id}, function(result){
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