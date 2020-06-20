$(function () {
    $('#processing-modal').modal('toggle');
    total_estados();
    validar_articulos();
    draggableInit();
    setTimeout(function () {
        $('#processing-modal').modal('toggle');
    }, 1000);
});

$("body").on("click", ".ver_asesor", function() {
    var user_asesor       = $(this).data('asesor');
    $.post(copy_js.base_url+'Credits/find_asesor_estudio',{user_asesor:user_asesor}, function(result){
        $('#resultModal').html(result);
        $('#modalTitle').text('Asesor');
        $('#modalSession').modal('show');
    }); 
});

$("body").on("click", ".ver_cupo_aprobado", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/ver_cupo_aprobado',{credit_id:credit_id}, function(result){
        $('#resultModal').html(result);
        $('#modalTitle').text('Cupo aprobado');
        $('#modalSession').modal('show');
    }); 
});

$("body").on("click", ".btn_comentario", function() {
    var credit_id       = $(this).data('uid');
    $('#modalTitle').text('Añadir comentario');
    $('#modalSessionCancelar').modal('show');
});

$("body").on("click", ".ver_causa_negacion", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/ver_descripcion_credito',{credit_id:credit_id}, function(result){
        $('#resultModal').html(result);
        $('#modalTitle').text('Causa de negación');
        $('#modalSession').modal('show');
    }); 
});


function total_estados() {
    $('#txt_cantidad_solicitud').text('Cantidad: '+$('#DOING10').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalStateSolicitado',{}, function(result){
        $('#total_solicitud').text(result);
    });
    $('#txt_cantidad_estudio').text('Cantidad: '+$('#DOING20').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalStateEstudio',{}, function(result){
        $('#total_estudio').text(result);
    });
    $('#txt_cantidad_detenido').text('Cantidad: '+$('#DOING30').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalStateDetenido',{}, function(result){
        $('#total_detenido').text(result);
    });

    $('#txt_cantidad_aprobado_no_retirado').text('Cantidad: '+$('#DOING40').find('article').length);
    $('#txt_cantidad_aprobado_retirado').text('Cantidad: '+$('#DOING50').find('article').length);
    $('#txt_cantidad_negado').text('Cantidad: '+$('#DOING0').find('article').length);
    return true;
}

function validar_articulos() {
    var txt1 = "<br><br><br><br><br><br>";
    if ($('#DOING10').find('article').length > 0) {
        $('br').remove();
    }
    if ($('#DOING20').find('article').length > 0) {
        $('br').remove();
    }
    if ($('#DOING30').find('article').length > 0) {
        $('br').remove();
    }
    if ($('#DOING40').find('article').length > 0) {
        $('br').remove();
    }
    if ($('#DOING50').find('article').length > 0) {
        $('br').remove();
    }
    if ($('#DOING0').find('article').length > 0) {
        $('br').remove();
    }
    if($('#DOING10').find('article').length < 1) {
        $('#DOING10').append(txt1);
    }
    if($('#DOING20').find('article').length < 1) {
        $('#DOING20').append(txt1);
    }
    if($('#DOING30').find('article').length < 1) {
        $('#DOING30').append(txt1);
    }
    if($('#DOING40').find('article').length < 1) {
        $('#DOING40').append(txt1);
    }
    if($('#DOING50').find('article').length < 1) {
        $('#DOING50').append(txt1);
    }
    if($('#DOING0').find('article').length < 1) {
        $('#DOING0').append(txt1);
    }
    return true;
}

function draggableInit() {
    var sourceId;
    var credit_id;
    console.log('ssss');
    $('[draggable=true]').bind('dragstart', function (event) {
        sourceId = $(this).parent().attr('id');
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
        credit_id       = $(this).data('uid');
    });
    $('.panel-body_solicitud').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body_solicitud').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');
        if (sourceId != targetId) {
            message_alert("Por favor valida, no puedes volver a poner el credito en estado de solicitud","Error");
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
            var elementId           = event.originalEvent.dataTransfer.getData("text/plain");
            var element             = document.getElementById(elementId);
            $('#processing-modal').modal('toggle');
            children.prepend(element);
            var cupo_aprobado      = 0;
            var txt_descripcion    = '';
            setTimeout(function () {
                progreso(credit_id,cupo_aprobado,txt_descripcion,copy_js.state_credito_id_estudio);
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
            var elementId           = event.originalEvent.dataTransfer.getData("text/plain");
            var element             = document.getElementById(elementId);
            $('#processing-modal').modal('toggle');
            children.prepend(element);
            var cupo_aprobado      = 0;
            var txt_descripcion    = '';
            progreso(credit_id,cupo_aprobado,txt_descripcion,copy_js.state_credito_id_detenido);
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
            $.post(copy_js.base_url+'Credits/cupo_aprobado',{}, function(result){
                $('#resultModalCancelar').html(result);
                $('#modalTitleCancelar').text('Cupo aprobado');
                $('#modalSessionCancelar').modal('show');
            });
            $("body").on("click", "#btn_cupo", function() {
                var cupo_aprobado       = $('#cupo_aprobado').val();
                $('#modalSessionCancelar').modal('hide');
                $('#resultModalCancelar').empty();
                $('#processing-modal').modal('toggle');
                var txt_descripcion    = '';
                progreso(credit_id,cupo_aprobado,txt_descripcion,copy_js.state_credito_id_aprobadoNoRetirado);
            });
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
            var elementId           = event.originalEvent.dataTransfer.getData("text/plain");
            var element             = document.getElementById(elementId);
            $('#processing-modal').modal('toggle');
            children.prepend(element);
            var cupo_aprobado      = 0;
            var txt_descripcion    = '';
            progreso(credit_id,cupo_aprobado,txt_descripcion,copy_js.state_credito_id_aprobadoRetirado);
        }
        event.preventDefault();
    });

    $('.panel-body_negado').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body_negado').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');
        if (sourceId != targetId) {
            $.post(copy_js.base_url+'Credits/descripcion_credito',{}, function(result){
                $('#resultModalCancelar').html(result);
                $('#modalTitleCancelar').text('Causa de negación');
                $('#modalSessionCancelar').modal('show');
            });
            $("body").on("click", "#btn_descripcion", function() {
                var txt_descripcion      = $('#txt_descripcion').val();
                $('#modalSessionCancelar').modal('hide');
                $('#resultModalCancelar').empty();
                $('#processing-modal').modal('toggle');
                var cupo_aprobado       = 0;
                progreso(credit_id,cupo_aprobado,txt_descripcion,copy_js.state_credito_id_negado);
            });
        }
        event.preventDefault();
    });
    return true;
}

function progreso(credit_id,cupo_aprobado,descripcion,state) {
    setTimeout(function () {
    //     alert(credit_id);
    //     alert(cupo_aprobado);
    //     alert(descripcion);
    //     alert(state);

        $.post(copy_js.base_url+'Credits/updateState',{credit_id:credit_id,cupo_aprobado:cupo_aprobado,descripcion:descripcion,state:state}, function(result){
            if (result == 2) {
                message_alert("Por favor valida, el credito ya tiene asesor","Error");
            }
            $.post(copy_js.base_url+'Credits/view_creditos',{}, function(result){
                $('#container_creditos').empty();
                $('#container_creditos').html(result);
            });
        });
    }, 1000);

    setTimeout(function () {
        total_estados();
        validar_articulos();
        $('[data-toggle="tooltip"]').tooltip();
        draggableInit(); 
        $('#processing-modal').modal('toggle');
    }, 8000);
}