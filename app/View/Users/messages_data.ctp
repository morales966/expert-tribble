<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content col-md-12 mb-3">	
			<div class="status0">
				<h2 class="tittle">Contactos nuevos</h2>
				<div class="contentnotificationnew">
					<div class="message-contact">
						<table class="table">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Teléfono o celular</th>
									<th>Correo electrónico</th>
									<th>Comercio</th>
									<th>Fecha y hora de registro</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($contacs as $value): ?>
									<?php if ($value['Contact']['state'] == Configure::read('variables.noti_por_leer')): ?>
											<tr>
												<th><?php echo $value['Contact']['name'] ?></th>
												<td><?php echo $value['Contact']['telephone'] ?></td>
												<td><?php echo $value['Contact']['email'] ?></td>
												<td><?php echo $value['Contact']['establishment'] ?></td>
												<td><?php echo $value['Contact']['created'] ?></td>
												<td>
													<a class="btn btn-success small stateContact" href="javascript:void(0)" data-uid="<?php echo $value['Contact']['id']; ?>" data-state="<?php echo Configure::read('variables.noti_vista') ?>">Marcar como leida</a>
												</td>
											</tr>
									<?php endif ?>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-white-content col-md-12">	
			<div class="status1">
				<h2 class="tittle">Contactos leídas</h2>
				<div class="contentnotification">
<div class="message-contact">
						<table class="table">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Teléfono o celular</th>
									<th>Correo electrónico</th>
									<th>Comercio</th>
									<th>Fecha y hora de registro</th>
									<th>Fecha y hora de lectura</th>
								</tr>
							</thead>
							<tbody>					
					<?php foreach ($contacs as $value): ?>
						<?php if ($value['Contact']['state'] == Configure::read('variables.noti_vista')): ?>
							<div class="item-notification">
									<div class="message-contact">
										<tr>
											<th><?php echo $value['Contact']['name'] ?></th>
											<td><?php echo $value['Contact']['telephone'] ?></td>
											<td><?php echo $value['Contact']['email'] ?></td>
											<td><?php echo $value['Contact']['establishment'] ?></td>
											<td><?php echo $value['Contact']['created'] ?></td>
											<td><?php echo $value['Contact']['modified'] ?></td>
										</tr>
									</div>
								<?php endif ?>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>