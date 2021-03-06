<div class="content-wrapper">
  <div class="container-fluid cuadro_panding">
  <div class="bg-white-content">
    <div class="form-group">
      <?php echo $this->Html->link("Atras", array('controller' => 'Users','action'=> 'index'), array( 'class' => 'btn btn-secondary pull-right')) ?>
    </div>
      <div class="content-tittles">
        <div class="line-tittles">|</div>
        <div>  
          <h1>Registrar</h1>
          <h2>Usuarios</h2>
        </div>
      </div>
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


      <div class="form-group pb-5">
        <?php echo $this->Form->button('Guardar Usuario',array("class" => "btn btn-success pull-right mb-3")); ?>
      </div>
  </form>

  </div>
  </div>
</div>