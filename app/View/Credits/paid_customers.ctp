<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
        <div class="bg-white-content mb-2">
            <div class="row ">
                <div class="col-md-3">
                    <div class="content-tittles">
                        <div class="line-tittles">|</div>
                        <div>  
                            <h1>Créditos  </h1>
                            <h2>por pagar</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <a href="javascript:void(0)" class="btn btn-success mr-3 add_monto_deducir">
                        <i class="fa fa-1x fa-plus-square"></i> Registrar monto a deducir
                    </a>
                </div>
                <div class="col-md-5 text-right">
                    <div class="input-group">
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
                            <th>Código del comercio</th>
                            <th>Monto solicitado</th>
                            <th>Actualizar deduciones</th>
                            <th>Deduciones</th>
                            <th>Total a pagar</th>
                            <th>Información del pago al comercio</th>
                            <th>Estado de la solicitud</th>
                            <th>Número del comprobante</th>
                            <th>Nota</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($credits as $credit): ?>
                            <tr>
                                <td><?php echo $this->Utilities->find_codigo_cliente($credit['Credit']['user_id']); ?></td>
                                <td>
                                    <?php echo number_format($this->Utilities->find_cupo_aprobado_credito($credit['Credit']['id']),0,",",".");?>&nbsp;
                                </td>
                                <td><?php echo $this->Utilities->find_deduciones_comercio($credit['Credit']['user_id']); ?></td>
                                <td>
                                    <?php echo number_format($this->Utilities->sum_deboluciones_comercio($credit['Credit']['user_id'],$credit['Credit']['state']),0,",",".");?>&nbsp;
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver deduciones" class="ver_deducion" data-user="<?php echo $credit['Credit']['user_id']; ?>">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <?php echo number_format($this->Utilities->total_pagar($credit['Credit']['user_id'],$credit['Credit']['id'],$credit['Credit']['state']),0,",",".");?>&nbsp;
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos de la cuenta" class="datos_banco_cliente" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </td>
                                <td><?php echo $this->Utilities->estado_solicitud_pagado($credit['Credit']['state'],$credit['Credit']['numero_comprobante']); ?>&nbsp;</td>
                                <td>
                                    <?php if ($credit['Credit']['numero_comprobante'] == '') { ?>
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Registrar número de comprobante y añadir una nota" class="txt_add_numero" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    <?php } else { ?>
                                        <?php echo $credit['Credit']['numero_comprobante'] ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($credit['Credit']['numero_comprobante'] == '') { ?>
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Registrar número de comprobante y añadir una nota" class="txt_add_numero" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    <?php } else { ?>
                                        <?php echo $credit['Credit']['nota'] ?>
                                    <?php } ?>
                                </td>
                                <td class="actions">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <?php if ($credit['Credit']['numero_comprobante'] != '') { ?>
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Finalizar" class="finalizar_credito btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>" data-user="<?php echo $credit['Credit']['user_id']; ?>">
                                            <i class="fa fa-step-forward"></i>
                                        </a>
                                    <?php } else { ?>
                                         <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Rechazar pago" class="rechazar_credito btn btn-sm btn-outline-primary" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                            <i class="fa fa-lock"></i>
                                        </a>
                                    <?php } ?>
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
    echo $this->Html->script("controller/credits/paid_customers.js?".rand(),                        array('block' => 'AppScript'));
?>