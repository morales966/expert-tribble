<div class="row">
    <div class="col-md-7 form-group">
      <?php echo $this->Form->input('name',array('label' => false,'class' => 'form-control','placeholder' => 'Ingrese el código del comercio','id' => 'txt_codigo_negocio')); ?>
    </div>
    <div class="col-md-4 form-group">
      <?php echo $this->Form->button('Buscar comercio',array("type" => "button","class" => "btn btn-success","id" => "btn_buscar_codigo_negocio")); ?>
    </div>
</div>
<div class="form-group">
	<?php
		echo $this->Form->input('monto_deducir',array('label' => false,'type' => 'number','placeholder'  => 'Ingresa el monto a deducir','class' => 'form-control','id' => 'monto_deducir'));
	?>
</div>
<div class="form-group">
	<?php
		echo $this->Form->input('descripcion_deducir',array('label' => false,'placeholder'  => 'Ingresa la descripción del monto a descontar','class' => 'form-control','id' => 'txt_descripcion_deducir','type' => 'textarea','rows'=>'4'));
	?>
</div>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_monto_deducir","type" => "button")); ?>
</div>