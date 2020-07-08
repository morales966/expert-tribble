<?php
App::uses('AppController', 'Controller');

class CreditsController extends AppController {

	public $components = array('Paginator');

	public function index() {
        $this->deleteCache();
        if (AuthComponent::user('role') != Configure::read('variables.rolCliente')) {

             $conditions                           = array(
                                                        'Credit.state' => Configure::read('variables.nombres_estados_creditos.Pagado')
                                                  );
            $order                                = array('Credit.id' => 'desc');
            $this->paginate                       = array(
                                                        'order'         => $order,
                                                        'limit'         => 5,
                                                        'conditions'    => $conditions
                                                  );
            $credits                              = $this->paginate('Credit');
            $creditos_solicitud                   = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Solicitud'));
            $creditos_estudio                     = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.En_estudio'));
            $creditos_detenido                    = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Detenido'));
            $creditos_aprobado_no_retirado        = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'));
            $creditos_aprobado_retirado           = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'));
            $creditos_negado                      = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Negado'));

        } else {

            $get                        = $this->request->query;
            if (!empty($get)) {
                if (isset($get['q'])) {
                    $conditions             = array(
                                                'Credit.user_id' => AuthComponent::user('id'),
                                                'OR' => array(
                                                    'Credit.cedula_persona LIKE'            => '%'.mb_strtolower($get['q']).'%'
                                                )
                                            );
                    if (isset($get['filterState'])) {
                        $conditions1        = $this->filterStateGet($get['filterState']);
                        $conditions         = array_merge($conditions, $conditions1);
                    }
                } else {
                    $conditions         = $this->filterStateGet($get['filterState']);
                }
            } else {
                $conditions         = array('Credit.user_id' => AuthComponent::user('id'));
            }
            $order                      = array('Credit.id' => 'desc');
            $this->paginate             = array(
                                            'order'         => $order,
                                            'limit'         => 10,
                                            'conditions'    => $conditions
                                        );
            $credits                                = $this->paginate('Credit');
            $creditos_solicitud                     = array();
            $creditos_estudio                       = array();
            $creditos_detenido                      = array();
            $creditos_aprobado_no_retirado          = array();
            $creditos_aprobado_retirado             = array();
            $creditos_negado                        = array();
        }
		$this->set(compact('credits','creditos_solicitud','creditos_estudio','creditos_detenido','creditos_aprobado_no_retirado','creditos_aprobado_retirado','creditos_negado'));
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

    public function saveStage($state_name,$asesor_id,$credit_id,$description,$description_denied,$cupo_aprobado) {
        $datosS['Stage']['user_id']                 = $asesor_id;
        $datosS['Stage']['credit_id']               = $credit_id;
        $datosS['Stage']['state_credit']            = $state_name;
        $datosS['Stage']['description']             = $description;
        $datosS['Stage']['description_denied']      = $description_denied;
        $datosS['Stage']['cupo_aprobado']           = $cupo_aprobado;
        $this->Credit->Stage->save($datosS['Stage']);
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
        $variable                               = null;
        $this->set(compact('variable'));
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

    public function descripcion_credito_negado() {
        $this->layout                           = false;
        $opciones_negado                        = Configure::read('variables.pasos_estados.razones_negado');
        $this->set(compact('opciones_negado'));
    }

    public function find_asesor_estudio() {
        $this->layout                           = false;
        $users                                  = $this->Credit->User->list_all_role();
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
            $creditos_aprobado_retirado           = $this->Credit->all_data_state(Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'));
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

    public function add_comentary() {
        $this->layout                           = false;
        $credit_id = $this->request->data['credit_id'];
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
        $credit_id = $this->request->data['credit_id'];
        $this->set(compact('credit_id'));
    }

    public function addRetiroCupo() {
        $this->autoRender                       = false;
        $state_name                             = Configure::read('variables.estados_creditos.registrar_retiro_cupo');
        $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['credit_id'],'','',$this->request->data['txt_cupo_aprobado']);
        return true;
    }

    public function adjuntar_archivo() {
        $this->layout                           = false;
        $credit_id = $this->request->data['credit_id'];
        $this->set(compact('credit_id'));
    }

    public function adjuntarPlanPago() {
        $this->autoRender                       = false;
        $documento                              = $this->loadDocumentPdf($this->request->data['adjuntar_archivo'],'credits/plan_pagos');
        $state_name                             = Configure::read('variables.estados_creditos.adjuntar_plan_pagos');
        $this->saveStage($state_name,AuthComponent::user('id'),$this->request->data['id'],$this->Session->read('documento_modelo'),'',0);
        return $documento;
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
        $suma                           = $this->Credit->sum_cupo_aprobado_state(Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'));
        return number_format($suma[0]['total'],0,",",".");
    }

    public function sumTotalStateNegado() {
        $this->autoRender               = false;
        $suma                           = $this->Credit->sum_total_state(Configure::read('variables.nombres_estados_creditos.Negado'));
        return number_format($suma[0]['total'],0,",",".");
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
}
