<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content">
			<h2 class="tittle">Perfil de Usuario</h2>
			<?php echo $this->Form->create('User',array('data-parsley-validate'=>true)); ?>
				<div class="form-group row">
					<label for="UserName" class="col-sm-2 col-form-label">Nombre</label>
					<div class="col-sm-10">
						<?php
							echo $this->Form->input('name',array('label' => false,'value' => $user['User']['name'],'class' => 'form-control'));
						?>
					</div>
				</div>
				<div class="form-group row">
					<label for="UserTelephone" class="col-sm-2 col-form-label">Teléfono</label>
					<div class="col-sm-10">
						<?php
							echo $this->Form->input('telephone',array('label' => false,'value' => $user['User']['telephone'],'class' => 'form-control'));
						?>
					</div>
				</div>
				<div class="form-group row">
					<label for="UserRole" class="col-sm-2 col-form-label">Rol</label>
					<div class="col-sm-10">
						<?php
							echo $this->Form->input('role',array('label' => false,'value' => $user['User']['role'],'class' => 'form-control','disabled' => true));
						?>
					</div>
				</div>
				<div class="form-group row">
					<label for="UserEmail" class="col-sm-2 col-form-label">Correo electrónico</label>
					<div class="col-sm-10">
						<?php
							echo $this->Form->input('email',array('label' => false,'value' => $user['User']['email'],'class' => 'form-control','disabled' => true));
						?>
					</div>
				</div>
				<div class="form-group">
		    		<?php echo $this->Form->button('Actualizar',array("class" => "btn btn-success pull-right")); ?>
		        </div>
		    </form>
		    <div class="mb-3 b-block pb-5">	
		    	<a href="javascript:void(0)" data-toggle="modal" data-target="#cambiarContrasenaModal" class="btn-secondary btn pull-right mr-2">Cambiar contraseña</a>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="cambiarContrasenaModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Cambiar contraseña</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form" data-parsley-validate>
					<div class="form-group row">
						<label for="actual" class="col-sm-3 col-form-label">Contraseña actual</label>
						<div class="col-sm-9">
							<?php
								echo $this->Form->input('contrasena_actual',array('label' => false,'type' => 'password','placeholder'  => 'Ingrese la contraseña actual de su cuenta','class' => 'form-control','id' => 'actual','required' => true));
							?>
						</div>
					</div>
					<div class="form-group row">
						<label for="nueva" class="col-sm-3 col-form-label">Contraseña nueva</label>
						<div class="col-sm-9">
							<?php
								echo $this->Form->input('contrasena_nueva',array('label' => false,'type' => 'password','placeholder'  => 'Ingrese la contraseña actual de su cuenta','class' => 'form-control','id' => 'nueva','required' => true));
							?>
						</div>
					</div>
					<div class="form-group row">
						<label for="nueva" class="col-sm-3 col-form-label">Connfirme su nueva contraeña</label>
						<div class="col-sm-9">
							<?php
								echo $this->Form->input('r_nueva',array('label' => false,'type' => 'password','class' => 'form-control','placeholder'  => 'Confirme su nueva contraseña','id' => 'r_nueva','data-parsley-equalto'=>'#nueva','required' => true));
							?>
						</div>
					</div>
				</form>
				<p id="validacion_texto"></p>
			</div>
			<div class="modal-footer">
		        <button type="button" id="btn_cambiar" class="btn btn-primary">Guardar</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		     </div>
		</div>
    </div>
</div>

<?php 
	echo $this->Html->script("controller/users/profile.js?".rand(),						array('block' => 'AppScript'));
?>