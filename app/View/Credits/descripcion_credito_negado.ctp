<div class="form-group">
	<?php echo $this->Form->input('descripcion',array('label' => 'Por favor selecciona la razón por la cual fue rechazado','class' => 'form-control','default' => 'Introduc primero el valor que necesitas','options' =>  $opciones_negado,'id' => 'txt_descripcion')); ?>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_descripcion","type" => "button")); ?>
</div>