<div class="content-wrapper">
	<div class="container cuadro_panding">
		<?php if (AuthComponent::user('role') == 'admin') { ?>

	
			<h2 class="titleView">Creditos</h2>
			<div class="container-fluid">
		        <div id="sortableKanbanBoards" class="row">

		            <div class="panel panel-primary kanban-col">
		                <div class="panel-heading">
		                    <?php echo Configure::read('variables.estados_creditos.1') ?>
		                </div>
		                <div class="panel-body">
		                    <div id="TODO" class="kanban-centered">

		                    	<?php foreach ($creditos_solicitud as $credit): ?>

									<article class="kanban-entry grab" id="<?php echo $credit['Credit']['id']; ?>" draggable="true">
			                            <div class="kanban-entry-inner">
			                                <div class="kanban-label">
			                                    <h2>
			                                    	<?php echo $this->Html->link($credit['User']['name'], array('controller' => 'users', 'action' => 'view', $credit['User']['id'])); ?>
			                                    	<span>
			                                    		<?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']).' - '.h($credit['Credit']['cedula_persona']).' - '.h($credit['Credit']['telefono_persona'])?>
			                                    	</span>
			                                    </h2>
			                                    <p>
			                                    	<strong><?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?></strong>

			                                    </p>
			                                </div>
			                            </div>
			                        </article>

								<?php endforeach; ?>

		                    </div>
		                </div>
		            </div>

		            <div class="panel panel-primary kanban-col">
		                <div class="panel-heading">
		                    <?php echo Configure::read('variables.estados_creditos.2') ?>
		                </div>
		                <div class="panel-body">
		                    <div id="DOING20" class="kanban-centered">

		                        <article class="kanban-entry grab" id="item20" draggable="true">
		                            <div class="kanban-entry-inner">
		                                <div class="kanban-label">
		                                    <h2><a href="#">Job Meeting</a></h2>
		                                    <p>You have a meeting at <strong>Laborator Office</strong> Today.</p>
		                                </div>
		                            </div>
		                        </article>

		                    </div>
		                </div>
		            </div>

		            <div class="panel panel-primary kanban-col">
		                <div class="panel-heading">
		                    <?php echo Configure::read('variables.estados_creditos.3') ?>
		                </div>
		                <div class="panel-body">
		                    <div id="DONE30" class="kanban-centered">

		                        <article class="kanban-entry grab" id="item30" draggable="true">
		                            <div class="kanban-entry-inner">

		                                <div class="kanban-label">
		                                    <h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
		                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
		                                </div>
		                            </div>
		                        </article>

		                    </div>
		                </div>
		            </div>

		            <div class="panel panel-primary kanban-col">
		                <div class="panel-heading">
		                    <?php echo Configure::read('variables.estados_creditos.4') ?>
		                </div>
		                <div class="panel-body">
		                    <div id="DONE40" class="kanban-centered">

		                        <article class="kanban-entry grab" id="item40" draggable="true">
		                            <div class="kanban-entry-inner">

		                                <div class="kanban-label">
		                                    <h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
		                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
		                                </div>
		                            </div>
		                        </article>

		                    </div>
		                </div>
		            </div>

		            <div class="panel panel-primary kanban-col">
		                <div class="panel-heading">
		                    <?php echo Configure::read('variables.estados_creditos.5') ?>
		                </div>
		                <div class="panel-body">
		                    <div id="DONE50" class="kanban-centered">

		                        <article class="kanban-entry grab" id="item50" draggable="true">
		                            <div class="kanban-entry-inner">

		                                <div class="kanban-label">
		                                    <h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
		                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
		                                </div>
		                            </div>
		                        </article>

		                    </div>
		                </div>
		            </div>

		        </div>
		    </div>

			<div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-body">
			                <div class="text-center">
			                    <i class="fa fa-refresh fa-5x fa-spin"></i>
			                    <h4>Processing...</h4>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>



		<?php } else { ?>
			
			<div class="row">
				<div class="col-md-2">
					<h2 class="tittle">Creditos</h2>
				</div>
				<div class="col-md-4">
					<div class="dropdown text-right">
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							Filtros por estados de los creditos
						</button>
						<div class="dropdown-menu">
							<?php
								$todo 			= 'Todos los créditos ';
								echo $this->Html->link($todo, array(),array('class' => 'dropdown-item'));

								$cancelado = 'Solicitado ';
								echo $this->Html->link($cancelado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Solicitud'))),array('class' => 'dropdown-item'));
								$estudio = 'En estudio ';
								echo $this->Html->link($estudio, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.En_estudio'))),array('class' => 'dropdown-item'));
								$detenido = 'Detenido ';
								echo $this->Html->link($detenido, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Detenido'))),array('class' => 'dropdown-item'));
								$aprobado_no_retirado = 'Aprobado, no retirado ';
								echo $this->Html->link($aprobado_no_retirado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'))),array('class' => 'dropdown-item'));
								$aprobado_retirado = 'Aprobado, retirado ';
								echo $this->Html->link($aprobado_retirado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'))),array('class' => 'dropdown-item'));

							?>
							<div class="dropdown-divider"></div>
							<?php
								$rechazado = 'Negado ';
								echo $this->Html->link($rechazado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Negado'))),array('class' => 'dropdown-item'));
								$terminado = 'Pagado ';
								echo $this->Html->link($terminado, array('action'=>'index','?' => array('filterState' => Configure::read('variables.nombres_estados_creditos.Pagado'))),array('class' => 'dropdown-item'));
							?>
						</div>
					</div>
				</div>
				<div class="col-md-5 text-right">
					<div class="input-group">
						<a href="<?php echo $this->Html->url(array('action'=>'add')) ?>" class="crearEnlace">
							<i class="fa fa-1x fa-plus-square"></i> Nuevo credito
						</a>
						<?php if (isset($this->request->query['q'])){ ?>
							<input type="text" class="form-control" value="<?php echo $this->request->query['q']; ?>" placeholder="Buscador por cedula"  disabled="disabled">
						    <div class="input-group-append">
								<button class="btn btn-secondary" type="button" id="texto_busqueda" title="Eliminar">
				        			<i class="fa fa-trash"></i>
								</button>
						    </div>
						<?php } else { ?>
						    <input type="text" class="form-control" placeholder="Buscador por cedula" id="txt_buscador">
						    <div class="input-group-append">
								<button class="btn btn-secondary btn_buscar" type="button" title="Buscador">
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
							<!-- <th>Cliente</th> -->
							<th>NNombre cliente</th>
							<th>Identificación</th>
							<th>Celular</th>
							<th>Valor cuota</th>
							<th>Estado</th>
							<th>Fecha registro</th>
							<th class="actions">Acciones</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($credits as $credit): ?>
						<tr>
							<!-- <td>
								<?php echo $this->Html->link($credit['User']['name'], array('controller' => 'users', 'action' => 'view', $credit['User']['id'])); ?>
							</td> -->
							<td><?php echo h($credit['Credit']['nombre_persona']).' '.h($credit['Credit']['apellido_persona']); ?>&nbsp;</td>
							<td><?php echo h($credit['Credit']['cedula_persona']); ?>&nbsp;</td>
							<td><?php echo h($credit['Credit']['telefono_persona']); ?>&nbsp;</td>
							<td><?php echo h(number_format($credit['Credit']['valor_cuota'],0,",",".")); ?>&nbsp;</td>
							<td><?php echo $this->Utilities->estados_creditos($credit['Credit']['state']); ?>&nbsp;</td>
							<td><?php echo h($credit['Credit']['created']); ?>&nbsp;</td>
							<td class="actions">
								<a href="<?php echo $this->Html->url(array('action' => 'view', $credit['Credit']['id'])) ?>" data-toggle="tooltip" data-placement="top" title="Ver credito">
									<i class="fa fa-fw fa-eye"></i>
								</a>
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

		<?php } ?>
	</div>
</div>


<?php
	if (AuthComponent::user('role') == 'admin') {
		echo $this->Html->css("controller/credits/indexA.css?".rand(),							array('block' => 'AppCss'));

		echo $this->Html->script("controller/credits/indexA.js?".rand(),						array('block' => 'AppScript'));
	} else {
		echo $this->Html->script("controller/credits/index.js?".rand(),							array('block' => 'AppScript'));
	}
?>