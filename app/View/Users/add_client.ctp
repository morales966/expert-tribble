<div class="container">
	<?php echo $this->Form->create('User',array('id' => 'formAddCliemt','data-parsley-validate','enctype'=>"multipart/form-data")); ?>
		<div class="row">
			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('nit',array('placeholder' => 'Nit','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('razon_social',array('placeholder' => 'Razón social','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('gremio',array('empty' => 'Selecciona el gremio','options' => $gremio,'label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('administrador',array('placeholder' => 'Administrador','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('cedula',array('placeholder' => 'Cédula','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('direccion',array('placeholder' => 'Dirección','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('barrio',array('placeholder' => 'Barrio','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('municipio',array('placeholder' => 'Municipio','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('telephone',array('placeholder' => 'Teléfono','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('tel_usuario',array('placeholder' => 'Teléfono usuario','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('email',array('placeholder' => 'Correo electrónico','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('banco',array('placeholder' => 'Banco','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('numero_cuenta',array('placeholder' => 'Número de cuenta','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('tipo_cuenta',array('empty' => 'Selecciona el tipo de cuenta','options' => $tipo_cuenta,'label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

			<div class="col-md-6 form-group">
				<?php echo $this->Form->input('nombre_propietario_cuenta',array('placeholder' => 'Nombre del propietario','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-6 form-group">
				<?php echo $this->Form->input('cedula_propietario_cuenta',array('placeholder' => 'Cédula del propietario','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

			<div class="col-md-4 form-group">
				<label class="txtLabelImagenes">Adjunta la cedula, la parte delantera</label>
				<?php echo $this->Form->input('adjuntar_cedula_delantera',array('type' => 'file','label' => false,"class" => "form-control",'required' => true)); ?>
				<span class="txtEndSpan">Max File Size 15MB</span>
			</div>
			<div class="col-md-4 form-group">
				<label class="txtLabelImagenes">Adjunta la cedula, la parte trasera</label>
				<?php echo $this->Form->input('adjuntar_cedula_trasera',array('type' => 'file','label' => false,"class" => "form-control",'required' => true)); ?>
				<span class="txtEndSpan">Max File Size 15MB</span>
			</div>
			<div class="col-md-4 form-group">
				<label class="txtLabelImagenes">Adjunta la camara de comercio</label>
				<?php echo $this->Form->input('adjuntar_camara_comercio',array('type' => 'file','label' => false,"class" => "form-control",'required' => true)); ?>
				<span class="txtEndSpan">Max File Size 15MB</span>
			</div>
			

			<div class="col-md-4 form-group">
				<label class="txtLabelImagenes">Adjunta el RUT</label>
				<?php echo $this->Form->input('adjuntar_rut',array('type' => 'file','label' => false,"class" => "form-control",'required' => true)); ?>
				<span class="txtEndSpan">Max File Size 15MB</span>
			</div>
			<div class="col-md-4 form-group">
				<label class="txtLabelImagenes">Administrador</label>
				<?php echo $this->Form->input('adjuntar_administrador',array('type' => 'file','label' => false,"class" => "form-control",'required' => true)); ?>
				<span class="txtEndSpan">Max File Size 15MB</span>
			</div>
			<div class="col-md-4 form-group">
				<label class="txtLabelImagenes">Almacen</label>
				<?php echo $this->Form->input('adjuntar_almacen',array('type' => 'file','label' => false,"class" => "form-control",'required' => true)); ?>
				<span class="txtEndSpan">Max File Size 15MB</span>
			</div>

			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('ejecutivo',array('empty' => 'Selecciona el ejecutivo','options' => $ejecutivo,'label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('clase',array('empty' => 'Número el plan (clase)','options' => $clase,'label' => false,"class" => "form-control",'required' => true,'id' => 'plan_cliente_val')); ?>
			</div>
			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('como_paga',array('empty' => 'Selecciona como paga','options' => $como_paga,'label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

			<div class="col-md-2 form-group">
				<?php echo $this->Form->input('departamento',array('placeholder' => 'Departamento','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<?php echo $this->Form->input('cantidad_comercios',array('empty' => 'Cantidad de comercios','options' => $cantidad_comercios,'label' => false,"class" => "form-control",'required' => true,'id' => 'cantidad_comercios_val')); ?>
			</div>
			<div class="col-md-3 form-group cuanto_paga">
				<?php echo $this->Form->input('cuanto_paga',array('label' => false,"class" => "form-control",'default' => 'Selecciona cuanto paga','options' => array('Selecciona cuanto paga'))); ?>
			</div>

			<div class="col-md-4 form-group">
				<?php echo $this->Form->input('productos_servicios',array('placeholder' => 'Producto o servicio que ofrece','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

			<div class="col-md-3 form-group">
				<span class="txtEndSpan">Referido 1</span>
				<?php echo $this->Form->input('nombre_completo_r1',array('placeholder' => 'Nombre completo','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<span class="txtEndSpan">Referido 1</span>
				<?php echo $this->Form->input('identificacion_r1',array('placeholder' => 'Identificación','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<span class="txtEndSpan">Referido 1</span>
				<?php echo $this->Form->input('celular_r1',array('placeholder' => 'Teléfono o celular','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<span class="txtEndSpan">Referido 1</span>
				<?php echo $this->Form->input('comercio_r1',array('placeholder' => 'Comercio que posee','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

			<div class="col-md-3 form-group">
				<span class="txtEndSpan">Referido 2</span>
				<?php echo $this->Form->input('nombre_completo_r2',array('placeholder' => 'Nombre completo','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<span class="txtEndSpan">Referido 2</span>
				<?php echo $this->Form->input('identificacion_r2',array('placeholder' => 'Identificación','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<span class="txtEndSpan">Referido 2</span>
				<?php echo $this->Form->input('celular_r2',array('placeholder' => 'Teléfono o celular','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>
			<div class="col-md-3 form-group">
				<span class="txtEndSpan">Referido 2</span>
				<?php echo $this->Form->input('comercio_r2',array('placeholder' => 'Comercio que posee','label' => false,"class" => "form-control",'required' => true)); ?>
			</div>

	        <div class="col-md-12 form-group">
				<label for="UserAccessories">Cuenta con</label>
				<div class="accesorioslist">
					<?php echo $this->Form->select('accessories',$cuenta_con,array('multiple' => 'checkbox'));?>
				</div>
	        </div>

	        <div class="col-md-12 form-group">
		       <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_add_client_save","type" => "button")); ?>
		       <p id="validacion_texto"></p>
	        </div>
	    </div>
	</form>
</div>