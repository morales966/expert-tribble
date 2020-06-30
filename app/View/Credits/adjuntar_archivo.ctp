<form id="form_adjuntar_plan" enctype="multipart/form-data")>
	<div class="form-group">
		<?php echo $this->Form->hidden('id',array('label' => false,'class' => 'form-control','value' => $credit_id)); ?>
		<?php echo $this->Form->input('adjuntar_archivo',array('type' => 'file','label' => false,'class' => 'form-control','id' => 'txt_plan_pagos')); ?>
	</div>
</form>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_adjuntar_archivo","type" => "button")); ?>
</div>