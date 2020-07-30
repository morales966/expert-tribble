	<div class="content info-request mb-3">
		<h4 class="mb-3 ">
			Crédito solicitado en <b><?php echo $this->Html->link($credit['User']['name'], array('controller' => 'users', 'action' => 'view', $credit['User']['id'])); ?></b>
		</h4>
		<p class="">
			<b>Valor crédito</b> <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?>&nbsp;
		</p>
		<p class="">
			<b>Cuotas </b> <?php echo h($credit['Credit']['numero_meses']); ?>&nbsp;
		</p>
		<p class="">
			<b>Valor </b> <?php echo h($credit['Credit']['valor_cuota']); ?>&nbsp;
		</p>
		<p class="">
			<b>Fecha</b> <?php echo h($credit['Credit']['created']); ?>&nbsp;
		</p>

		<p class="">
			<b>Nombre</b> <?php echo h($credit['Credit']['nombre_persona'].' '.$credit['Credit']['apellido_persona']); ?>&nbsp;
		</p>		
		<p class="">
			<b>Cédula</b> <?php echo h($credit['Credit']['cedula_persona']); ?>&nbsp;
		</p>
		<p class="">
			<b>Telefono</b> <?php echo h($credit['Credit']['telefono_persona']); ?>&nbsp;
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
	
	<div class="bg-gray-content ">
		<h4 class="mb-3 mt-3 sizeh4">Progreso de la solicitud de crédito</h4>
		<div class="container_progreso list-group">
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
				      <small class="text-muted"><?php echo $credit['Stage']['created']; ?></small>
				    </div>
				    <p class="mb-0"><?php echo $this->Utilities->name_user($credit['Stage']['user_id']); ?></p>
				</div>
			<?php endforeach; ?>
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