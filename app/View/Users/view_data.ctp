<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content data-commerce mb-4">
			<h2 class="tittle" id="tittle_user_id" data-uid="<?php echo $user_id ?>">
				<?php if ($user['User']['role'] == Configure::read('variables.rolCliente')){ ?>
					<div class="content-tittles">
						<div class="line-tittles">|</div>
						<div>  
							<h1>Detalles del</h1>
							<h2>comercio <?php echo h($user['User']['name']); ?></h2>
						</div>
					</div> 

				<?php } else { ?>
					<div class="content-tittles">
						<div class="line-tittles">|</div>
						<div>  
							<h1>Detalles del</h1>
							<h2>Usuario <?php echo h($user['User']['name']); ?></h2>
						</div>
					</div> 					
				<?php } ?>
			</h2>
			<p><b>Teléfono: </b><?php echo h($user['User']['telephone']); ?>&nbsp;</p>
			<p><b>Rol: </b><?php echo h($user['User']['role']); ?>&nbsp;</p>
			<p><b>Correo eléctronico: </b><?php echo h($user['User']['email']); ?>&nbsp;</p>
		</div>

        <?php if ($user['User']['role'] == Configure::read('variables.rolCliente')): ?>
			<hr>
			<div class="bg-white-content mb-4">
				<div class="content-tittles">
					<div class="line-tittles">|</div>
					<div>  
						<h1>Inforgación </h1>
						<h2>Registrada</h2>
					</div>
					<span><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'contrato_view')) ?>">Contrato e información del plan</a></span>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
					<div class="bg-white-content">
						<b>Nit:</b><?php echo $user['Client'][0]['nit'] ?> <br>
						<b>Gremio:</b><?php echo $user['Client'][0]['gremio'] ?> <br>
						<b>Administrador:</b><?php echo $user['Client'][0]['administrador'] ?> - <?php echo $user['Client'][0]['cedula'] ?>  <br>
						<b>Dirección:</b><?php echo $user['Client'][0]['direccion'] ?> - <?php echo $user['Client'][0]['barrio'] ?><br>
						<b>Teléfono:</b><?php echo $user['Client'][0]['tel_usuario'] ?> <br>
						<b>Código:</b><?php echo $user['Client'][0]['codigo'] ?> <br>
					</div>
				</div>

				<div class="form-group col-md-6">
					<div class="bg-white-content">
						<b>Plan:</b><?php echo $user['Client'][0]['clase'] ?><br>
						<b>Como paga:</b><?php echo $user['Client'][0]['como_paga'] ?><br>
						<b>Departamento:</b><?php echo $user['Client'][0]['departamento'] ?><br>
						<b>Cantidad comercios:</b><?php echo $user['Client'][0]['cantidad_comercios'] ?><br>
						<b>Cuanto paga:</b><?php echo $user['Client'][0]['cuanto_paga'] ?><br>
						<b>Servicio:</b><?php echo $user['Client'][0]['productos_servicios'] ?><br>
					</div>
				</div>
				<div class="form-group col-md-6">
					<div class="bg-white-content">
						<b>Banco:</b><?php echo $user['Client'][0]['banco'] ?> <br>
						<b>Número de cuenta:</b><?php echo $user['Client'][0]['numero_cuenta'] ?> <br>
						<b>Tipo de cuenta:</b><?php echo $user['Client'][0]['tipo_cuenta'] ?> <br>
						<b>Propietario de la cuenta:</b><?php echo $user['Client'][0]['nombre_propietario_cuenta'] ?> - <?php echo $user['Client'][0]['cedula_propietario_cuenta'] ?> <br>
					</div>
				</div>
				<div class="form-group col-md-3">
					<div class="bg-white-content">
						<b>Referido 1:</b><?php echo $user['Client'][0]['nombre_completo_r1'] ?><br>
						<b>Identificación 1:</b><?php echo $user['Client'][0]['identificacion_r1'] ?><br>
						<b>Teléfono o celular referido 1:</b><?php echo $user['Client'][0]['celular_r1'] ?><br>
						<b>Comercio referido 1:</b><?php echo $user['Client'][0]['comercio_r1'] ?><br>
					</div>
				</div>

				<div class="form-group col-md-3">
					<div class="bg-white-content">
						<b>Referido 2:</b><?php echo $user['Client'][0]['nombre_completo_r2'] ?><br>
						<b>Identificación 2:</b><?php echo $user['Client'][0]['identificacion_r2'] ?><br>
						<b>Teléfono o celular referido 2:</b><?php echo $user['Client'][0]['celular_r2'] ?><br>
						<b>Comercio referido 2:</b><?php echo $user['Client'][0]['comercio_r2'] ?><br>
					</div>				
				</div>				
			</div>

			<div class="row">	
				<div class="col-md-12">
					<div class="row">	
						<div class="col-md-2">
							<div class="card">
								<div class="card-img-top sizeimg" style="background-image: url(<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_cedula_delantera']) ?>)">
								</div>
								<div class="card-body">
									<p class="card-text">Cédula delantera</p>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="card">
								<div class="card-img-top sizeimg" style="background-image: url(<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_cedula_trasera']) ?>)">
								</div>										
								<div class="card-body">
									<p class="card-text">Cédula trasera</p>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="card">
								<div class="card-img-top sizeimg" style="background-image: url(<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_camara_comercio']) ?>)">	
								</div>									
								<div class="card-body">
									<p class="card-text">Cámara de comercio</p>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="card">
								<div class="card-img-top sizeimg" style="background-image: url(<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_rut']) ?>)">	
								</div>											
								<div class="card-body">
									<p class="card-text">Rut</p>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="card">
								<div class="card-img-top sizeimg" style="background-image: url(<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_administrador']) ?>)">	
								</div>											
								<div class="card-body">
									<p class="card-text">Administrador</p>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="card">
								<div class="card-img-top sizeimg" style="background-image: url(<?php echo $this->Html->url('/files/data_clients/'.$user['Client'][0]['adjuntar_almacen']) ?>)">	
								</div>											
								<div class="card-body">
									<p class="card-text">Almacén</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
</div>

<?php
	echo $this->Html->script("controller/users/view.js?".rand(),							array('block' => 'AppScript'));
?>