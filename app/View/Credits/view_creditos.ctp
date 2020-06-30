<div class="panel panel-primary kanban-col">
                        <div class="panel-heading">
                            <strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.1') ?></strong>
                        </div>
                        <span class="txt_cantidad_div" id="txt_cantidad_solicitud"></span>
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
                                                        <strong><?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
                                                        <span class="txt_cuotas">
                                                            <?php echo h($credit['Credit']['numero_meses']).' cuotas:';?>
                                                            <?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
                                                        </span>
                                                    </p>
                                                    <span>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
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
                            <strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.2') ?></strong>
                        </div>
                        <span class="txt_cantidad_div" id="txt_cantidad_estudio"></span>
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
                                                    <p>
                                                        <strong><?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
                                                        <span class="txt_cuotas">
                                                            <?php echo h($credit['Credit']['numero_meses']).' cuotas:';?>
                                                            <?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
                                                        </span>
                                                    </p>
                                                    <span>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver asesor" class="ver_asesor" data-asesor="<?php echo $credit['Credit']['user_asesor']; ?>">
                                                            <i class="fa fa-user"></i>
                                                        </a>
                                                        <a data-toggle="tooltip" title="Descargar foto de perfil" download href="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" >
                                                            <i class="fa fa-file-image-o"></i>
                                                        </a>
                                                        <a data-toggle="tooltip" title="Descargar cedula delantera" download href="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>" >
                                                            <i class="fa fa-file-image-o"></i>
                                                        </a>
                                                        <a data-toggle="tooltip" title="Descargar cedula trasera" download href="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" >
                                                            <i class="fa fa-file-image-o"></i>
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
                        <p class="txt_total_estado">Total: <span id="total_estudio"></span></p>
                    </div>

                    <div class="panel panel-primary kanban-col">
                        <div class="panel-heading">
                            <strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.3') ?></strong>
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
                                                    <p>
                                                        <strong><?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
                                                        <span class="txt_cuotas">
                                                            <?php echo h($credit['Credit']['numero_meses']).' cuotas:';?>
                                                            <?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
                                                        </span>
                                                    </p>
                                                    <span>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
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
                        <p class="txt_total_estado">Total: <span id="total_detenido"></span></p>
                    </div>

                    <div class="panel panel-primary kanban-col">
                        <div class="panel-heading">
                            <strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.4') ?></strong>
                        </div>
                        <span class="txt_cantidad_div" id="txt_cantidad_aprobado_no_retirado"></span>
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
                                                    <p>
                                                        <strong><?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
                                                        <span class="txt_cuotas">
                                                            <?php echo h($credit['Credit']['numero_meses']).' cuotas:';?>
                                                            <?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
                                                        </span>
                                                    </p>
                                                    <span>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver cupo aprobado" class="ver_cupo_aprobado" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-sort-numeric-asc"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Añadir comentario" class="btn_comentario" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-comment-o"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Enviar mensaje de texto" class="btn_mensaje_texto" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-mobile"></i>
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
                        <p class="txt_total_estado">Total: <span id="total_aprobado_no_retirado"></span></p>
                    </div>

                    <div class="panel panel-primary kanban-col">
                        <div class="panel-heading">
                            <strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.5') ?></strong>
                        </div>
                        <span class="txt_cantidad_div" id="txt_cantidad_aprobado_retirado"></span>
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
                                                    <p>
                                                        <strong><?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
                                                        <span class="txt_cuotas">
                                                            <?php echo h($credit['Credit']['numero_meses']).' cuotas:';?>
                                                            <?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
                                                        </span>
                                                    </p>
                                                    <span>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Adjuntar plan pago" class="adjuntar_plan_pago" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-paperclip"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver preaprobado" class="ver_preaprobado" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-sort-numeric-desc"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Registrar cupo retirado" class="registrar_cupo_aprobado" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver cupo aprobado" class="ver_cupo_aprobado" data-uid="<?php echo $credit['Credit']['id']; ?>">
                                                            <i class="fa fa-sort-numeric-asc"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
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
                        <p class="txt_total_estado">Total: <span id="total_aprobado_retirado"></span></p>
                    </div>

                    <div class="panel panel-primary kanban-col">
                        <div class="panel-heading">
                            <strong class="txt_titulo_etapa"><?php echo Configure::read('variables.estados_creditos.0') ?></strong>
                        </div>
                        <span class="txt_cantidad_div" id="txt_cantidad_negado"></span>
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
                                                    <p>
                                                        <strong><?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?></strong>
                                                        <span class="txt_cuotas">
                                                            <?php echo h($credit['Credit']['numero_meses']).' cuotas:';?>
                                                            <?php echo h(number_format($credit['Credit']['valor_cuota'],0,",","."));?>
                                                        </span>
                                                    </p>
                                                    <span>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
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