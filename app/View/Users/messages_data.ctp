<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content col-md-12 px-4 mb-3">	
			<div class="status0">
				<div class="content-tittles">
					<div class="line-tittles">|</div>
					<div>  
						<h1>Mensajes </h1>
						<h2>por leer</h2>
					</div>
				</div>
				<div class="contentnotificationnew">
					<div class="message-contact">
						<div class="table-responsive mt-3">
						<table class="table table-hover">
							<thead class="thead-light">
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
		</div>
		<div class="bg-white-content col-md-12 px-4">	
			<div class="status1">
				<div class="content-tittles">
					<div class="line-tittles">|</div>
					<div>  
						<h1>Mensajes leidos</h1>
						<h2>de Contactos</h2>
					</div>
				</div>
				<div class="contentnotification">
					<div class="message-contact">
						<div class="table-responsive mt-3">
						<table class="table table-hover">
							<thead class="thead-light">
								<tr>
									<th>Nombre</th>
									<th>Celular</th>
									<th>Email</th>
									<th>Comercio</th>
									<th>Registro</th>
									<th>Lectura</th>
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
</div>