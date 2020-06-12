<div class="content-wrapper">
	<div class="container cuadro_panding">
		<h2 class="titleView">Credito</h2>
		<div class="row">
			<div class="col-md-6">
				<h2 class="subTitle">Datos del credito</h2>
				<div class="div_txtCredito">
					<p class="txtDatosVista">
						<b>Cliente:</b> <?php echo $this->Html->link($credit['User']['name'], array('controller' => 'users', 'action' => 'view', $credit['User']['id'])); ?>&nbsp;
					</p>
					<p class="txtDatosVista">
						<b>Valor credito:</b> <?php echo h($credit['Credit']['valor_credito']); ?>&nbsp;
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



					<div class="border_cuadro">
						<span class="txtEndSpan">Datos de la persona</span>
						<p class="txtDatosVista">
							<b>Foto de perfil:</b>
							<!-- <?php $rutaP = $this->Utilities->validate_image_products($credit['Credit']['perfil']); ?> -->
							<img src="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" width="90px" height="70px">
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
							<!-- <?php $rutaT = $this->Utilities->validate_image_products($credit['Credit']['foto_cedula_trasera']); ?> -->
							<img src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" width="90px" height="70px" class="imgmin-product">

							<!-- <?php $rutaP = $this->Utilities->validate_image_products($credit['Credit']['perfil']); ?> -->
							<img src="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" width="90px" height="70px" class="imgmin-product">
						</p>
					</div>



				</div>
			</div>
			<div class="col-md-6">
				<h2 class="subTitle">Progreso</h2>
				<div class="container_progreso">
					<?php for ($i=1; $i < 7; $i++): ?>
						<div class="border_cuadro div_hight_description">
							<span class="txtSpanPasos"><?php echo $i; ?></span>
							<p class="txtDatosVista">Etapa descripción</p>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
</div>