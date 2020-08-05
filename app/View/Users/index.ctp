<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content mb-4">
			<div class="row">
				<div class="col-md-6">
					<div class="content-tittles">
						<div class="line-tittles">|</div>
						<div>  
							<h1>Panel</h1>
							<h2>De Usuario</h2>
						</div>
					</div>
				</div>	
				<div class="col-md-6 pull-right">
					<div class="input-group">
						<?php if (isset($this->request->query['q'])){ ?>
							<input type="text" class="form-control" value="<?php echo $this->request->query['q']; ?>" placeholder="Buscador por correo eléctronico"  disabled="disabled">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="button" id="texto_busqueda" data-toggle="tooltip" data-placement="top" title="Borrar">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						<?php } else { ?>
							<input type="text" class="form-control" placeholder="Buscador por correo eléctronico" id="txt_buscador">
							<div class="input-group-append">
								<button class="btn btn-secondary btn_buscar" type="button" data-toggle="tooltip" data-placement="top" title="Buscador">
									<i class="fa fa-search"></i>
								</button>
							</div>
						<?php } ?>
						<a href="<?php echo $this->Html->url(array('action'=>'add')) ?>" class="crearEnlace btn btn-success ml-2">
							<i class="fa fa-1x fa-plus-square"></i> Nuevo usuario
						</a>				
					</div>				 
				</div>
			</div>
		</div>

		<div class="bg-white-content mb-4">
			<div class="content-tittles">
				<div class="line-tittles">|</div>
				<div>  
					<h1>Usuarios </h1>
					<h2>Administrativos</h2>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table">
					<thead class="thead-light">
						<tr>
							<th>Nombre</th>
							<th>Correo eléctronico</th>
							<th>Rol</th>
							<th>Fecha de registro</th>
							<?php if (isset($this->request->query['q'])): ?>
								<th>Estado</th>
							<?php endif ?>
							<th class="actions">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
							<tr>
								<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
								<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
								<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
								<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
								<?php if (isset($this->request->query['q'])): ?>
									<td><?php echo $this->Utilities->estado_usuario($user['User']['state']); ?>&nbsp;</td>
								<?php endif ?>
								<td class="actions">
									<a  href="<?php echo $this->Html->url(array('action' => 'view', $user['User']['id'],'u')) ?>" data-toggle="tooltip" data-placement="top" title="Ver usuario" class="btn btn-outline-primary">
										<i class="fa fa-fw fa-eye"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<p>
					<?php
					echo $this->Paginator->counter(array(
						'format' => __('Página {:page} de {:pages}, mostrando {:current} resultados en {:count} total')));
						?>
					</p>
					<div class="row numberpages">
						<?php
						echo $this->Paginator->first('<< ', array('class' => 'prev'), null);
						echo $this->Paginator->prev('< ', array(), null, array('class' => 'prev disabled'));
						echo $this->Paginator->counter(array('format' => '{:page} de {:pages}'));
						echo $this->Paginator->next(' >', array(), null, array('class' => 'next disabled'));
						echo $this->Paginator->last(' >>', array('class' => 'next'), null);
						?>
						<b><?php echo $this->Paginator->counter(array('format' => '{:count} registros en total')); ?></b>
					</div>
				</div>
			</div>

			<div class="bg-white-content mb-4">
				<?php if (!isset($this->request->query['q'])): ?>
			<div class="content-tittles">
				<div class="line-tittles">|</div>
					<div>  
						<h1>Comercios</h1>
						<h2>Habilitados</h2>
					</div>
				</div>
					<div class="table-responsive">
						<table class="table">
							<thead class="thead-light">
								<tr>
									<th>Nombre</th>
									<th>Correo eléctronico</th>
									<th>Rol</th>
									<th>Fecha de registro</th>
									<th class="actions">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($users_clientes_habilitados as $user): ?>
									<tr>
										<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
										<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
										<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
										<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
										<td class="actions">
											<a class="btn btn-outline-primary" href="<?php echo $this->Html->url(array('action' => 'view', $user['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver usuario">
												<i class="fa fa-fw fa-eye"></i>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif ?>
			</div>
			
			<div class="bg-white-content mb-4">
				<?php if (!isset($this->request->query['q'])): ?>
			<div class="content-tittles">
				<div class="line-tittles">|</div>
					<div>  
						<h1>Comercios</h1>
						<h2>por revisar</h2>
					</div>
				</div>
					<div class="table-responsive">
						<table class="table">
							<thead class="thead-light">
								<tr>
									<th>Nombre</th>
									<th>Correo eléctronico</th>
									<th>Fecha de registro</th>
									<th class="actions">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($users_clientes_revision as $user): ?>
									<tr>
										<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
										<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
										<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
										<td class="actions">
											<a class="stateUserHabilitar btn btn-outline-primary" href="javascript:void(0)" data-uid="<?php echo $user['User']['id']; ?>" data-state="<?php echo Configure::read('variables.habilitado') ?>" data-toggle="tooltip" data-placement="top" title="Habilitar">
												<i class="fa fa-unlock"></i>
											</a>
											<a class="stateUserInhabilitado btn btn-outline-primary" href="javascript:void(0)" data-uid="<?php echo $user['User']['id']; ?>" data-state="<?php echo Configure::read('variables.deshabilitado') ?>" data-toggle="tooltip" data-placement="top" title="Rechazar">
												<i class="fa fa-lock"></i>
											</a>
											<a class="btn btn-outline-primary" href="<?php echo $this->Html->url(array('action' => 'view', $user['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver usuario">
												<i class="fa fa-fw fa-eye"></i>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif ?>
			</div>

		</div>
	</div>

	<?php 
	echo $this->Html->script("controller/users/index.js?".rand(),							array('block' => 'AppScript'));
	?>