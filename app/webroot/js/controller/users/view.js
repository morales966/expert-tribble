$('body').bind('keypress', function(e) {
    if(e.keyCode == 13){
    	buscadorFiltro();
    }
});

$("body").on("click", ".btn_buscar", function() {
	buscadorFiltro();
});

$("body").on("click", "#texto_busqueda", function() {
	const el 							= document.querySelector('#tittle_user_id');
	var user_id 						= el.dataset.uid;
	location.href = copy_js.base_url+copy_js.controller+'/'+copy_js.action+'/'+user_id;
});

function buscadorFiltro() {
	const el 							= document.querySelector('#tittle_user_id');
	var user_id 						= el.dataset.uid;
	var texto 							= $('#txt_buscador').val();
	if (texto != '') {
		var hrefURL 						= copy_js.base_url+copy_js.controller+'/'+copy_js.action+'/'+user_id;
		var hrefFinal 						= hrefURL+"?q="+texto;
		location.href 						= hrefFinal;
	}
}