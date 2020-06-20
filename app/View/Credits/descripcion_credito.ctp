<div class="form-group row">
	<label for="nueva" class="col-sm-3 col-form-label">Descripción</label>
	<div class="col-sm-9">
		<?php
			echo $this->Form->input('descripcion',array('label' => false,'type' => 'number','placeholder'  => 'Ingresa la descripción','class' => 'form-control','id' => 'txt_descripcion','type' => 'textarea','rows'=>'5'));
		?>
	</div>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_descripcion","type" => "button")); ?>
</div>