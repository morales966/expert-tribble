<ul class="nav nav-tabs" id="loguser" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="cotizaciones-tab" data-toggle="tab" href="#informacion" role="tab" aria-controls="informacion" aria-selected="false">
			Información del crédito
		</a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="cotizaciones-tab" data-toggle="tab" href="#proceso" role="tab" aria-controls="proceso" aria-selected="false">
	    	Proceso
		</a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="cotizaciones-tab" data-toggle="tab" href="#descripciones" role="tab" aria-controls="descripciones" aria-selected="false">
	    	Descripciones
		</a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="ventasgeneral" data-toggle="tab" href="#cupo_aprobado" role="tab" aria-controls="cupo_aprobado" aria-selected="true">
	    	Cupo aprobado
	    </a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="ventasgeneral" data-toggle="tab" href="#adjuntos" role="tab" aria-controls="adjuntos" aria-selected="true">
	    	Adjuntos
	    </a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade" id="adjuntos" role="tabpanel" aria-labelledby="adjuntos">
	  	<div class="databussiness">
	  		<?php $actionPermitidosAdjuntos                  = array(
						                                            Configure::read('variables.estados_creditos.adjuntar_plan_pagos')
						                                        ); ?>
			<?php foreach ($datas_credit as $credit): ?>
				<?php if (in_array($credit['Stage']['state_credit'], $actionPermitidosAdjuntos)): ?>
					<div class="line-event list-group-item list-group-item-action flex-column align-items-start">
					    <div class="d-flex w-100 justify-content-between">
					      	<h5 class="mb-0">
								<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.adjuntar_plan_pagos')): ?>
									<span class="txtSpanDescription">
										<a target="_blank" href="<?php echo $this->Html->url('/files/credits/plan_pagos/'.$credit['Stage']['description']) ?>">
											Archivo
										</a>
									</span>
								<?php endif ?>
							</h5>
							<small class="text-muted"><b><?php echo 'Fecha de registro:' ?></b><?php echo $credit['Stage']['created']; ?></small>
					    </div>
					    <p class="mb-0"><b><?php echo 'Usuario:' ?></b><?php echo $this->Utilities->name_user($credit['Stage']['user_id']); ?></p>
					</div>
	    		<?php endif ?>
			<?php endforeach; ?>
	  	</div>
  	</div>
 	<div class="tab-pane fade" id="cupo_aprobado" role="tabpanel" aria-labelledby="ventasgeneral">
	  	<div class="databussiness">

	  		<?php $actionPermitidosCupo_aprobado                  = array(
						                                            Configure::read('variables.estados_creditos.4'),
						                                            Configure::read('variables.estados_creditos.5'),
						                                            Configure::read('variables.estados_creditos.editar_cupo_aprobado'),
						                                            Configure::read('variables.estados_creditos.registrar_retiro_cupo')
						                                        ); ?>
			<?php foreach ($datas_credit as $credit): ?>
				<?php if (in_array($credit['Stage']['state_credit'], $actionPermitidosCupo_aprobado)): ?>
					<div class="line-event list-group-item list-group-item-action flex-column align-items-start">
					    <div class="d-flex w-100 justify-content-between">
					      	<h5 class="mb-0">
								<span class="txtSpanPasos"><?php echo $credit['Stage']['state_credit']; ?></span>
								<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.4')): ?>
									<span class="txtSpanDescription"> Cupo aprobado: <?php echo number_format($credit['Stage']['cupo_aprobado'],0,",","."); ?>
								<?php endif ?></span>
								<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.5')): ?>
									<span class="txtSpanDescription"> Cupo aprobado: <?php echo number_format($credit['Stage']['cupo_aprobado'],0,",","."); ?></span>
								<?php endif ?>
								<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.editar_cupo_aprobado')): ?>
									<span class="txtSpanDescription"> Valor: <?php echo number_format($credit['Stage']['cupo_aprobado'],0,",","."); ?></span>
								<?php endif ?>
								<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.registrar_retiro_cupo')): ?>
									<span class="txtSpanDescription"><?php echo number_format($credit['Stage']['cupo_aprobado'],0,",","."); ?></span>
								<?php endif ?>
							</h5>
							<small class="text-muted"><b><?php echo 'Fecha de registro:' ?></b><?php echo $credit['Stage']['created']; ?></small>
					    </div>
					    <p class="mb-0"><b><?php echo 'Usuario:' ?></b><?php echo $this->Utilities->name_user($credit['Stage']['user_id']); ?></p>
					</div>
	    		<?php endif ?>
			<?php endforeach; ?>
	  	</div>
  	</div>

	<div class="tab-pane fade" id="descripciones" role="tabpanel" aria-labelledby="cotizaciones-tab">
	  	<div class="databussiness">
	  		<?php $actionPermitidosDescripcion                   = array(
						                                            Configure::read('variables.estados_creditos.0'),
						                                            Configure::read('variables.estados_creditos.description')
						                                          ); ?>
			<?php foreach ($datas_credit as $credit): ?>
				<?php if (in_array($credit['Stage']['state_credit'], $actionPermitidosDescripcion)): ?>
					<div class="line-event list-group-item list-group-item-action flex-column align-items-start">
					    <div class="d-flex w-100 justify-content-between">
					      	<h5 class="mb-0">
								<span class="txtSpanPasos"><?php echo $credit['Stage']['state_credit']; ?></span>
								<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.0')): ?>
									<span class="txtSpanDescription"> Descripción: <?php echo $credit['Stage']['description_denied']; ?></span>
								<?php endif ?>
								<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.description')): ?>
									<span class="txtSpanDescription"><?php echo $credit['Stage']['description'] ?></span>
								<?php endif ?>
							</h5>
							<small class="text-muted"><b><?php echo 'Fecha de registro:' ?></b><?php echo $credit['Stage']['created']; ?></small>
					    </div>
					    <p class="mb-0"><b><?php echo 'Usuario:' ?></b><?php echo $this->Utilities->name_user($credit['Stage']['user_id']); ?></p>
					</div>
	    		<?php endif ?>
			<?php endforeach; ?>
	  	</div>	
	</div>

	<div class="tab-pane fade" id="proceso" role="tabpanel" aria-labelledby="cotizaciones-tab">
	  	<div class="databussiness">
			<?php foreach ($datas_credit as $credit): ?>
				<div class="line-event list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-0">
							<span class="txtSpanPasos"><?php echo $credit['Stage']['state_credit']; ?></span>
							<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.4')): ?>
								<span class="txtSpanDescription"> Cupo aprobado: <?php echo number_format($credit['Stage']['cupo_aprobado'],0,",","."); ?>
							<?php endif ?></span>
							<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.5')): ?>
								<span class="txtSpanDescription"> Cupo aprobado: <?php echo number_format($credit['Stage']['cupo_aprobado'],0,",","."); ?></span>
							<?php endif ?>
							<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.0')): ?>
								<span class="txtSpanDescription"> Descripción: <?php echo $credit['Stage']['description_denied']; ?></span>
							<?php endif ?>
							<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.editar_cupo_aprobado')): ?>
								<span class="txtSpanDescription"> Valor: <?php echo number_format($credit['Stage']['cupo_aprobado'],0,",","."); ?></span>
							<?php endif ?>
							<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.registrar_retiro_cupo')): ?>
								<span class="txtSpanDescription"><?php echo number_format($credit['Stage']['cupo_aprobado'],0,",","."); ?></span>
							<?php endif ?>
							<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.description')): ?>
								<span class="txtSpanDescription"><?php echo $credit['Stage']['description'] ?></span>
							<?php endif ?>
							<?php if ($credit['Stage']['state_credit'] == Configure::read('variables.estados_creditos.adjuntar_plan_pagos')): ?>
								<span class="txtSpanDescription">
									<a target="_blank" href="<?php echo $this->Html->url('/files/credits/plan_pagos/'.$credit['Stage']['description']) ?>">
										Archivo
									</a>
								</span>
							<?php endif ?>
						</h5>
						<small class="text-muted"><b><?php echo 'Fecha de registro:' ?></b><?php echo $credit['Stage']['created']; ?></small>
				    </div>
				    <p class="mb-0"><b><?php echo 'Usuario:' ?></b><?php echo $this->Utilities->name_user($credit['Stage']['user_id']); ?></p>
				</div>
			<?php endforeach; ?>
	  	</div>	
	</div>

	<div class="tab-pane fade show active" id="informacion" role="tabpanel" aria-labelledby="cotizaciones-tab">
		<br>
		<div class="databussiness contenttableresponsive">
	
			<div class="content info-request mb-3">
				<h5>INFORMACIÓN PERSONAL</h5>
				<p class="">
					<b>Nombre</b> <?php echo h($credit['Credit']['nombre_persona'].' '.$credit['Credit']['apellido_persona']); ?>&nbsp;
				</p>		
				<p class="">
					<b>Cédula</b> <?php echo h($credit['Credit']['cedula_persona']); ?>&nbsp;
				</p>
				<p class="">
					<b>Telefono</b> <?php echo h($credit['Credit']['telefono_persona']); ?>&nbsp;
				</p>

				<h5>INFORMACIÓN DEL CRÉDITO</h5>
				<p class="">
					<b>Valor del crédito</b> <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?>&nbsp;
				</p>
				<p class="">
					<b>Cuotas</b> <?php echo h($credit['Credit']['numero_meses']); ?>&nbsp;
				</p>
				<p c lass="">
					<b>Valor cuota </b> <?php echo h($credit['Credit']['valor_cuota']); ?>&nbsp;
				</p>
				<p class="">
					<b>Fecha de registro</b> <?php echo h($credit['Credit']['created']); ?>&nbsp;
				</p>
			</div>
			<div class="row photos-request mt-4">
				<div class="col-md-4">
					<div class="card">
					  <img class="card-img-top imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" src="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" >
					  <div class="card-body">
					    <p class="card-text">Foto de perfil</p>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
					  <img class="card-img-top imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>" src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>">
					  <div class="card-body">
					    <p class="card-text">Foto Cédula Frontal</p>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
					  <img class="card-img-top imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>">
					  <div class="card-body">
					    <p class="card-text">Foto Cédula Posterior</p>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<div class="modal-content cuadro_foto">
			<div class="modal-body">
				<img src="" id="img-product" width="100%" height="90%">
				<button class="btn btn-secondary form-control" id="btn_cerrar_mFoto">Cerrar</button>
			</div>
		</div>
    </div>
</div>