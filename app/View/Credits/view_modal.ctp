<h2 class="titleView">Crédito</h2>
<div class="row">
	<div class="col-md-6">
		<h2 class="subTitle">Datos del crédito</h2>
		<div class="div_txtCredito">
			<p class="txtDatosVista">
				<b>Cliente:</b> <?php echo $this->Html->link($credit['User']['name'], array('controller' => 'users', 'action' => 'view', $credit['User']['id'])); ?>&nbsp;
			</p>
			<p class="txtDatosVista">
				<b>Valor crédito:</b> <?php echo h($credit['Credit']['valor_credito']); ?>&nbsp;
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
					<!-- <?php $rutaFP = $this->Utilities->validate_image_products($credit['Credit']['foto_perfil']); ?> -->
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
					<!-- <?php $rutaCD = $this->Utilities->validate_image_products($credit['Credit']['foto_cedula_delantera']); ?> -->
					<img class="imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>" src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>" width="90px" height="70px" class="imgmin-product">

					<!-- <?php $rutaCT = $this->Utilities->validate_image_products($credit['Credit']['foto_cedula_trasera']); ?> -->
					<img class="imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" width="90px" height="70px" class="imgmin-product">
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

<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
		<div class="modal-content cuadro_foto">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<img src="" id="img-product" width="100%" height="100%">
			</div>
		</div>
    </div>
  </div>

<?php
	echo $this->Html->css("controller/credits/view.css?".rand(),						array('block' => 'AppCss'));

	echo $this->Html->script("controller/credits/view.js?".rand(),						array('block' => 'AppScript'));
?>