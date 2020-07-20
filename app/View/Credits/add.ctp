<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<h2 class="titleView">Solicitar crédito</h2>
						</div>
						<div class="col-md-6 text-right">
							<a class="btn btn-primary" href="<?php echo $this->Html->url(array('action'=>'index')) ?>">Ver todos los Créditos</a>
						</div>
					</div>
				</div>
			</div>
			</div>

		<?php echo $this->Form->create('Credit',array('data-parsley-validate','enctype'=>"multipart/form-data","id" => "register_form")); ?>
			<div class="progress">
				<div class="progress-bar progress-bar-striped active form-control" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<hr>
			<fieldset class="mt-4 bg-white-content">
					<h3 class="upper mb-3 text-primary">Estás diligenciando el Paso 1</h3>
					<div class="content-step">
						<div class="form-row">
							<div class="form-group col-md-4">z
								<b>¿Cuánto necesitas?</b>
								<?php echo $this->Form->input('valor_credito',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresa un valor','min' => '50000','max' => '1500000')); ?>
							</div>
							<div class="form-group col-md-4">
								<b>Tiempo en meses</b>
								<div class="meses_credito">
									<?php echo $this->Form->input('CreditNumeroMeses1',array('label' => false,'class' => 'form-control','default' => 'Introduce primero el valor que necesitas','options' => array('Introduce primero el valor que necesitas'))); ?>
								</div>
							</div>
							<div class="form-group col-md-4">
								<b>Valor cuota aproximadamente</b>
								<?php echo $this->Form->input('valor_cuota',array('label' => false,'class' => 'form-control','placeholder' => 'VALOR DE CUOTA','readonly' => true,'required' => false)); ?>
							</div>
						</div>
					</div>
					<div class="chek">
						<input id="checkbox1" class="bigcheck" type="checkbox" data-parsley-required="true" data-parsley-trigger="click">
						<label class="text-primary"><b>¿Aceptas el valor de la cuota?</b></label>
					</div>
						<input type="button" class="next-form btn btn-success upper pull-right" value="siguiente" />


			</fieldset>
			<fieldset class="mt-4 bg-white-content">
				<h3 class="upper mb-3 text-primary">Estás diligenciando el Paso 2</h3>
				<div class="content-step">
					<div class="form-row">
						<div class="form-group col-md-3">
							<b>Nombres</b>
							<?php echo $this->Form->input('nombre_persona',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresar nombres','required' => true)); ?>
						</div>
						<div class="form-group col-md-3">
							<b>Apellidos</b>
							<?php echo $this->Form->input('apellido_persona',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresar apellidos','required' => true)); ?>
						</div>
						<div class="form-group col-md-3">
							<b>Cédula</b>
							<?php echo $this->Form->input('cedula_persona',array('type' => 'number','label' => false,'class' => 'form-control','placeholder' => 'Ingresar cédula','required' => true)); ?>
						</div>
						<div class="form-group col-md-3">
							<b>Telefono o celular</b>
							<?php echo $this->Form->input('telefono_persona',array('label' => false,'class' => 'form-control','placeholder' => 'Ingresar celular','required' => true)); ?>
						</div>
					</div>
				</div>
				<hr>
				<div class="chek">
					<div id="cuadro_tomar_foto">

						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="txtLabelImagenes">Por favor tómale una foto a la parte delantera la cédula</label>
								<button type="button" class="btn btn-outline-primary form-control btn_abrir_modalCD">
									Tomar foto
								</button>
								<?php echo $this->Form->input('foto_cedula_delantera1',array('class' => 'form-control','label' => false,'readonly' => true,'required' => true)); ?>
							</div>
							<div class="form-group col-md-4">
								<label class="txtLabelImagenes">Por favor tómale una foto a la parte trasera de la cédula</label>
								<button type="button" class="btn btn-outline-primary form-control btn_abrir_modalCT">
									Tomar foto
								</button>
								<?php echo $this->Form->input('foto_cedula_trasera1',array('class' => 'form-control','label' => false,'readonly' => true,'required' => true)); ?>
							</div>
							<div class="form-group col-md-4">
								<label class="txtLabelImagenes">Por favor tómale una foto de la persona</label>
								<button type="button" class="btn btn-outline-primary form-control btn_abrir_modalFP">
									Tomar foto
								</button>
								<?php echo $this->Form->input('foto_perfil1',array('class' => 'form-control','label' => false,'readonly' => true,'required' => true)); ?>
							</div>
						</div>

					</div>
					<div id="cuadro_adjuntar_foto" style="display: none;">
						
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="txtLabelImagenes">Por favor adjunta una foto a la parte delantera la cedula</label>
								<?php echo $this->Form->input('foto_cedula_delantera',array('type' => 'file','label' => false,'required' => true)); ?>
							</div>
							<div class="form-group col-md-4">
								<label class="txtLabelImagenes">Por favor adjunta una foto a la parte trasera de la cedula</label>
								<?php echo $this->Form->input('foto_cedula_trasera',array('type' => 'file','label' => false,'required' => true)); ?>
							</div>
							<div class="form-group col-md-4">
								<label class="txtLabelImagenes">Por favor adjunta una foto de la persona</label> <br><br>
								<?php echo $this->Form->input('foto_perfil',array('type' => 'file','label' => false,'required' => true)); ?>
							</div>
						</div>

					</div>
				</div>
				<br>
				<div class="chek">
					<input id="checkbox2" type="checkbox" class="bigcheck" data-parsley-required="true" data-parsley-trigger="click">
					<label> Acepta las <a id="TerminosCondiciones" href="javascript:void(0)">condiciones legales y la Politica de privacidad de crediventas.</a></label>
				</div>
					<?php echo $this->Form->button('SOLICITAR CRÉDITO',array("class" => "btn btn-success pull-right upper ml-2")); ?>
					<input type="button" name="previous" class="previous-form btn btn-primary pull-right upper" value="Regresar" />
			</fieldset>
		</form>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalTerminosCondiciones" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content cuadro_terminos">
			<div class="modal-header">
          		<h2 class="modal-title" id="modalTitleGuardarCancelar">Terminos y condiciones</h2>
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






<div class="modal fade" id="modalTomarFotoCD" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
		<div class="modal-content cuadro_foto">
			<div class="modal-header">
          		<h2 class="modal-title" id="modalTitleTomarFotoCD"></h2>
				<button type="button" id="btn_cerrar_camaraCD" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body resultTomarFoto">
				<video muted="muted" id="videoCD" class="video"></video>
				<button type="button" id="btn_tomarCD" class="btn btn-primary form-control btn_tomar">Tomar foto</button>
			 	<canvas id="canvasCD" style="display: none;"></canvas>
				<div class="cuadro_botones" style="display: none;">
					<div class="row">
						<div class="col-md-6">
							<button type="button" id="btn_guardar_fotoCD" class="btn btn-primary form-control">Guardar</button>
						</div>
						<div class="col-md-6">
							<button type="button" id="btn_cancelar_fotoCD" class="btn btn-primary form-control btn_cancelar_foto">Tomar otra foto</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<div class="modal fade" id="modalTomarFotoCT" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
		<div class="modal-content cuadro_foto">
			<div class="modal-header">
          		<h2 class="modal-title" id="modalTitleTomarFotoCT"></h2>
				<button type="button" id="btn_cerrar_camaraCT" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body resultTomarFoto">
				<video muted="muted" id="videoCT" class="video"></video>
				<button type="button" id="btn_tomarCT" class="btn btn-primary form-control btn_tomar">Tomar foto</button>
			 	<canvas id="canvasCT" style="display: none;"></canvas>
				<div class="cuadro_botones" style="display: none;">
					<div class="row">
						<div class="col-md-6">
							<button type="button" id="btn_guardar_fotoCT" class="btn btn-primary form-control">Guardar</button>
						</div>
						<div class="col-md-6">
							<button type="button" id="btn_cancelar_fotoCT" class="btn btn-primary form-control btn_cancelar_foto">Tomar otra foto</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<div class="modal fade" id="modalTomarFotoFP" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
		<div class="modal-content cuadro_foto">
			<div class="modal-header">
          		<h2 class="modal-title" id="modalTitleTomarFotoFP"></h2>
				<button type="button" id="btn_cerrar_camaraFP" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body resultTomarFoto">
				<video muted="muted" id="videoFP" class="video"></video>
				<button type="button" id="btn_tomarFP" class="btn btn-primary form-control btn_tomar">Tomar foto</button>
			 	<canvas id="canvasFP" style="display: none;"></canvas>
				<div class="cuadro_botones" style="display: none;">
					<div class="row">
						<div class="col-md-6">
							<button type="button" id="btn_guardar_fotoFP" class="btn btn-primary form-control">Guardar</button>
						</div>
						<div class="col-md-6">
							<button type="button" id="btn_cancelar_fotoFP" class="btn btn-primary form-control btn_cancelar_foto">Tomar otra foto</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<?php
	echo $this->Html->css("controller/credits/add.css?".rand(),							array('block' => 'AppCss'));
	
	echo $this->Html->script("controller/credits/add.js?".rand(),						array('block' => 'AppScript'));
	echo $this->Html->script("controller/credits/foto.js?".rand(),						array('block' => 'AppScript'));
?>