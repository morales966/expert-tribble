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
        $('#modalTitleGrande').text('Datos');
    	$('#modalGrande').modal('show');
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

$("body").on("click", ".solicitud_desenbolsar", function() {
    var credit_id           = $(this).data('uid');
    swal({
        title: "¿Estas seguro de solicitar el pago del crédito?",
        text: "¿Deseas continuar con la acción?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonText:"Cancelar",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
    },
    function(){
        $.post(copy_js.base_url+'Credits/solicitudDesenvolver',{credit_id:credit_id}, function(result){
            location.reload();
        });
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