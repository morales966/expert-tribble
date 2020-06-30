<h2 class="subTitle">Datos del crédito</h2>
<div class="row">
	<div class="col-md-3 div_txtCredito">
		<p class="txtDatosVista">
			<b>Cliente:</b> <?php echo $this->Html->link($credit['User']['name'], array('controller' => 'users', 'action' => 'view', $credit['User']['id'])); ?>&nbsp;
		</p>
		<p class="txtDatosVista">
			<b>Valor crédito:</b> <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?>&nbsp;

		</p>
		<p class="txtDatosVista">
			<b>Numero de meses:</b> <?php echo h($credit['Credit']['numero_meses']); ?>&nbsp;
		</p>
		<p class="txtDatosVista">
			<b>Valor cuota:</b> <?php echo h($credit['Credit']['valor_cuota']); ?>&nbsp;
		</p>
		<p class="txtDatosVista">
			<b>Fecha de registro:</b> <?php echo h($credit['Credit']['created']); ?>&nbsp;
		</p>
	</div>
	<div class="col-md-4 div_txtCredito">
		<div class="border_cuadro">
			<span class="txtEndSpan">Datos de la persona</span>
			<p class="txtDatosVista">
				<b>Foto de perfil:</b>
				<img class="imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" src="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" width="90px" height="70px">
			</p>
			<p class="txtDatosVista">
				<b>Nombre de la persona:</b> 
				<?php echo h($credit['Credit']['nombre_persona'].' '.$credit['Credit']['apellido_persona']); ?>&nbsp;
			</p>
			<p class="txtDatosVista">
				<b>Cedula:</b> <?php echo h($credit['Credit']['cedula_persona']); ?>&nbsp;
			</p>
			<p class="txtDatosVista">
				<b>Telefono:</b> <?php echo h($credit['Credit']['telefono_persona']); ?>&nbsp;
			</p>

			<p class="txtDatosVista">
				<b>Cedula:</b>
				<img class="imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>" src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>" width="60px" height="40px" class="imgmin-product">
				<img class="imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" width="60px" height="40px" class="imgmin-product">
			</p>
		</div>
	</div>
	
	<div class="col-md-5">
		<h2 class="subTitle">Progreso</h2>
		<div class="container_progreso">
			<?php foreach ($datas_credit as $credit): ?>
				<div class="border_cuadro">
					<p class="asesor_fecha">
						<span class="txtDerechoAsesor">
							<?php echo $this->Utilities->name_user($credit['Stage']['user_id']); ?>
						</span>
						<span class="txtDerechoFecha">
							<?php echo $credit['Stage']['created']; ?>
						</span>
					</p>
					<br>
					<p class="asesor_fecha">
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
					</p>
					
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<br>
	<button class="btn btn-secondary form-control" data-dismiss="modal">Cerrar</button>
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