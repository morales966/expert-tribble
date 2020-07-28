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
        $('#btn_cupo_edit').hide();
        $('#modalTitle').text('Cupo aprobado');
        $('#modalSession').modal('show');
    }); 
});
$("body").on("click", "#icono_edit_cupo", function() {
    $('#txt_cupo_aprobado').prop('disabled', false);
    $('#btn_cupo_edit').show();
});
$("body").on("click", "#btn_cupo_edit", function() {
    var credit_id           = $(this).data('uid');
    var cupo_aprobado       = $('#txt_cupo_aprobado').val();
    $.post(copy_js.base_url+'Credits/editCupoAprobado',{credit_id:credit_id,cupo_aprobado:cupo_aprobado}, function(result){
        $('#btn_cupo_edit').hide();
        $('#modalSession').modal('hide');
        total_estados();
        message_alert("Se actualizó el cupo del crédito correctamente","Bien");
    });
});

$("body").on("click", ".ver_preaprobado", function() {
    var credit_id           = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/ver_preaprobado',{credit_id:credit_id}, function(result){
        $('#resultModal').html(result);
        $('#modalTitle').text('Pre Aprobado');
        $('#modalSession').modal('show');
    }); 
});

$("body").on("click", ".adjuntar_plan_pago", function() {
    var credit_id           = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/adjuntar_archivo',{credit_id:credit_id}, function(result){
        $('#resultModalCancelar').html(result);
        $('#modalTitleCancelar').text('Adjuntar plan de pagos');
        $('#modalSessionCancelar').modal('show');
    }); 
});

$("body").on("click", "#btn_adjuntar_archivo", function() {
    var plan_pagos             = $('#txt_plan_pagos').val();
    if (plan_pagos != '') {
        var formData               = new FormData($('#form_adjuntar_plan')[0]);
        $.ajax({
            type: 'POST',
            url: copy_js.base_url+copy_js.controller+'/adjuntarPlanPago',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                $('#modalSessionCancelar').modal('hide');
                $('#resultModalCancelar').empty();
                 message_alert("Se adjunto el plan de pagos correctamente","Bien");
            }
        });
    } else {
        message_alert("Por favor adjunta el plan de pagos","Error");
    }
});

$("body").on("click", ".registrar_cupo_aprobado", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/add_retiro_cupo_aprobado',{credit_id:credit_id}, function(result){
        $('#resultModalCancelar').html(result);
        $('#modalTitleCancelar').text('Registrar un retiro del crédito aprobado');
        $('#modalSessionCancelar').modal('show');
    }); 
});

$("body").on("click", "#btn_add_retiro_cupo", function() {
    var credit_id              = $(this).data('uid');
    var txt_cupo_aprobado      = $('#txt_cupo_aprobado').val();
    if (txt_cupo_aprobado != '') {
        $.post(copy_js.base_url+'Credits/addRetiroCupo',{credit_id:credit_id,txt_cupo_aprobado:txt_cupo_aprobado}, function(result){
            $('#modalSessionCancelar').modal('hide');
            $('#resultModalCancelar').empty();
            message_alert("Se registro un retiro del cupo correctamente","Bien");
        });
    } else {
        message_alert("Por favor ingresa el valor del retiro","Error");
    }
});

$("body").on("click", ".btn_mensaje_texto", function() {
    var credit_id       = $(this).data('uid');
    $('#resultModal').html('<p>Estamos trabajando en la funcionalidad</p>');
    $('#modalTitle').text('Mensaje de texto');
    $('#modalSession').modal('show');
});

$("body").on("click", ".btn_comentario", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/add_comentary',{credit_id:credit_id}, function(result){
        $('#resultModalCancelar').html(result);
        $('#modalTitleCancelar').text('Añadir comentario');
        $('#modalSessionCancelar').modal('show');
    }); 
});

$("body").on("click", "#btn_comentary", function() {
    var credit_id            = $(this).data('uid');
    var txt_descripcion      = $('#txt_descripcion').val();
    if (txt_descripcion != '') {
        $.post(copy_js.base_url+'Credits/addComentary',{credit_id:credit_id,txt_descripcion:txt_descripcion}, function(result){
            $('#modalSessionCancelar').modal('hide');
            $('#resultModalCancelar').empty();
        });
    } else {
        message_alert("Por favor ingresa algún comentario","Error");
    }
});

