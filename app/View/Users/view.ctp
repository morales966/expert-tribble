<?php 
	$rolPermisosAdmin           = array(
                                    Configure::read('variables.roles.Administrador'),
                                    Configure::read('variables.roles.Administrador_secundario')
                                  ); 
?>
<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content data-commerce mb-4">
			<h2 class="tittle" id="tittle_user_id" data-uid="<?php echo $id ?>">
				<?php if ($user['User']['role'] == Configure::read('variables.rolCliente')){ ?>
					Estás viendo el comercio <b> <?php echo h($user['User']['name']); ?></b>
				<?php } else { ?>
					<b><?php echo h($user['User']['name']); ?></b>
				<?php } ?>
			</h2>
        	<?php if (in_array(AuthComponent::user('role'), $rolPermisosAdmin)): ?>
				<?php echo $this->Html->link("Usuarios", array('controller' => 'Users','action'=> 'index'), array( 'class' => 'btn btn-success pull-right')) ?>
			<?php endif ?>
			<p><b>Teléfono: </b><?php echo h($user['User']['telephone']); ?>&nbsp;</p>
			<p><b>Rol: </b><?php echo h($user['User']['role']); ?>&nbsp;</p>
			<p><b>Correo eléctronico: </b><?php echo h($user['User']['email']); ?>&nbsp;</p>
		</div>
        <?php if ($user['User']['role'] == Configure::read('variables.rolCliente')): ?>
			<hr>
			<div class="border_cuadro">
				<div class="form-group">
					<?php echo $this->Html->link("Comercios", array('controller' => 'Users','action'=> 'comercios'), array( 'class' => 'btn btn-success pull-right')) ?>
		        </div>
				<h2 class="txtDatosVista">Datos</h2>
				<div class="form-group">
					<b>Nit:</b><?php echo $user['Client'][0]['nit'] ?> <br>
					<b>Gremio:</b><?php echo $user['Client'][0]['gremio'] ?> <br>
					<b>Administrador:</b><?php echo $user['Client'][0]['administrador'] ?> <br>
					<b>Cedula:</b><?php echo $user['Client'][0]['cedula'] ?> <br>
					<b>Dirección:</b><?php echo $user['Client'][0]['direccion'] ?> <br>
					<b>Barrio:</b><?php echo $user['Client'][0]['barrio'] ?> <br>
					<b>Teléfono:</b><?php echo $user['Client'][0]['tel_usuario'] ?> <br>
					<b>Código:</b><?php echo $user['Client'][0]['codigo'] ?> <br>
				</div>

				<div class="form-group">
					<b>Banco:</b><?php echo $user['Client'][0]['banco'] ?> <br>
					<b>Número de cuenta:</b><?php echo $user['Client'][0]['numero_cuenta'] ?> <br>
					<b>Tipo de cuenta:</b><?php echo $user['Client'][0]['tipo_cuenta'] ?> <br>
					<b>Nombre propietario de la cuenta:</b><?php echo $user['Client'][0]['nombre_propietario_cuenta'] ?> <br>
					<b>Cédula propietario de la cuenta:</b><?php echo $user['Client'][0]['cedula_propietario_cuenta'] ?> <br>
				</div>

				<div class="form-group">
					<b>Plán:</b><?php echo $user['Client'][0]['clase'] ?><br>
					<b>Como paga:</b><?php echo $user['Client'][0]['como_paga'] ?><br>
					<b>Departamento:</b><?php echo $user['Client'][0]['departamento'] ?><br>
					<b>Cantidad comercios:</b><?php echo $user['Client'][0]['cantidad_comercios'] ?><br>
					<b>Cuanto paga:</b><?php echo $user['Client'][0]['cuanto_paga'] ?><br>
					<b>Servicio:</b><?php echo $user['Client'][0]['productos_servicios'] ?><br>
				</div>

				<div class="form-group">
					<b>Cédula delantera:</b><img class="img_data" src="<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_cedula_delantera']) ?>"><br>
					<b>Cédula trasera:</b><img class="img_data" src="<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_cedula_trasera']) ?>"><br>
					<b>Camara comercio:</b><img class="img_data" src="<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_camara_comercio']) ?>"><br>
					<b>Rut:</b><img class="img_data" src="<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_rut']) ?>"><br>
					<b>Administrador:</b><img class="img_data" src="<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_administrador']) ?>"><br>
					<b>Almacen:</b><img class="img_data" src="<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_almacen']) ?>"><br>
				</div>

				<div class="form-group">
					<b>Nombre del referido 1:</b><?php echo $user['Client'][0]['nombre_completo_r1'] ?><br>
					<b>Identificación 1:</b><?php echo $user['Client'][0]['identificacion_r1'] ?><br>
					<b>Teléfono o celular referido 1:</b><?php echo $user['Client'][0]['celular_r1'] ?><br>
					<b>Comercio referido 1:</b><?php echo $user['Client'][0]['comercio_r1'] ?><br>
				</div>

				<div class="form-group">
					<b>Nombre completo referido 2:</b><?php echo $user['Client'][0]['nombre_completo_r2'] ?><br>
					<b>Identificación referido 2:</b><?php echo $user['Client'][0]['identificacion_r2'] ?><br>
					<b>Teléfono o celular referido 2:</b><?php echo $user['Client'][0]['celular_r2'] ?><br>
					<b>Comercio referido 2:</b><?php echo $user['Client'][0]['comercio_r2'] ?><br>
				</div>

		       	<hr>
		        <h2 class="txtDatosVista">Creditos</h2>
				<div class="bg-white-content">
					<h2 class="tittle">Créditos en este comercio</h2>
					<div class="row">
						<div class="col-md-12 mb-1">
							<div class="input-group">
								<?php if (isset($this->request->query['q'])){ ?>
									<input type="text" class="form-control" value="<?php echo $this->request->query['q']; ?>" placeholder="Buscador por cedula"  disabled="disabled">
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
					<div class="table-responsive">
						<table class="table">
				   			<thead class="thead-dark">
								<tr>
									<th>Nombre cliente</th>
									<th>Identificación</th>
									<th>Celular</th>
									<th>Valor credito</th>
									<th>Estado</th>
									<th>Fecha registro</th>
									<th class="actions">Acciones</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($credits as $credit): ?>
								<tr>
									<td><?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']); ?>&nbsp;</td>
									<td><?php echo h($credit['Credit']['cedula_persona']); ?>&nbsp;</td>
									<td><?php echo h($credit['Credit']['telefono_persona']); ?>&nbsp;</td>
									<td><?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?>&nbsp;</td>
									<td><?php echo $this->Utilities->estados_creditos($credit['Credit']['state']); ?>&nbsp;</td>
									<td><?php echo h($credit['Credit']['created']); ?>&nbsp;</td>
									<td class="actions">
										<a class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver crédito">
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
			</div>
		<?php endif ?>
	</div>
</div>

<?php
	echo $this->Html->css("controller/credits/view.css?".rand(),							array('block' => 'AppCss'));

	echo $this->Html->script("controller/credits/index.js?".rand(),							array('block' => 'AppScript'));
	echo $this->Html->script("controller/credits/view.js?".rand(),							array('block' => 'AppScript'));
	echo $this->Html->script("controller/users/view.js?".rand(),							array('block' => 'AppScript'));
?>