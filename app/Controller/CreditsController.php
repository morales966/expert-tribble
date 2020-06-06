<?php
App::uses('AppController', 'Controller');

class CreditsController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$get 						= $this->request->query;
		if (!empty($get)) {
			if (isset($get['q'])) {
				$conditions				= array('OR' => array(
									            'Credit.cedula_persona LIKE' 			=> '%'.mb_strtolower($get['q']).'%'
									        )
										);
				if (isset($get['filterState'])) {
					$conditions1 		= $this->filterUser($get['filterState']);
					$conditions			= array_merge($conditions, $conditions1);
				}
			} else {
				$conditions 			= $this->filterUser($get['filterState']);
			}
		} else {
			if (AuthComponent::user('role') == 'admin') {
				$conditions 		= array();
			} else if (AuthComponent::user('role') == 'cliente') {
				$conditions 		= array('Credit.user_id' => AuthComponent::user('id'));
			}
		}
		$order						= array('Credit.id' => 'desc');
		$this->paginate 			= array(
										'order' 		=> $order,
							        	'limit' 		=> 10,
							        	'conditions' 	=> $conditions
							    	);
		$credits 					= $this->paginate('Credit');
		$this->set(compact('credits'));
	}

	public function filterUser($state){
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
				$this->request->data['Credit']['foto_cedula_delantera'] 		= $this->Session->read('archivo_'.'foto_cedula_delantera');
				$this->request->data['Credit']['foto_cedula_trasera'] 			= $this->Session->read('archivo_'.'foto_cedula_trasera');
				$this->request->data['Credit']['foto_perfil'] 					= $this->Session->read('archivo_'.'perfil');
			}
			$this->Credit->create();
			if ($this->Credit->save($this->request->data)) {
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


















	

	public function view($id = null) {
		if (!$this->Credit->exists($id)) {
			throw new NotFoundException(__('Invalid credit'));
		}
		$options = array('conditions' => array('Credit.' . $this->Credit->primaryKey => $id));
		$this->set('credit', $this->Credit->find('first', $options));
	}
}
