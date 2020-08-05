<div class="content-wrapper">
  <div class="container-fluid cuadro_panding">
    <div class="bg-white-content">
      <div class="form-group">
        <?php echo $this->Html->link("Listar Usuarios", array('controller' => 'Users','action'=> 'index'), array( 'class' => 'btn btn-secondary pull-right')) ?>
      </div>
      <div class="content-tittles">
        <div class="line-tittles">|</div>
        <div>  
          <h1>Registrar</h1>
          <h2>cliente</h2>
        </div>
      </div>
      <?php echo $this->Form->create('User',array('data-parsley-validate'=>true)); ?>
        <div class="form-group">
          <?php echo $this->Form->input('email',array('label' => 'Correo electrónico','class' => 'form-control','placeholder' => 'Correo electrónico')); ?>
        </div>
        <div class="form-group pb-5">
          <?php echo $this->Form->button('Guardar Cliente',array("class" => "btn btn-success pull-right mb-3")); ?>
        </div>
      </form>
    </div>
  </div>
</div>