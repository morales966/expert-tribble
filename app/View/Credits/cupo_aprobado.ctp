<div class="form-group row">
	<label for="nueva" class="col-sm-3 col-form-label">Cupo aprobado</label>
	<div class="col-sm-9">
		<?php
			echo $this->Form->input('cupo_aprobado',array('label' => false,'type' => 'number','placeholder'  => 'Ingresa el cupo aprobado','class' => 'form-control','id' => 'cupo_aprobado'));
		?>
	</div>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_cupo","type" => "button")); ?>
</div>