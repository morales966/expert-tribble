$(function () {
    total_estados();
    validar_articulos();
    draggableInit();
    setTimeout(function () {
        $('#processing-modal').modal('toggle');
    }, 1000);
});

function total_estados() {
    $('#processing-modal').modal('toggle');

    $.post(copy_js.base_url+'Credits/sumTotalStateSolicitado',{}, function(result){
        $('#total_solicitud').text(result);
    });
    $.post(copy_js.base_url+'Credits/sumTotalStateEstudio',{}, function(result){
        $('#total_estudio').text(result);
    });
    $.post(copy_js.base_url+'Credits/sumTotalStateDetenido',{}, function(result){
        $('#total_detenido').text(result);
    });
    return true;
}

function validar_articulos() {
    var txt1 = "<br><br><br><br><br><br><br>";
    if($('#DOING10').find('br').length < 1 ) {
        $('#DOING10').append(txt1);
    }
    if($('#DOING20').find('br').length < 1 ) {
        $('#DOING20').append(txt1);
    }
    if($('#DOING30').find('br').length < 1 ) {
        $('#DOING30').append(txt1);
    }
    if($('#DOING40').find('br').length < 1 ) {
        $('#DOING40').append(txt1);
    }
    if($('#DOING50').find('br').length < 1 ) {
        $('#DOING50').append(txt1);
    }
    return true;
}

function draggableInit() {
    var sourceId;
    $('[draggable=true]').bind('dragstart', function (event) {
        sourceId = $(this).parent().attr('id');
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });

    $('.panel-body_solicitud').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body_solicitud').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle');

            setTimeout(function () {
                console.log('Solicitud');
                var element = document.getElementById(elementId);
                children.prepend(element);
                total_estados();
            }, 1000);
            setTimeout(function () {
                validar_articulos();
                $('#processing-modal').modal('toggle');
            }, 2000);
        }
        event.preventDefault();
    });

    $('.panel-body_estudio').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body_estudio').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle');

            setTimeout(function () {
                console.log('En estudio');
                var element = document.getElementById(elementId);
                children.prepend(element);
                total_estados();
            }, 1000);
            setTimeout(function () {
                validar_articulos();
                $('#processing-modal').modal('toggle');
            }, 2000);
        }
        event.preventDefault();
    });

    $('.panel-body_detenido').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body_detenido').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle');

            setTimeout(function () {
                console.log('Detenido');
                var element = document.getElementById(elementId);
                children.prepend(element);
                total_estados();
            }, 1000);
            setTimeout(function () {
                validar_articulos();
                $('#processing-modal').modal('toggle');
            }, 2000);
        }
        event.preventDefault();
    });

    $('.panel-body_aprobado-no-retirado').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body_aprobado-no-retirado').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle');

            setTimeout(function () {
                console.log('Aprobado no retirado');
                var element = document.getElementById(elementId);
                children.prepend(element);
                total_estados();
            }, 1000);
            setTimeout(function () {
                validar_articulos();
                $('#processing-modal').modal('toggle');
            }, 2000);
        }
        event.preventDefault();
    });

    $('.panel-body_aprobado-retirado').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body_aprobado-retirado').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle');

            setTimeout(function () {
                console.log('Aprobado, retirado');
                var element = document.getElementById(elementId);
                children.prepend(element);
                total_estados();
            }, 1000);
            setTimeout(function () {
                validar_articulos();
                $('#processing-modal').modal('toggle');
            }, 2000);
        }
        event.preventDefault();
    });
    return true;
}