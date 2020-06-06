<div class="container">
	<div class="text-center">
		<h1 class="">CREDIVENTAS</h1>
	</div>

	<div class="text-center">
		<h3 class="titleRecordar">Restablecer contraseña <span class="txtSpanPasos">Paso 2</span></h3>
	</div>

	<div class="text-center">
		<?php echo $this->Form->create('User',array('data-parsley-validate'));?>
			<?php echo $this->Form->input('hash',array('value' => $hash,'type' => 'hidden')); ?>
			<?php echo $this->Form->input('password',array('label' => false,'placeholder' => 'Nueva contraseña','type' => 'password','class' => 'form-control','required' => true));?>
			<?php echo $this->Form->input('re_password',array('label' => false,'placeholder' => 'Confirmar nueva contraseña','type' => 'password','class' => 'form-control','data-parsley-equalto'=>'#UserPassword','required' => true));?>
   		<?php echo $this->Form->button('Actualizar',array("class" => "btn btn-info form-control")); ?>
	</div>
</div>