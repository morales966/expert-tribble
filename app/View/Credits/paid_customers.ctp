<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">

	</div>
</div>



<!-- <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Finalizado" class="finalizar_credito btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
	<i class="fa fa-step-forward"></i>
</a> -->

<!-- $("body").on("click", ".finalizar_credito", function() {
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
}); -->