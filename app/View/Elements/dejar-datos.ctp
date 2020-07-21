<div class="form-group">
  <label class="text-white" for="">Nombre Completo</label>
  <?php echo $this->Form->input('name',array('label' => false,'class' => 'form-control form-control-lg','placeholder' => 'Ingresa tu nombre','required' => true)); ?>
</div>
<div class="form-group">
  <label class="text-white" for="">Número de Contacto</label>
  <?php echo $this->Form->input('telephone',array('label' => false,'type' => 'number','class' => 'form-control form-control-lg','placeholder' => 'Ingresa tu número para contactarte','required' => true)); ?>
</div>
<div class="form-group">
  <label class="text-white" for="">Correo electrónico</label>
  <?php echo $this->Form->input('email',array('label' => false,'type' => 'email','class' => 'form-control form-control-lg','placeholder' => 'Ingresa tu correo electrónico','required' => true)); ?>
</div>
<div class="form-group">
  <label class="text-white" for="">Establecimiento</label>
  <?php 
    echo $this->Form->input('establishment',array('label' => false,'class' => 'form-control form-control-lg','placeholder' => 'Cómo se llama tu establecimiento','required' => true)); 
  ?>
</div>