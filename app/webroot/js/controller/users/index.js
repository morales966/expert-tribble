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

function buscadorFiltro(){
	var texto 							= $('#txt_buscador').val();
	if (texto != '') {
		var hrefURL 					= copy_js.base_url+copy_js.controller+'/'+copy_js.action;
		var hrefFinal 					= hrefURL+"?q="+texto;
		location.href 					= hrefFinal;
	}
}