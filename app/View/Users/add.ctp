<div class="content-wrapper">
  <div class="container">
    <h1 class="txtDatosVista">Registrar Usuario</h1>


    <?php echo $this->Form->create('User',array('data-parsley-validate'=>true)); ?>
      <div class="form-group">
        <?php echo $this->Form->input('name',array('label' => 'Nombre','class' => 'form-control','placeholder' => 'Nombre')); ?>
      </div>
      <div class="form-group">
        <?php echo $this->Form->input('email',array('label' => 'Correo eléctronico','class' => 'form-control','placeholder' => 'Correo eléctronico')); ?>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <?php echo $this->Form->input('telephone',array('label' => 'Teléfono','class' => 'form-control','placeholder' => 'Teléfono'));?>
        </div>
        <div class="form-group col-md-6">
          <?php echo $this->Form->input('role',array('label' => 'Rol','class' => 'form-control','options' => $roles,'empty' => 'Selecciona el rol'));?>
        </div>
      </div>


      <div class="form-group">
        <?php echo $this->Form->button('Actualizar',array("class" => "btn btn-info form-control")); ?>
      </div>
  </form>


  </div>
</div>