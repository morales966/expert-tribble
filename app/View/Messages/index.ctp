<div class="content-wrapper">
	<div class="container cuadro_panding">
		<div class="col-md-12">	
			<div class="status0">
				<h2>
					Notificaciones nuevas
					<?php if ($datosNueva > 0): ?>
						<span class="txtSpanPasos" id="notificaciones_leidas">
							Marcar todas como leidas
						</span>
					<?php endif ?>
				</h2>
				<div class="contentnotificationnew">
					<?php echo $this->Utilities->data_null_notifications_new($datosNueva); ?>
					<?php foreach ($datos as $value): ?>
						<?php if ($value['Message']['state'] == Configure::read('variables.noti_por_leer')): ?>
								<div class="item-notification">
									<a class="dropdown-item small stateNotificacion" href="javascript:void(0)" data-uid="<?php echo $value['Message']['id']; ?>" data-state="<?php echo Configure::read('variables.noti_vista') ?>">
										<?php echo $value['Message']['description']; ?>
										<b>Fecha:</b><?php echo $value['Message']['created'] ?>	
									</a>
								</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>

			<div class="status1">
				<h2>Notificaciones leídas</h2>
				<div class="contentnotification">
				<?php echo $this->Utilities->data_null_notifications_read($datosLeida); ?>
				<?php foreach ($datos as $value): ?>
					<?php if ($value['Message']['state'] == Configure::read('variables.noti_vista')): ?>
						<div class="item-notification">
							<a class="dropdown-item small" href="<?php echo $value['Message']['url'] ?>">
								<?php echo $value['Message']['description']; ?>
								<b>Fecha:</b><?php echo $value['Message']['created'] ?>	
							</a>
						</div>
					<?php endif ?>
				<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>