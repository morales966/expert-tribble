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
    	$('#modalGrande').modal('show');
    }); 
});

$("body").on("click", ".ver_credito", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/view_modal',{credit_id:credit_id}, function(result){
        $('#resultModalGrande').html(result);
    	$('#modalGrande').modal('show');
    }); 
});

$("body").on("click", ".datos_banco_cliente", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/ver_datos_banco_cliente',{credit_id:credit_id}, function(result){
        $('#resultModalGrande').html(result);
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