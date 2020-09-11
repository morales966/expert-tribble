<div class="form-group">
	<?php
		echo $this->Form->input('cupo_aprobado',array('label' => false,'type' => 'number','placeholder'  => 'Ingresa el retiro que realizó el cliente','class' => 'form-control','id' => 'txt_cupo_aprobado','max' => $cupo_aprobado['Credit']['cupo_aprobado']-$valor_retiro[0]['total'],'value' => $cupo_aprobado['Credit']['cupo_aprobado']-$valor_retiro[0]['total'],'min' => '0'));
	?>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_add_retiro_cupo","type" => "button",'data-uid'=>$credit_id,'data-max' => $cupo_aprobado['Credit']['cupo_aprobado']-$valor_retiro[0]['total'])); ?>
</div>