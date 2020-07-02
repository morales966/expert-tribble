<div class="content-wrapper">
	<div class="container cuadro_panding">
		<div class="row">
			<div class="col-md-12">
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
				 </div>
			</div>
		</div>
		<hr>
		<h2 class="tittle">Usuarios</h2>
		<a href="<?php echo $this->Html->url(array('action'=>'add')) ?>" class="crearEnlace">
			<i class="fa fa-1x fa-plus-square"></i> Nuevo usuario
		</a>
		<div class="table-responsive">
			<table class="table">
	   			<thead class="thead-dark">
					<tr>
						<th>Nombre</th>
						<th>Correo eléctronico</th>
						<th>Rol</th>
						<th>Fecha de registro</th>
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
						<td class="actions">
							<a  href="<?php echo $this->Html->url(array('action' => 'view', $user['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver usuario">
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

		<?php if (!isset($this->request->query['q'])): ?>
			<h2 class="tittle">Clientes</h2>
			<div class="table-responsive">
				<table class="table">
		   			<thead class="thead-dark">
						<tr>
							<th>Nombre</th>
							<th>Correo eléctronico</th>
							<th>Fecha de registro</th>
							<th class="actions">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users_clientes as $user): ?>
						<tr>
							<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
							<td class="actions">
								<a  href="<?php echo $this->Html->url(array('action' => 'view', $user['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver usuario">
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

<?php 
	echo $this->Html->script("controller/users/index.js?".rand(),							array('block' => 'AppScript'));
?>