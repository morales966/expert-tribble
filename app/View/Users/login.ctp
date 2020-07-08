<div id="login">
    <div class="container">
    	<?php echo $this->Form->create('User',array('id' => 'formLogin','data-parsley-validate')); ?>
            <div class="form-group">
    			<?php echo $this->Form->input('email',array('type' => 'text','placeholder' => 'Ingrese su correo electrónico','label' => 'Correo electrónico',"class" => "form-control",'required' => true)); ?>
            </div>
            <div class="form-group">
    			<?php echo $this->Form->input('password',array('placeholder' => '**********','label' => 'Contraseña',"class" => "form-control",'required' => true)); ?>
            </div>
            <div class="form-group">
    	       <?php echo $this->Form->button('Ingresar',array("class" => "btn btn-info form-control","id" => "btn_login_app","type" => "button")); ?>
            </div>
            <p id="validacion_texto"></p>
        </form>
        <a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'remember_password')) ?>">Restablecer contraseña</a>
    </div>
</div>