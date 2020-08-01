<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">

		<div class="bg-white-content mb-2">
			<div class="row ">
				<div class="col-md-7">
					<div class="content-tittles">
					<div class="line-tittles">|</div>
					<div>  
						<h1>Comercios  </h1>
						<h2>Afiliados</h2>
					</div>
				</div>
				</div>
				<div class="col-md-5 text-right">
					<div class="input-group">
						<?php if (AuthComponent::user('role') == Configure::read('variables.roles.Ejecutivo')): ?>
							<a href="<?php echo $this->Html->url(array('action'=>'add_client')) ?>" class="btn btn-success mr-3 crearEnlace">
								<i class="fa fa-1x fa-plus-square"></i> Nuevo comercio
							</a>
						<?php endif ?>
						<?php if (isset($this->request->query['q'])){ ?>
							<input type="text" class="form-control" value="<?php echo $this->request->query['q']; ?>" placeholder="Buscador por cédula"  disabled="disabled">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="button" id="texto_busqueda" data-toggle="tooltip" data-placement="top" title="Borrar">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						<?php } else { ?>
							<input type="text" class="form-control" placeholder="Buscador por cedula" id="txt_buscador">
							<div class="input-group-append">
								<button class="btn btn-secondary btn_buscar" type="button" data-toggle="tooltip" data-placement="top" title="Buscador">
									<i class="fa fa-search"></i>
								</button>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="table-responsive mt-3">
				<table class="table table-hover">
					<thead class="thead-light ">
						<tr>
							<th>Nombre comercio</th>
							<th>Identificación</th>
							<th>Teléfono o celular</th>
							<th>Correo eléctronico</th>
							<th>Fecha registro</th>
							<th class="actions">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($clients as $client): ?>
							<tr>
								<td><?php echo h($client['User']['name']); ?>&nbsp;</td>
								<td><?php echo h($client['Client']['nit']); ?>&nbsp;</td>
								<td><?php echo h($client['User']['telephone']); ?>&nbsp;</td>
								<td><?php echo h($client['User']['email']); ?>&nbsp;</td>
								<td><?php echo h($client['User']['created']); ?>&nbsp;</td>
								<td class="actions">
									<a class="btn btn-outline-primary" href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'view',$client['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver detalle">
										<i class="fa fa-eye"></i>
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
	</div>
</div>

<?php 
	echo $this->Html->script("controller/users/comercio.js?".rand(),							array('block' => 'AppScript'));
?>