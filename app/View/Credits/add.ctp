<div class="content-wrapper">
	<div class="container cuadro_panding">
		<h1 class="titleTable">Solicitar crédito</h1>
		<p class="tittleEnlace">
			<a href="<?php echo $this->Html->url(array('action'=>'index')) ?>">Listar créditos</a>
		</p>
		<?php echo $this->Form->create('Credit',array('data-parsley-validate','enctype'=>"multipart/form-data")); ?>
			<p class="txtDerecho">Crediventas te ofrece la opción de solicitar un crédito Tradicional.</p>
			<div class="border_cuadro">
				<div class="form-row">
					<div class="form-group col-md-4">
						<b>¿CUANTO NECESITAS?</b>
						<?php echo $this->Form->input('valor_credito',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresa un valor','min' => '50000','max' => '1500000')); ?>
					</div>
					<div class="form-group col-md-4">
						<b>Tiempo en meses</b>
						<div class="meses_credito">
							<?php echo $this->Form->input('CreditNumeroMeses1',array('label' => false,'class' => 'form-control','default' => 'Introduce primero el valor que necesitas','options' => array('Introduce primero el valor que necesitas'))); ?>
						</div>
					</div>
					<div class="form-group col-md-4">
						<b>VALOR CUOTA APROXIMADO</b>
						<?php echo $this->Form->input('valor_cuota',array('label' => false,'class' => 'form-control','placeholder' => 'VALOR DE CUOTA','readonly' => true,'required' => false)); ?>
					</div>
				</div>
			</div>
			<div class="chek">
				<div>
					<label> ¿Aceptas el valor de la cuota?</label>
					<input id="checkbox1" type="checkbox" data-parsley-required="true" data-parsley-trigger="click">
				</div>
			</div>

			<br>

			<div class="border_cuadro">
				<h4 class="txtCenter">Datos persona</h4>
				<div class="form-row">
					<div class="form-group col-md-3">
						<b>Nombres</b>
						<?php echo $this->Form->input('nombre_persona',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresar nombres')); ?>
					</div>
					<div class="form-group col-md-3">
						<b>Apellidos</b>
						<?php echo $this->Form->input('apellido_persona',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresar apellidos')); ?>
					</div>
					<div class="form-group col-md-3">
						<b>Cédula</b>
						<?php echo $this->Form->input('cedula_persona',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresar cédula')); ?>
					</div>
					<div class="form-group col-md-3">
						<b>Telefono o celular</b>
						<?php echo $this->Form->input('telefono_persona',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresar celular')); ?>
					</div>
				</div>
			</div>
			<div class="chek">
				<div id="cuadro_tomar_foto">

					<div class="form-row">
						<div class="form-group col-md-4">
							<p class="txtLabelImagenes">Por favor tomale una foto a la parte delantera la cedula</p>
							<button type="button" class="btn btn-primary form-control btn_abrir_modalCD">
								Tomar foto
							</button>
							<?php echo $this->Form->input('foto_cedula_delantera1',array('class' => 'form-control','label' => false,'readonly' => true,'required' => true,)); ?>
						</div>
						<div class="form-group col-md-4">
							<p class="txtLabelImagenes">Por favor tomale una foto a la parte trasera de la cedula</p>
							<button type="button" class="btn btn-primary form-control btn_abrir_modalCT">
								Tomar foto
							</button>
							<?php echo $this->Form->input('foto_cedula_trasera1',array('class' => 'form-control','label' => false,'readonly' => true,'required' => true)); ?>
						</div>
						<div class="form-group col-md-4">
							<p class="txtLabelImagenes">Por favor tomale una foto de la persona</p> <br>
							<button type="button" class="btn btn-primary form-control btn_abrir_modalFP">
								Tomar foto
							</button>
							<?php echo $this->Form->input('foto_perfil1',array('class' => 'form-control','label' => false,'readonly' => true,'required' => true)); ?>
						</div>
					</div>

				</div>
				<div id="cuadro_adjuntar_foto" style="display: none;">
					
					<div class="form-row">
						<div class="form-group col-md-4">
							<p class="txtLabelImagenes">Por favor adjunta una foto a la parte delantera la cedula</p>
							<?php echo $this->Form->input('foto_cedula_delantera',array('type' => 'file','label' => false,'required' => true)); ?>
						</div>
						<div class="form-group col-md-4">
							<p class="txtLabelImagenes">Por favor adjunta una foto a la parte trasera de la cedula</p>
							<?php echo $this->Form->input('foto_cedula_trasera',array('type' => 'file','label' => false,'required' => true)); ?>
						</div>
						<div class="form-group col-md-4">
							<p class="txtLabelImagenes">Por favor adjunta una foto de la persona</p> <br>
							<?php echo $this->Form->input('foto_perfil',array('type' => 'file','label' => false,'required' => true)); ?>
						</div>
					</div>

				</div>
			</div>

			<br>

			<div class="chek">
				<div>
					<input id="checkbox2" type="checkbox" data-parsley-required="true" data-parsley-trigger="click">
					<label> Acepta las <a id="TerminosCondiciones" href="javascript:void(0)">condiciones legales y la Politica de privacidad de crediventas.</a></label>
				</div>
			</div>
			<br>
		<?php echo $this->Form->button('SOLICITAR CRÉDITO',array("class" => "btn btn-primary form-control")); ?>
		</form>
		<br>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalTerminosCondiciones" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content cuadro_terminos">
			<div class="modal-header">
				Terminos y condiciones
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<iframe id="docmento_vista" src="<?php echo $this->Html->url('/files/terminos.pdf') ?>"></iframe>>
			</div>
			<div class="modal-footer">
		        <button type="button" id="btn_aceptar_documento"  class="btn btn-primary">Acepto</button>
				<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancelar</button>
		     </div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTomarFoto" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
		<div class="modal-content cuadro_foto">
			<div class="modal-header">
				<button type="button" id="btn_cerrar_camara" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body resultTomarFoto">
				<video muted="muted" id="video"></video>
				<button type="button" id="btn_tomar" class="btn btn-primary form-control">Tomar foto</button>
			 	<canvas id="canvas" style="display: none;"></canvas>
				<div class="cuadro_botones" style="display: none;">
					<div class="row">
						<div class="col-md-6">
							<button type="button" id="btn_guardar_foto" class="btn btn-primary form-control">Guardar</button>
						</div>
						<div class="col-md-6">
							<button type="button" id="btn_cancelar_foto" class="btn btn-primary form-control">Tomar otra foto</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<?php 
	echo $this->Html->script("controller/credits/add.js?".rand(),						array('block' => 'AppScript'));
	echo $this->Html->script("controller/credits/foto.js?".rand(),						array('block' => 'AppScript'));
?>