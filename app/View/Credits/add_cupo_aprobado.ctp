<div class="form-group">
	<?php
		echo $this->Form->input('cupo_aprobado',array('label' => false,'type' => 'number','placeholder'  => 'Ingresa el cupo aprobado','class' => 'form-control','id' => 'cupo_aprobado','min' => '50000','max' => '1500000'));
	?>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_cupo","type" => "button")); ?>
</div>