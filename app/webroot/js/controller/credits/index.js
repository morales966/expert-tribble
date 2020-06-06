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








$(function () {
    var kanbanCol = $('.panel-body');
    kanbanCol.css('max-height', (window.innerHeight - 150) + 'px');

    var kanbanColCount = parseInt(kanbanCol.length);
    $('.container-fluid').css('min-width', (kanbanColCount * 350) + 'px');

    draggableInit();

    $('.panel-heading').click(function() {
        var $panelBody = $(this).parent().children('.panel-body');
        $panelBody.slideToggle();
    });
});

function draggableInit() {
    var sourceId;

    $('[draggable=true]').bind('dragstart', function (event) {
        sourceId = $(this).parent().attr('id');
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });

    $('.panel-body').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle'); //before post


            // Post data 
            setTimeout(function () {
                var element = document.getElementById(elementId);
                children.prepend(element);
                $('#processing-modal').modal('toggle'); // after post
            }, 1000);

        }

        event.preventDefault();
    });
}
