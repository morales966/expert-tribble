<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
        <?php if (AuthComponent::user('role') != Configure::read('variables.rolCliente')) { ?>
			<div class="col-md-12">
				<div class="content-tittles">
	                <div class="line-tittles">|</div>
	                <div>  
	                  <h1>Panel</h1>
	                  <h2>de Créditos</h2>
	                </div>
	             </div>
            </div>
            <div class="row">
				<div class="col-md-4">
					<div class="dropdown text-right">
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							Filtros por estados créditos
						</button>
						<div class="dropdown-menu">
							<?php
							$todo 			= 'Todos los créditos ';
							echo $this->Html->link($todo, array(),array('class' => 'dropdown-item'));

							$cancelado = Configure::read('variables.estados_creditos.1').' ';
							echo $this->Html->link($cancelado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Solicitud'))),array('class' => 'dropdown-item'));
							$estudio = Configure::read('variables.estados_creditos.2').' ';
							echo $this->Html->link($estudio, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.En_estudio'))),array('class' => 'dropdown-item'));
							$detenido = Configure::read('variables.estados_creditos.3').' ';
							echo $this->Html->link($detenido, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Detenido'))),array('class' => 'dropdown-item'));
							$aprobado_no_retirado = Configure::read('variables.estados_creditos.4').' ';
							echo $this->Html->link($aprobado_no_retirado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'))),array('class' => 'dropdown-item'));
							$aprobado_retirado = Configure::read('variables.estados_creditos.5').' ';
							echo $this->Html->link($aprobado_retirado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'))),array('class' => 'dropdown-item'));

							?>
							<div class="dropdown-divider"></div>
							<?php
							$rechazado = Configure::read('variables.estados_creditos.0').' ';
							echo $this->Html->link($rechazado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Negado'))),array('class' => 'dropdown-item'));
							$terminado = Configure::read('variables.estados_creditos.6').' ';
							echo $this->Html->link($terminado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Pagado'))),array('class' => 'dropdown-item'));
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div id="container_creditos" class="row mb-5">

					<div class="panel panel-primary kanban-col ">
						<div class="panel-heading">
							<strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.1') ?> <span class="pull-right" id="txt_cantidad_solicitud"></span></strong>
						</div>
						<div class="container_state">
							<div class="panel-body_solicitud">
								<div id="DOING10" class="kanban-centered">

									<?php foreach ($creditos_solicitud as $credit): ?>

										<article class="kanban-entry grab" data-uid="<?php echo $credit['Credit']['id']; ?>" id="<?php echo $credit['Credit']['id']; ?>" draggable="true">
											<div class="kanban-entry-inner">
												<div class="kanban-label">
													<h2>
														<?php echo $credit['User']['name'] ?>
														<a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'view',$credit['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver datos del cliente">
															<i class="fa fa-eye"></i>
														</a>
														<span style="display: block;">
															<?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']).' - '.h($credit['Credit']['cedula_persona']).' - '.h($credit['Credit']['telefono_persona'])?>
														</span>
													</h2>
													<p>
														<strong>$ <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
														<span class="txt_cuotas">
															<?php echo h($credit['Credit']['numero_meses']).' cuotas de';?>
															$<?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
														</span>
													</p>
													<span>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-eye"></i>
														</a>
													</span>
												</div>
											</div>
										</article>

									<?php endforeach; ?>

								</div>
							</div>
						</div>
						<p class="txt_total_estado">Total: <span id="total_solicitud"></span></p>
					</div>

					<div class="panel panel-primary kanban-col">
						<div class="panel-heading">
							<strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.2') ?> <span class="pull-right" id="txt_cantidad_estudio"></span></strong>
						</div>
						<div class="container_state">
							<div class="panel-body_estudio">
								<div id="DOING20" class="kanban-centered">

									<?php foreach ($creditos_estudio as $credit): ?>

										<article class="kanban-entry grab" data-uid="<?php echo $credit['Credit']['id']; ?>" id="<?php echo $credit['Credit']['id']; ?>" draggable="true">
											<div class="kanban-entry-inner">
												<div class="kanban-label">
													<h2>
														<?php echo $credit['User']['name'] ?>
														<a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'view',$credit['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver datos del cliente">
															<i class="fa fa-eye"></i>
														</a>
														<span style="display: block;">
															<?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']).' - '.h($credit['Credit']['cedula_persona']).' - '.h($credit['Credit']['telefono_persona'])?>
														</span>
													</h2>
													<p><span>Asesor encargado:</span><?php echo $this->Utilities->name_user($credit['Credit']['user_asesor']); ?></p>
													<p>
														<strong>$ <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
														<span class="txt_cuotas">
															<?php echo h($credit['Credit']['numero_meses']).' cuotas de';?>
															$ <?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
														</span>
													</p>
													<span>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-eye"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver asesor" class="btn btn-sm btn-outline-primary ver_asesor" data-asesor="<?php echo $credit['Credit']['user_asesor']; ?>">
															<i class="fa fa-user"></i>
														</a>

														<div class="dropdown d-inline">
														  <button class="btn btn-outline-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														    <i class="fa fa-file-image-o"></i>
														  </button>
															  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															    <small><a class="dropdown-item" download href="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" >
																	Descargar foto de perfil
																</a></small>
																<small><a class="dropdown-item" download href="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>">
																	Descargar cédula delantera
																</a></small>
																<small><a class="dropdown-item" download href="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" >
																	Descargar cédula trasera
																</a></small>
															</div>

														 </div>


														<a class="btn btn-sm btn-outline-primary" href="<?php echo 'https://api.whatsapp.com/send?phone=57'.$credit["Credit"]["telefono_persona"]?>" data-toggle="tooltip" data-placement="top" title="Conversar en whatsapp" target="_blank">
															<i class="fa fa-whatsapp"></i>
														</a>
													</span>
												</div>
											</div>
										</article>

									<?php endforeach; ?>

								</div>
							</div>
						</div>
						<p class="txt_total_estado">Total: <span id="total_estudio"></span></p>
					</div>

					<div class="panel panel-primary kanban-col">
						<div class="panel-heading">
							<strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.3') ?> <span class="pull-right" id="txt_cantidad_detenido"></strong>
						</div>
						<span class="txt_cantidad_div" id="txt_cantidad_detenido"></span>
						<div class="container_state">
							<div class="panel-body_detenido">
								<div id="DOING30" class="kanban-centered">

									<?php foreach ($creditos_detenido as $credit): ?>

										<article class="kanban-entry grab" data-uid="<?php echo $credit['Credit']['id']; ?>" id="<?php echo $credit['Credit']['id']; ?>" draggable="true">
											<div class="kanban-entry-inner">
												<div class="kanban-label">
													<h2>
														<?php echo $credit['User']['name'] ?>
														<a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'view',$credit['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver datos del cliente">
															<i class="fa fa-eye"></i>
														</a>
														<span style="display: block;">
															<?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']).' - '.h($credit['Credit']['cedula_persona']).' - '.h($credit['Credit']['telefono_persona'])?>
														</span>
													</h2>
													<p><span>Asesor encargado:</span><?php echo $this->Utilities->name_user($credit['Credit']['user_asesor']); ?></p>
													<p>
														<strong>$ <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
														<span class="txt_cuotas">
															<?php echo h($credit['Credit']['numero_meses']).' cuotas de';?>  
															$<?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
														</span>
													</p>
													<span>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-eye"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Añadir comentario" class="btn_comentario btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-comment-o"></i>
														</a>
														<a href="<?php echo 'https://api.whatsapp.com/send?phone=57'.$credit["Credit"]["telefono_persona"]?>" data-toggle="tooltip" data-placement="top" title="Conversar en whatsapp" class="btn btn-sm btn-outline-primary " target="_blank">
															<i class="fa fa-whatsapp"></i>
														</a>
													</span>
												</div>
											</div>
										</article>

									<?php endforeach; ?>

								</div>
							</div>
						</div>
						<p class="txt_total_estado">Total: <span id="total_detenido"></span></p>
					</div>

					<div class="panel panel-primary kanban-col">
						<div class="panel-heading">
							<strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.4') ?> <span class="pull-right" id="txt_cantidad_aprobado_no_retirado"></strong>
						</div>
						<div class="container_state">
							<div class="panel-body_aprobado-no-retirado">
								<div id="DOING40" class="kanban-centered">

									<?php foreach ($creditos_aprobado_no_retirado as $credit): ?>

										<article class="kanban-entry grab" data-uid="<?php echo $credit['Credit']['id']; ?>" id="<?php echo $credit['Credit']['id']; ?>" draggable="true">
											<div class="kanban-entry-inner">
												<div class="kanban-label">
													<h2>
														<?php echo $credit['User']['name'] ?>
														<a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'view',$credit['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver datos del cliente">
															<i class="fa fa-eye"></i>
														</a>
														<span style="display: block;">
															<?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']).' - '.h($credit['Credit']['cedula_persona']).' - '.h($credit['Credit']['telefono_persona'])?>
														</span>
													</h2>
													<p><span>Asesor encargado:</span><?php echo $this->Utilities->name_user($credit['Credit']['user_asesor']); ?></p>
													<p>
														<strong>$ <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
														<span class="txt_cuotas">
															<?php echo h($credit['Credit']['numero_meses']).' cuotas de';?> 
															$<?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
														</span>
													</p>
													<span>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver cupo aprobado" class="ver_cupo_aprobado btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-sort-numeric-asc"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-eye"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Añadir comentario" class="btn_comentario btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-comment-o"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Enviar mensaje de texto" class="btn_mensaje_texto btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-mobile"></i>
														</a>
														<a class="btn btn-sm btn-outline-primary" href="<?php echo 'https://api.whatsapp.com/send?phone=57'.$credit["Credit"]["telefono_persona"]?>" data-toggle="tooltip" data-placement="top" title="Conversar en whatsapp" target="_blank">
															<i class="fa fa-whatsapp"></i>
														</a>
													</span>
												</div>
											</div>
										</article>

									<?php endforeach; ?>

								</div>
							</div>
						</div>
						<p class="txt_total_estado">Total: <span id="total_aprobado_no_retirado"></span></p>
					</div>

					<div class="panel panel-primary kanban-col">
						<div class="panel-heading">
							<strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.5') ?> <span class="pull-right" id="txt_cantidad_aprobado_retirado"></strong>
						</div>
						<div class="container_state">
							<div class="panel-body_aprobado-retirado">
								<div id="DOING50" class="kanban-centered">

									<?php foreach ($creditos_aprobado_retirado as $credit): ?>

										<article class="kanban-entry grab" data-uid="<?php echo $credit['Credit']['id']; ?>" id="<?php echo $credit['Credit']['id']; ?>" draggable="true">
											<div class="kanban-entry-inner">
												<div class="kanban-label">
													<h2>
														<?php echo $credit['User']['name'] ?>
														<a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'view',$credit['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver datos del cliente">
															<i class="fa fa-eye"></i>
														</a>
														<span style="display: block;">
															<?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']).' - '.h($credit['Credit']['cedula_persona']).' - '.h($credit['Credit']['telefono_persona'])?>
														</span>
													</h2>
													<p><span>Asesor encargado:</span><?php echo $this->Utilities->name_user($credit['Credit']['user_asesor']); ?></p>
													<?php if ($credit['Credit']['state'] == Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')) { ?>
														<p>
															<?php echo Configure::read('variables.estados_creditos.7'); ?>
														</p>
													<?php } else { ?>
														<p>
															<strong>$ <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
															<span class="txt_cuotas">
																<?php echo h($credit['Credit']['numero_meses']).' cuotas de ';?>
																$<?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
															</span>
														</p>
													<?php } ?>
													<span>
													<?php if ($credit['Credit']['state'] != Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')): ?>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Adjuntar plan pago" class="adjuntar_plan_pago btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-paperclip"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Registrar cupo retirado" class="registrar_cupo_aprobado btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-edit"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver cupo aprobado" class="ver_cupo_aprobado btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-sort-numeric-asc"></i>
														</a>
													<?php endif ?>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver preaprobado" class="ver_preaprobado btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-sort-numeric-desc"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-eye"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Añadir comentario" class="btn_comentario btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-comment-o"></i>
														</a>
													</span>
												</div>
											</div>
										</article>

									<?php endforeach; ?>

								</div>
							</div>
						</div>
						<p class="txt_total_estado">Total: <span id="total_aprobado_retirado"></span></p>
					</div>

					<div class="panel panel-primary kanban-col mr-0">
						<div class="panel-heading">
							<strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.0') ?> <span class="pull-right" id="txt_cantidad_negado"></strong>
						</div>
						<div class="container_state">
							<div class="panel-body_negado">
								<div id="DOING0" class="kanban-centered">

									<?php foreach ($creditos_negado as $credit): ?>

										<article class="kanban-entry grab" data-uid="<?php echo $credit['Credit']['id']; ?>" id="<?php echo $credit['Credit']['id']; ?>" draggable="true">
											<div class="kanban-entry-inner">
												<div class="kanban-label">
													<h2>
														<?php echo $credit['User']['name'] ?>
														<a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'view',$credit['User']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver datos del cliente">
															<i class="fa fa-eye"></i>
														</a>
														<span style="display: block;">
															<?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']).' - '.h($credit['Credit']['cedula_persona']).' - '.h($credit['Credit']['telefono_persona'])?>
														</span>
													</h2>
													<p><span>Asesor encargado:</span><?php echo $this->Utilities->name_user($credit['Credit']['user_asesor']); ?></p>
													<p>
														<strong>$ <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
														<span class="txt_cuotas">
															<?php echo h($credit['Credit']['numero_meses']).' cuotas de';?>
															$<?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
														</span>
													</p>
													<span>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito btn btn-outline-primary btn-sm" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-eye"></i>
														</a>
														<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Añadir comentario" class="btn_comentario" data-uid="<?php echo $credit['Credit']['id']; ?>">
															<i class="fa fa-comment-o"></i>
														</a>
														<a href="<?php echo 'https://api.whatsapp.com/send?phone=57'.$credit["Credit"]["telefono_persona"]?>" data-toggle="tooltip" data-placement="top" title="Conversar en whatsapp" target="_blank">
															<i class="fa fa-whatsapp"></i>
														</a>
													</span>
												</div>
											</div>
										</article>

									<?php endforeach; ?>

								</div>
							</div>
						</div>
						<p class="txt_total_estado">Total: <span id="total_negado"></span></p>
					</div>

				</div>
			</div>
			<div class="bg-white-content mb-5">
				<div class="content-tittles">
	                <div class="line-tittles">|</div>
	                <div>  
	                  <h1>Créditos</h1>
	                  <h2>Finalizados</h2>
	                </div>
	             </div>
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th>Cliente</th>
								<th>Nombre cliente</th>
								<th>Identificación</th>
								<th>Celular</th>
								<th>Valor credito</th>
								<th><?php echo $this->Paginator->sort('Credit.state', 'Estado'); ?></th>
								<th>Fecha registro</th>
								<th class="actions">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($credits as $credit): ?>
								<tr>
									<td>
										<?php echo $this->Html->link($credit['User']['name'], array('controller' => 'users', 'action' => 'view', $credit['User']['id'])); ?>
									</td>
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
				
		<?php } else { ?>
			<div class="bg-white-content mb-2">
				<div class="row ">
					<div class="col-md-3">
						<div class="content-tittles ">
			                <div class="line-tittles">|</div>
			                <div>  
			                  <h1>Panel</h1>
			                  <h2>DE CRÉDITO</h2>
			                </div>
			              </div>
					</div>
					<div class="col-md-4">
						<div class="dropdown text-right">
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								Filtros por estados créditos
							</button>
							<div class="dropdown-menu">
								<?php
								$todo 			= 'Todos los créditos ';
								echo $this->Html->link($todo, array(),array('class' => 'dropdown-item'));

								$cancelado = Configure::read('variables.estados_creditos.1').' ';
								echo $this->Html->link($cancelado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Solicitud'))),array('class' => 'dropdown-item'));
								$estudio = Configure::read('variables.estados_creditos.2').' ';
								echo $this->Html->link($estudio, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.En_estudio'))),array('class' => 'dropdown-item'));
								$detenido = Configure::read('variables.estados_creditos.3').' ';
								echo $this->Html->link($detenido, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Detenido'))),array('class' => 'dropdown-item'));
								$aprobado_no_retirado = Configure::read('variables.estados_creditos.4').' ';
								echo $this->Html->link($aprobado_no_retirado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'))),array('class' => 'dropdown-item'));
								$aprobado_retirado = Configure::read('variables.estados_creditos.5').' ';
								echo $this->Html->link($aprobado_retirado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'))),array('class' => 'dropdown-item'));

								?>
								<div class="dropdown-divider"></div>
								<?php
								$rechazado = Configure::read('variables.estados_creditos.0').' ';
								echo $this->Html->link($rechazado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Negado'))),array('class' => 'dropdown-item'));
								$terminado = Configure::read('variables.estados_creditos.6').' ';
								echo $this->Html->link($terminado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Pagado'))),array('class' => 'dropdown-item'));
								?>
							</div>
						</div>
					</div>
					<div class="col-md-5 text-right">
						<div class="input-group">
							<?php if (AuthComponent::user('role')==Configure::read('variables.rolCliente')): ?>
								<a href="<?php echo $this->Html->url(array('action'=>'add')) ?>" class="btn btn-success mr-3 crearEnlace">
									<i class="fa fa-1x fa-plus-square"></i> Nuevo crédito
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
								<th>Nombre cliente</th>
								<th>Identificación</th>
								<th>Celular</th>
								<th>Valor crédito</th>
								<th>Estado</th>
								<th>Cupo aprobado</th>
								<th>Fecha registro</th>
								<th class="actions">Acción</th>
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
									<td><?php echo h(number_format($credit['Credit']['cupo_aprobado'],0,",","."));?>&nbsp;</td>

									<td><?php echo h($credit['Credit']['created']); ?>&nbsp;</td>
									<td class="actions">
										<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="btn btn-outline-primary ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
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
					<p class="txtIzquierdo">
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<?php if (AuthComponent::user('role') != Configure::read('variables.rolCliente')): ?>
	<div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="text-center">
						<i class="fa fa-refresh fa-5x fa-spin"></i>
						<h4>Procesando</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>

<?php 
	if (AuthComponent::user('role') != Configure::read('variables.rolCliente')) {
		echo $this->Html->css("controller/credits/indexA.css?".rand(),							array('block' => 'AppCss'));
		echo $this->Html->script("controller/credits/indexA.js?".rand(),						array('block' => 'AppScript'));
	} else {
		echo $this->Html->script("controller/credits/index.js?".rand(),							array('block' => 'AppScript'));
	}
	echo $this->Html->css("controller/credits/view.css?".rand(),							array('block' => 'AppCss'));
	echo $this->Html->script("controller/credits/view.js?".rand(),							array('block' => 'AppScript'));
?>