function total_estados() {
    $('#txt_cantidad_solicitud').text($('#DOING10').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalStateSolicitado',{}, function(result){
        $('#total_solicitud').text(result);
    });
    $('#txt_cantidad_estudio').text($('#DOING20').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalStateEstudio',{}, function(result){
        $('#total_estudio').text(result);
    });
    $('#txt_cantidad_detenido').text($('#DOING30').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalStateDetenido',{}, function(result){
        $('#total_detenido').text(result);
    });
    $('#txt_cantidad_aprobado_no_retirado').text($('#DOING40').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalValorAprobadoStateAprobadoNoRetirado',{}, function(result){
        $('#total_aprobado_no_retirado').text(result);
    });
    $('#txt_cantidad_aprobado_retirado').text($('#DOING50').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalValorAprobadoStateAprobadoRetirado',{}, function(result){
        $('#total_aprobado_retirado').text(result);
    });
    $('#txt_cantidad_negado').text($('#DOING0').find('article').length);
    $.post(copy_js.base_url+'Credits/sumTotalStateNegado',{}, function(result){
        $('#total_negado').text(result);
    });
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
            message_alert("Por favor valida, no puedes volver a poner el creéito en estado de solicitud","Error");
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
            $.post(copy_js.base_url+'Credits/add_cupo_aprobado',{}, function(result){
                $('#resultModalCancelar').html(result);
                $('#modalTitleCancelar').text('Cupo aprobado');
                $('#modalSessionCancelar').modal('show');
            });
            $("body").on("click", "#btn_cupo", function() {
                var cupo_aprobado       = $('#cupo_aprobado').val();
                if (parseInt(cupo_aprobado) > 1500000 || parseInt(cupo_aprobado) < 50000) {
                    message_alert("Por favor valida el valor del cupo aprobado","Error");
                } else {
                    $('#modalSessionCancelar').modal('hide');
                    $('#resultModalCancelar').empty();
                    $('#processing-modal').modal('toggle');
                    var txt_descripcion    = '';
                    progreso(credit_id,cupo_aprobado,txt_descripcion,copy_js.state_credito_id_aprobadoNoRetirado);
                }
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
            $.post(copy_js.base_url+'Credits/descripcion_credito_negado',{}, function(result){
                $('#resultModalCancelar').html(result);
                $('#modalTitleCancelar').text('Causa de negación');
                $('#modalSessionCancelar').modal('show');
            });
            $("body").on("click", "#btn_descripcion", function() {
                var txt_descripcion      = $('#txt_descripcion').val();
                $('#modalSessionCancelar').modal('hide');
                $('#resultModalCancelar').empty();
                $('#processing-modal').modal('toggle');
                var cupo_aprobado        = 0;
                progreso(credit_id,cupo_aprobado,txt_descripcion,copy_js.state_credito_id_negado);
            });
        }
        event.preventDefault();
    });
    return true;
}

$("body").on("click", ".ver_credito", function() {
    var credit_id       = $(this).data('uid');
    $.post(copy_js.base_url+'Credits/view_modal',{credit_id:credit_id}, function(result){
        $('#resultModalGrande').html(result);
        $('#modalGrande').modal('show');
    }); 
});

$('body').bind('keypress', function(e) {
    if(e.keyCode == 13){
        e.preventDefault();
    }
});

function progreso(credit_id,cupo_aprobado,descripcion,state) {
    setTimeout(function () {
        $.post(copy_js.base_url+'Credits/updateState',{credit_id:credit_id,cupo_aprobado:cupo_aprobado,descripcion:descripcion,state:state}, function(result){
            if (result == 2) {
                message_alert("Por favor valida, el crédito ya tiene asesor","Error");
            }
            $.post(copy_js.base_url+'Credits/view_creditos',{}, function(result){
                $('#container_creditos').empty();
                $('#container_creditos').html(result);
            });
        });
    }, 1000);

    setTimeout(function () {
        // total_estados();
        // validar_articulos();
        // $('[data-toggle="tooltip"]').tooltip();
        // draggableInit(); 
        // $('#processing-modal').modal('toggle');
        location.reload();
    }, 5000);
}