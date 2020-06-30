<div class="input-group">
   	<input class="form-control" type="number" id="txt_cupo_aprobado" value="<?php echo $cupo_aprobado['Credit']['cupo_aprobado'] ?>" disabled>
   	<span class="input-group-btn">
    	<button class="btn btn-default" type="button" title="Editar" id="icono_edit_cupo">
    		<i class="fa fa-edit"></i>
    	</button>
   	</span>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_cupo_edit","type" => "button","data-uid" => $credit_id)); ?>
</div>