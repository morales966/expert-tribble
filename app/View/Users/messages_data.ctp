<div class="content-wrapper">
	<div class="container cuadro_panding">
		<div class="col-md-12">	
			<div class="status0">
				<h2>Contactos nuevos</h2>
				<div class="contentnotificationnew">
					<?php foreach ($contacs as $value): ?>
						<?php if ($value['Contact']['state'] == Configure::read('variables.noti_por_leer')): ?>
							<div class="item-notification">
								<a class="dropdown-item small stateContact" href="javascript:void(0)" data-uid="<?php echo $value['Contact']['id']; ?>" data-state="<?php echo Configure::read('variables.noti_vista') ?>">
									<b>Nombre:</b><?php echo $value['Contact']['name'] ?>
									<b>Teléfono o celular:</b><?php echo $value['Contact']['telephone'] ?>
									<b>Correo electrónico:</b><?php echo $value['Contact']['email'] ?>
									<b>Comercio:</b><?php echo $value['Contact']['establishment'] ?>
									<b>Fecha y hora de registro:</b><?php echo $value['Contact']['created'] ?>
								</a>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>

			<div class="status1">
				<h2>Contactos leídas</h2>
				<div class="contentnotification">
					<?php foreach ($contacs as $value): ?>
						<?php if ($value['Contact']['state'] == Configure::read('variables.noti_vista')): ?>
							<div class="item-notification">
								<a class="dropdown-item small" href="javascript:void(0)">
									<b>Nombre:</b><?php echo $value['Contact']['name'] ?>
									<b>Teléfono o celular:</b><?php echo $value['Contact']['telephone'] ?>
									<b>Correo electrónico:</b><?php echo $value['Contact']['email'] ?>
									<b>Comercio:</b><?php echo $value['Contact']['establishment'] ?>
									<b>Fecha:</b><?php echo $value['Contact']['created'] ?>
									<b>Fecha y hora de modificación:</b><?php echo $value['Contact']['modified'] ?>
								</a>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>