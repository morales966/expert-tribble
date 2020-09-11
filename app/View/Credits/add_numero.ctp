<div class="form-group row">
	<label for="nueva" class="col-sm-12 col-form-label">Número comprobante</label>
	<div class="col-md-12">
		<?php
			echo $this->Form->input('cumero_comprobante',array('label' => false,'placeholder'  => 'Número comprobante','class' => 'form-control','id' => 'txt_numero_comprobante'));
		?>
	</div>
	<label for="nueva" class="col-sm-12 col-form-label">Nota</label>
	<div class="col-md-12">
		<?php
			echo $this->Form->input('descripcion',array('label' => false,'placeholder'  => 'Nota','class' => 'form-control','id' => 'txt_nota','type' => 'textarea','rows'=>'3'));
		?>
	</div>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_add_numero_credito","type" => "button",'data-uid'=>$credit_id)); ?>
</div>