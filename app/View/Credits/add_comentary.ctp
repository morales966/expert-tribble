<div class="form-group row">
	<label for="nueva" class="col-sm-12 col-form-label">Descripción</label>
	<div class="col-sm-12">
		<?php
			echo $this->Form->input('descripcion',array('label' => false,'placeholder'  => 'Ingresa la descripción','class' => 'form-control','id' => 'txt_descripcion','type' => 'textarea','rows'=>'4'));
		?>
	</div>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_comentary","type" => "button",'data-uid'=>$credit_id)); ?>
</div>