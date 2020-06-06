<div class="container">
	<div class="text-center">
		<h1 class="">CREDIVENTAS</h1>
	</div>

	<div class="text-center">
		<h3 class="titleRecordar">Restablecer contraseña <span class="txtSpanPasos">Paso 1</span></h3>
	</div>

	<div class="text-center">
		<?php echo $this->Form->create('User',array('data-parsley-validate'));?>
			<p>Por favor ingresa el correo electrónico</p>
		    <?php echo $this->Form->input('email',array('placeholder' => 'Correo electrónico','label' => false,'class' => 'form-control', 'required' => true)); ?>
   		<?php echo $this->Form->button('Enviar',array("class" => "btn btn-info form-control")); ?>
	</div>
</div>