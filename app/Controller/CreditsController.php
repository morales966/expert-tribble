<?php
App::uses('AppController', 'Controller');

class CreditsController extends AppController {
    
	public $components = array('Paginator');

	public function index() {
        $this->deleteCache();
        $get                        = $this->request->query;
        $roles                      = array(Configure::read('variables.rolCliente'),Configure::read('variables.roles.Finanzas'));
        if (!in_array(AuthComponent::user('role'), $roles)) {
            $conditions                 = array(
                                            'Credit.state' => Configure::read('variables.nombres_estados_creditos.Pagado')
                                        );
            $creditos_solicitud                     = array();
            $creditos_estudio                       = array();
            $creditos_detenido                      = array();
            $creditos_aprobado_no_retirado          = array();
            $creditos_aprobado_retirado             = array();
            $creditos_negado                        = array();
            if (!empty($get)) {
                switch ($get['filterState']) {
                    case 0:
                        $creditos_negado                      = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Negado'));
                        break;
                    case 1:
                        $creditos_solicitud                   = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Solicitud'));
                        break;
                    case 2:
                        $creditos_estudio                     = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.En_estudio'));
                        break;
                    case 3:
                        $creditos_detenido                    = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Detenido'));
                        break;
                    case 4:
                        $creditos_aprobado_no_retirado        = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'));
                        break;
                    case 5:
                        $creditos_aprobado_retirado           = $this->Credit->all_data_state(array(Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'),Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')));
                        break;
                }
            } else {
               $creditos_solicitud                   = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Solicitud'));
                if (AuthComponent::user('role') == Configure::read('variables.roles.Analista_credito')) {
                    $creditos_estudio                     = $this->Credit->all_data_state_user_id(Configure::read('variables.nombres_estados_creditos.En_estudio'),AuthComponent::user('id'));
                    $creditos_detenido                    = $this->Credit->all_data_state_user_id(Configure::read('variables.nombres_estados_creditos.Detenido'),AuthComponent::user('id'));
                    $creditos_aprobado_no_retirado        = $this->Credit->all_data_state_user_id(Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'),AuthComponent::user('id'));
                    $array_aprobado_retirado              = array(Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'),Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso'));
                    $creditos_aprobado_retirado           = $this->Credit->all_data_state_user_id($array_aprobado_retirado,AuthComponent::user('id'));
                    $creditos_negado                      = $this->Credit->all_data_state_user_id(Configure::read('variables.nombres_estados_creditos.Negado'),AuthComponent::user('id'));
                } else {
                    $creditos_estudio                     = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.En_estudio'));
                    $creditos_detenido                    = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Detenido'));
                    $creditos_aprobado_no_retirado        = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'));
                    $creditos_aprobado_retirado           = $this->Credit->all_data_state(array(Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'),Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')));
                    $creditos_negado                      = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Negado'));
                }
            }
        } else {
            $creditos_solicitud                     = array();
            $creditos_estudio                       = array();
            $creditos_detenido                      = array();
            $creditos_aprobado_no_retirado          = array();
            $creditos_aprobado_retirado             = array();
            $creditos_negado                        = array();
            if (!empty($get)) {
                if (isset($get['q'])) {
                    if (AuthComponent::user('role') == Configure::read('variables.roles.Finanzas')) {
                        $conditions             = array(
                                                    'OR' => array(
                                                        'Credit.cedula_persona LIKE'            => '%'.mb_strtolower($get['q']).'%'
                                                    )
                                                );
                    } else {
                        $conditions             = array(
                                                    'Credit.user_id' => AuthComponent::user('id'),
                                                    'OR' => array(
                                                        'Credit.cedula_persona LIKE'            => '%'.mb_strtolower($get['q']).'%'
                                                    )
                                                );
                    }
                    if (isset($get['filterState'])) {
                        $conditions1        = $this->filterStateGet($get['filterState']);
                        $conditions         = array_merge($conditions, $conditions1);
                    }
                } else {
                    $conditions         = $this->filterStateGet($get['filterState']);
                }
            } else {
                if (AuthComponent::user('role') == Configure::read('variables.roles.Finanzas')) {
                    $conditions         = array();
                } else {
                    $conditions         = array('Credit.user_id' => AuthComponent::user('id'));
                }
            }
        }
        $order                      = array('Credit.id' => 'desc');
        $this->paginate             = array(
                                        'order'         => $order,
                                        'limit'         => 10,
                                        'conditions'    => $conditions
                                    );
        $credits                    = $this->paginate('Credit');
		$this->set(compact('credits','creditos_solicitud','creditos_estudio','creditos_detenido','creditos_aprobado_no_retirado','creditos_aprobado_retirado','creditos_negado'));
	}

    public function filterStateGet($state){
        switch ($state) {
            case 0:
                $conditions    = array('Credit.state' => Configure::read('variables.nombres_estados_creditos.Negado'));
                break;
            case 1:
                $conditions    = array('Credit.state' => Configure::read('variables.nombres_estados_creditos.Solicitud'));
                break;
            case 2:
                $conditions    = array('Credit.state' => Configure::read('variables.nombres_estados_creditos.En_estudio'));
                break;
            case 3:
                $conditions    = array('Credit.state' => Configure::read('variables.nombres_estados_creditos.Detenido'));
                break;
            case 4:
                $conditions    = array('Credit.state' => Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'));
                break;
            case 5:
                $conditions    = array('Credit.state' => Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'));
                break;
            case 6:
                $conditions    = array('Credit.state' => Configure::read('variables.nombres_estados_creditos.Pagado'));
                break;

            default:
                $conditions    = array();
                break;
        }
        return $conditions;
    }

    public function updateState() {
        $this->autoRender               = false;
        if ($this->request->is('ajax')) {
            $state_credit                   = $this->Credit->find_state($this->request->data['credit_id']);
            switch ($this->request->data['state']) {
                case Configure::read('variables.nombres_estados_creditos.En_estudio'):
                    $state_name                         = Configure::read('variables.estados_creditos.2');
                    $cupo_aprobado                      = $this->request->data['cupo_aprobado'];
                    switch ($state_credit['Credit']['state']) {
                        case Configure::read('variables.nombres_estados_creditos.Solicitud'):
                            $validacion                         = 1;
                            $datosC['Credit']['user_asesor']    = AuthComponent::user('id');
                        break;
                        case Configure::read('variables.nombres_estados_creditos.En_estudio'):
                            $validacion                         = 2;
                        break;

                        default:
                            $validacion                         = 1;
                        break;
                    }
                    break;
                case Configure::read('variables.nombres_estados_creditos.Detenido'):
                    $validacion                         = 1;
                    $state_name                         = Configure::read('variables.estados_creditos.3');
                    $cupo_aprobado                      = $this->request->data['cupo_aprobado'];
                    break;
                case Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'):
                    $validacion                          = 1;
                    $state_name                          = Configure::read('variables.estados_creditos.4');
                    $datosC['Credit']['cupo_aprobado']   = $this->request->data['cupo_aprobado'];
                    $cupo_aprobado                       = $this->request->data['cupo_aprobado'];
                    break;
                case Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'):
                    $validacion                          = 1;
                    $state_name                          = Configure::read('variables.estados_creditos.5');
                    $cupo_aprobado                       = $this->Credit->find_cupo_aprobado($this->request->data['credit_id']);
                    $cupo_aprobado                       = $cupo_aprobado['Credit']['cupo_aprobado'];
                    break;
                case Configure::read('variables.nombres_estados_creditos.Pagado'):
                    $validacion                          = 1;
                    $state_name                          = Configure::read('variables.estados_creditos.6');
                    $cupo_aprobado                       = $this->request->data['cupo_aprobado'];
                    break;
                case Configure::read('variables.nombres_estados_creditos.Negado'):
                    $validacion                          = 1;
                    $state_name                          = Configure::read('variables.estados_creditos.0');
                    $cupo_aprobado                       = $this->request->data['cupo_aprobado'];
                    break;
            }
            if ($validacion != 2) {
                $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['credit_id'],'',$this->request->data['descripcion'],$cupo_aprobado);
                $datosC['Credit']['state']               = $this->request->data['state'];
                $datosC['Credit']['id']                  = $this->request->data['credit_id'];
                $this->Credit->save($datosC);
            }
            return $validacion;
        }
    }

    public function ver_preaprobado() {
        $this->layout                           = false;
        $cupo_aprobado                          = $this->Credit->find_cupo_aprobado($this->request->data['credit_id']);
        $valor_retiro                           = $this->Credit->Stage->sum_cupo_aprobado_state_credit(Configure::read('variables.estados_creditos.registrar_retiro_cupo'),$this->request->data['credit_id']);
         $all_registros_cupo                    = $this->Credit->Stage->all_cupo_aprobado_state_credit(Configure::read('variables.estados_creditos.registrar_retiro_cupo'),$this->request->data['credit_id']);
        $this->set(compact('cupo_aprobado','valor_retiro','all_registros_cupo'));
    }

    public function add_cupo_aprobado() {
        $this->layout                           = false;
        $credit_id                              = $this->request->data['credit_id'];
        $this->set(compact('credit_id'));
    }

    public function add_monto_reducir() {
        $this->layout                           = false;
        $variable                               = '';
        $this->set(compact('variable'));
    }

    public function addMontoReducir() {
        $this->autoRender                           = false;
        $codigo                                     = $this->request->data['user_id'];
        $monto_deducir                              = $this->request->data['monto_deducir'];
        $txt_descripcion_deducir                    = $this->request->data['txt_descripcion_deducir'];
        $datosC['Deduct']['user_id']                = $codigo;
        $datosC['Deduct']['asesor_id']              = AuthComponent::user('id');
        $datosC['Deduct']['monto']                  = $monto_deducir;
        $datosC['Deduct']['description_deducir']    = $txt_descripcion_deducir;
        $datosC['Deduct']['state']                  = Configure::read('variables.estados_monto_deducion.por_cobrar');
        $this->Credit->User->Deduct->create();
        $this->Credit->User->Deduct->save($datosC);
    }

    public function ver_cupo_aprobado() {
        $this->layout                           = false;
        $cupo_aprobado                          = $this->Credit->find_cupo_aprobado($this->request->data['credit_id']);
        $credit_id                              = $this->request->data['credit_id'];
        $this->set(compact('cupo_aprobado','credit_id'));
    }

    public function editCupoAprobado() {
        $this->autoRender                       = false;
        $cupo_aprobado                          = $this->request->data['cupo_aprobado'];
        $credit_id                              = $this->request->data['credit_id'];
        $state_name                             = Configure::read('variables.estados_creditos.editar_cupo_aprobado');
        $this->saveStage($state_name,AuthComponent::user('id'),$credit_id,'','',$cupo_aprobado);
        $datosC['Credit']['id']                 = $credit_id;
        $datosC['Credit']['cupo_aprobado']      = $cupo_aprobado;
        $this->Credit->save($datosC);
        return true;
    }

    public function add_numero() {
        $this->layout                           = false;
        $credit_id                              = $this->request->data['credit_id'];
        $this->set(compact('credit_id'));
    }

    public function addNumeroComprobanteNota() {
        $this->autoRender                           = false;
        $datosC['Credit']['id']                     = $this->request->data['credit_id'];
        $datosC['Credit']['nota']                   = $this->request->data['txt_nota'];
        $datosC['Credit']['numero_comprobante']     = $this->request->data['txt_numero'];
        $this->Credit->save($datosC);
    }

    public function descripcion_credito_negado() {
        $this->layout                           = false;
        $opciones_negado                        = Configure::read('variables.pasos_estados.razones_negado');
        $this->set(compact('opciones_negado'));
    }

    public function find_asesor_estudio() {
        $this->layout                           = false;
        $users                                  = $this->Credit->User->list_all_users();
        $user_asesor                            = $this->request->data['user_asesor'];
        $this->set(compact('users','user_asesor'));
    }

    public function view_creditos() {
        $this->layout                           = false;
        $creditos_solicitud                     = array();
        $creditos_estudio                       = array();
        $creditos_detenido                      = array();
        $creditos_aprobado_no_retirado          = array();
        $creditos_aprobado_retirado             = array();
        $creditos_negado                        = array();
    if ($this->request->is('ajax')) {
            $creditos_solicitud                   = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Solicitud'));
            $creditos_estudio                     = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.En_estudio'));
            $creditos_detenido                    = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Detenido'));
            $creditos_aprobado_no_retirado        = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'));
            $creditos_aprobado_retirado           = $this->Credit->all_data_state(array(Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'),Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')));;
            $creditos_negado                      = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Negado'));
        }
        $this->set(compact('creditos_solicitud','creditos_estudio','creditos_detenido','creditos_aprobado_no_retirado','creditos_aprobado_retirado','creditos_negado'));
    }

    public function view_modal() {
        $this->layout                           = false;
        $credit                                 = $this->Credit->all_data_credit($this->request->data['credit_id']);
        $datas_credit                           = $this->Credit->Stage->all_data_credit($this->request->data['credit_id']);
        $this->set(compact('credit','datas_credit'));
    }

    public function ver_datos_banco_cliente() {
        $this->layout                           = false;
        $credit                                 = $this->Credit->all_data_credit($this->request->data['credit_id']);
        $userDataBanco                          = $this->Credit->User->Client->all_data_user_banco($this->request->data['credit_id']);
        $this->set(compact('userDataBanco'));
    }

    public function view_user_client() {
        $this->layout                           = false;
        $credit                                 = $this->Credit->all_data_credit($this->request->data['credit_id']);
        $this->set(compact('credit'));
    }

    public function ver_deduciones() {
        $this->layout                           = false;
        $deducciones                                 = $this->Credit->User->Deduct->ver_deducciones($this->request->data['user_id']);
        $this->set(compact('deducciones'));
    }

    public function eliminarDeduccion() {
        $this->autoRender                       = false;
        $datosC['Deduct']['id']                 = $this->request->data['deduccion_id'];
        $datosC['Deduct']['state']              = Configure::read('variables.estados_monto_deducion.eliminado');
        $this->Credit->User->Deduct->save($datosC);
        return true;
    }

    public function add_comentary() {
        $this->layout                           = false;
        $credit_id                              = $this->request->data['credit_id'];
        $this->set(compact('credit_id'));
    }

    public function addComentary() {
        $this->autoRender                       = false;
        $state_name                             = Configure::read('variables.estados_creditos.description');
        $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['credit_id'],$this->request->data['txt_descripcion'],'',0);
        return true;
    }

    public function add_retiro_cupo_aprobado() {
        $this->layout                           = false;
        $credit_id                              = $this->request->data['credit_id'];
        $cupo_aprobado                          = $this->Credit->find_cupo_aprobado($this->request->data['credit_id']);
        $valor_retiro                           = $this->Credit->Stage->sum_cupo_aprobado_state_credit(Configure::read('variables.estados_creditos.registrar_retiro_cupo'),$this->request->data['credit_id']);
        $all_registros_cupo                    = $this->Credit->Stage->all_cupo_aprobado_state_credit(Configure::read('variables.estados_creditos.registrar_retiro_cupo'),$this->request->data['credit_id']);
        $this->set(compact('credit_id','cupo_aprobado','valor_retiro','all_registros_cupo'));
    }

    public function addRetiroCupo() {
        $this->autoRender                       = false;
        $state_name                             = Configure::read('variables.estados_creditos.registrar_retiro_cupo');
        $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['credit_id'],'','',$this->request->data['txt_cupo_aprobado']);
        return true;
    }

    public function adjuntar_archivo() {
        $this->layout                           = false;
        $credit_id                              = $this->request->data['credit_id'];
        $datas_credit                           = $this->Credit->Stage->archivos_credito_id($this->request->data['credit_id']);
        $this->set(compact('credit_id','datas_credit'));
    }

    public function adjuntarPlanPago() {
        $this->autoRender                       = false;
        $documento                              = $this->loadDocumentPdf($this->request->data['adjuntar_archivo'],'credits/plan_pagos');
        $state_name                             = Configure::read('variables.estados_creditos.adjuntar_plan_pagos');
        $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['id'],$this->Session->read('documento_modelo'),'',0);
        return $documento;
    }

    public function solicitudDesenvolver() {
        $this->autoRender                       = false;
        if ($this->request->is('ajax')) {
            $row                                    = $this->Credit->Stage->isset_pays_credit($this->request->data['credit_id']);
            if ($row < 1) {
                $state_name                         = Configure::read('variables.estados_creditos.registrar_retiro_cupo');
                $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['credit_id'],'','',$this->request->data['txt_cupo_aprobado']);
            }
            $datosC['Credit']['state']              = Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso');
            $datosC['Credit']['id']                 = $this->request->data['credit_id'];
            $description                            = Configure::read('variables.description_notificaciones.desenbolsar_dinero');
            $url                                    = $this->webroot.'Credits/paid_customers';
            $usuarios                               = $this->Credit->User->all_role_finanzas();
            foreach ($usuarios as $user) {
                $this->saveManagesUser($description,$user['User']['id'],$url);
            }
            $state_name                             = Configure::read('variables.estados_creditos.7');
            $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['credit_id'],'','',0);
            $this->Credit->save($datosC);
            return true;
        }
    }

    public function finalizarCredito() {
        $this->autoRender                       = false;
        if ($this->request->is('ajax')) {
            $user_id                                = $this->request->data['user_id'];
            $datosC['Credit']['state']              = Configure::read('variables.nombres_estados_creditos.Pagado');
            $datosC['Credit']['id']                 = $this->request->data['credit_id'];
            $state_name                             = Configure::read('variables.estados_creditos.6');
            $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['credit_id'],'','',0);
            $this->Credit->save($datosC);
            $this->Credit->User->Deduct->update_state_pagado($user_id);
            $description                            = Configure::read('variables.description_notificaciones.pago_realizado');
            $url                                    = $this->webroot.'Credits/index';
            $user                                   = $this->Credit->find_user_id($this->request->data['credit_id']);
            $this->saveManagesUser($description,$user['Credit']['user_id'],$url);
            return true;
        }
    }

    public function rechazarCredito() {
        $this->autoRender                       = false;
        if ($this->request->is('ajax')) {
            $datosC['Credit']['state']              = Configure::read('variables.nombres_estados_creditos.Aprobado_retirado');
            $datosC['Credit']['id']                 = $this->request->data['credit_id'];
            $state_name                             = Configure::read('variables.estados_creditos.8');
            $cupo_aprobado                          = $this->Credit->find_cupo_aprobado($this->request->data['credit_id']);
            $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['credit_id'],'','',$cupo_aprobado['Credit']['cupo_aprobado']);
            $this->Credit->save($datosC);
            $description                            = Configure::read('variables.description_notificaciones.pago_rechazado');
            $url                                    = $this->webroot.'Credits/index';
            $user                                   = $this->Credit->find_user_id($this->request->data['credit_id']);
            $this->saveManagesUser($description,$user['Credit']['user_id'],$url);
            return true;
        }
    }

    public function sumTotalStateSolicitado() {
        $this->autoRender               = false;
        $suma                           = $this->Credit->sum_total_state(Configure::read('variables.nombres_estados_creditos.Solicitud'));
        return number_format($suma[0]['total'],0,",",".");
    }

    public function sumTotalStateEstudio() {
        $this->autoRender               = false;
        $suma                           = $this->Credit->sum_total_state(Configure::read('variables.nombres_estados_creditos.En_estudio'));
        return number_format($suma[0]['total'],0,",",".");
    }

    public function sumTotalStateDetenido() {
        $this->autoRender               = false;
        $suma                           = $this->Credit->sum_total_state(Configure::read('variables.nombres_estados_creditos.Detenido'));
        return number_format($suma[0]['total'],0,",",".");
    }

    public function sumTotalValorAprobadoStateAprobadoNoRetirado() {
        $this->autoRender               = false;
        $suma                           = $this->Credit->sum_cupo_aprobado_state(Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'));
        return number_format($suma[0]['total'],0,",",".");
    }

    public function sumTotalValorAprobadoStateAprobadoRetirado() {
        $this->autoRender               = false;
        $stateArray                     = array(Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'),Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso'));
        $suma                           = $this->Credit->sum_cupo_aprobado_state($stateArray);
        return number_format($suma[0]['total'],0,",",".");
    }

    public function sumTotalStateNegado() {
        $this->autoRender               = false;
        $suma                           = $this->Credit->sum_total_state(Configure::read('variables.nombres_estados_creditos.Negado'));
        return number_format($suma[0]['total'],0,",",".");
    }

	public function add() {
		if ($this->request->is('post')) {
            $this->request->data['Credit']['numero_meses']                  = $this->request->data['select_dias'];
            unset($this->request->data['select_dias']);
			$this->request->data['Credit']['user_id'] 						= AuthComponent::user('id');
			$this->request->data['Credit']['valor_cuota'] 					= $this->replaceText($this->request->data['Credit']['valor_cuota'],".","");
			if ($this->request->data['Credit']['foto_cedula_delantera']['name'] == '') {
				$this->request->data['Credit']['foto_cedula_delantera'] 		= $this->request->data['Credit']['foto_cedula_delantera1'];
				$this->request->data['Credit']['foto_cedula_trasera'] 			= $this->request->data['Credit']['foto_cedula_trasera1'];
				$this->request->data['Credit']['foto_perfil'] 					= $this->request->data['Credit']['foto_perfil1'];
			} else {
				$foto_perfil 													= $this->loadFile($this->request->data['Credit']['foto_perfil'],'creditos/perfil','perfil','perfil','image');
				$foto_cedula_delantera 											= $this->loadFile($this->request->data['Credit']['foto_cedula_delantera'],'creditos/cedula','foto_cedula_delantera','foto_cedula_delantera','image');
				$foto_cedula_tasera 											= $this->loadFile($this->request->data['Credit']['foto_cedula_trasera'],'creditos/cedula','foto_cedula_trasera','foto_cedula_trasera','image');
				$this->request->data['Credit']['foto_cedula_delantera'] 		= $this->Session->read('archivo_foto_cedula_delantera');
				$this->request->data['Credit']['foto_cedula_trasera'] 			= $this->Session->read('archivo_foto_cedula_trasera');
				$this->request->data['Credit']['foto_perfil'] 					= $this->Session->read('archivo_perfil');
            }
			$this->Credit->create();
			if ($this->Credit->save($this->request->data['Credit'])) {
                $state_name                                                 = Configure::read('variables.estados_creditos.1');
                $this->saveStage($state_name,AuthComponent::user('id'),$this->Credit->id,'','',0);
                $description                                                = Configure::read('variables.description_notificaciones.crear_credito');
                $url                                                        = $this->webroot.'Credits/index';
                $usuarios                                                   = $this->Credit->User->all_role_coordinador_analista();
                foreach ($usuarios as $user) {
                    $this->saveManagesUser($description,$user['User']['id'],$url);
                }
				$this->deleteCache();
				$this->Session->setFlash('El crédito se ha guardado satisfactoriamente','Flash/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('El crédito no se ha guardado, por favor inténtalo más tarde','Flash/error');
				return $this->redirect(array('action' => 'add'));
			}
		}
		$this->set(compact('meses_credito'));
	}

    public function guardar_fotoCD() {
        $this->autoRender               = false;
        $imagenCodificada               = file_get_contents("php://input");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia         = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada             = base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada           = $this->foto_guardaname_foto('foto_cedula_delantera');
        $dir_to_save                    = WWW_ROOT.'img/creditos/cedula/';
        file_put_contents($dir_to_save.$nombreImagenGuardada,$imagenDecodificada);
        return $nombreImagenGuardada;
    }

    public function guardar_fotoCT() {
        $this->autoRender               = false;
        $imagenCodificada               = file_get_contents("php://input");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia         = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada             = base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada           = $this->foto_guardaname_foto('foto_cedula_trasera');
        $dir_to_save                    = WWW_ROOT.'img/creditos/cedula/';
        file_put_contents($dir_to_save.$nombreImagenGuardada,$imagenDecodificada);
        return $nombreImagenGuardada;
    }

    public function guardar_fotoFP() {
        $this->autoRender               = false;
        $imagenCodificada               = file_get_contents("php://input");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia         = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada             = base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada           = $this->foto_guardaname_foto('perfil');
        $dir_to_save                    = WWW_ROOT.'img/creditos/perfil/';
        file_put_contents($dir_to_save.$nombreImagenGuardada,$imagenDecodificada);
        return $nombreImagenGuardada;
    }

    public function foto_guardaname_foto($name_archivo) {
        return $name_archivo.'_'.uniqid().".png";;
    }

    public function payments_available() {
        $get                            = $this->request->query;
        if (!empty($get)) {
            if (isset($get['q'])) {
                $conditions                 = array(
                                                'Credit.user_id' => AuthComponent::user('id'),
                                                'Credit.state'   => array(
                                                                        Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'),
                                                                        Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')
                                                ),
                                                'OR' => array(
                                                    'Credit.cedula_persona LIKE'            => '%'.mb_strtolower($get['q']).'%'
                                                )
                                            );
            }
        } else {
            $conditions                         = array(
                                                    'Credit.user_id' => AuthComponent::user('id'),
                                                    'Credit.state' => array(
                                                                        Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'),
                                                                        Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')
                                                                    )
                                                );
        }
        $order                                  = array('Credit.id' => 'desc');
        $this->paginate                         = array(
                                                    'recursive'     => -1,
                                                    'order'         => $order,
                                                    'limit'         => 10,
                                                    'conditions'    => $conditions
                                                );
        $credits                                = $this->paginate('Credit');
        $this->set(compact('credits'));
    }

    public function paid_customers() {
        $get                            = $this->request->query;
        if (!empty($get)) {
            if (isset($get['q'])) {
                $conditions                 = array(
                                                'Credit.state'   => Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso'),
                                                'OR' => array(
                                                    'Credit.cedula_persona LIKE'            => '%'.mb_strtolower($get['q']).'%'
                                                )
                                            );
            }
        } else {
            $conditions                         = array(
                                                    'Credit.state'   => Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso'),
                                                );
        }
        $order                                  = array('Credit.id' => 'desc');
        $this->paginate                         = array(
                                                    'order'         => $order,
                                                    'limit'         => 10,
                                                    'conditions'    => $conditions
                                                );
        $credits                                = $this->paginate('Credit');
        $this->set(compact('credits'));
    }
}