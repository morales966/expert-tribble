<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $components = array('Paginator');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','login','loginData','logout','remember_password','remember_password_step_2','add_client','addClientSave');
    }

	public function index() {
		$get                        = $this->request->query;
        if (!empty($get)) {
            $conditions            		= array('OR' => array(
                                            	'User.email LIKE'            => '%'.mb_strtolower($get['q']).'%'
                                        	)
                                    	);
        } else {
            $conditions 				= array('User.role !=' => Configure::read('variables.rolCliente'));
        }
		$recursive 								= 0;
        $order                                	= array('User.id' => 'desc');
        $this->paginate                       	= array(
                                                    'order'         => $order,
                                                    'limit'         => 6,
                                                    'recursive'		=> $recursive,
                                                    'conditions'    => $conditions
                                              	);
        $users                              	= $this->paginate('User');
        $users_clientes 						= $this->User->all_role_cliente();
		$this->set(compact('users','users_clientes'));
	}

	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$user 						= $this->User->get_data('User',$id);
		$get                        = $this->request->query;
        if (!empty($get)) {
            if (isset($get['q'])) {
		        $conditions         	    	= array(
	        										'Credit.user_id' => $id,
	                								'OR' => array(
	                                                	'Credit.cedula_persona LIKE'            => '%'.mb_strtolower($get['q']).'%'
	                                            	)
		                                        );
            }
        } else {
            $conditions         		= array('Credit.user_id' => $id);
        }
	    $order                  	= array('Credit.id' => 'desc');
        $this->paginate 			= array(
	        							'Credit' => array(
		                            		'order'         => $order,
		                                	'limit'         => 5,
		                                	'conditions'    => $conditions
		                            	));
    	$credits 					= $this->paginate('Credit');
		$this->set(compact('user','id','credits'));
	}

	public function add() {
		$roles 						=  Configure::read('variables.roles');
		if ($this->request->is('post')) {
			$this->request->data['User']['password'] 					= Configure::read('variables.password');
			$this->request->data['User']['hash_change_password'] 		= '';
			$this->request->data['User']['state']				 		= Configure::read('variables.habilitado');
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->enviarCorreoBienvenida($this->request->data['User']['email'],Configure::read('variables.password'),$this->request->data['User']['name'],$this->request->data['User']['role']);
				$description                                               = Configure::read('variables.description_notificaciones.crear_usuario_sistema');
                $url                                                       = $this->webroot.'Users/index';
                $usuarios                                                  = $this->User->all_role_administradores();
                foreach ($usuarios as $user) {
                	if ($user['User']['id'] != AuthComponent::user('id')) {
                    	$this->saveManagesUser($description,$user['User']['id'],$url);
                	}
                }
				$this->Session->setFlash('Se ha creado el usuario satisfactoriamente', 'Flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('El usuario no se ha guardado, por favor inténtalo mas tarde','Flash/error');
			}
		}
		$this->set(compact('roles'));
	}

	public function add_client() {
		$this->layout 					= false;
		$gremio 						= Configure::read('variables.lista_gremios');
		$tipo_cuenta 					= Configure::read('variables.tipos_cuenta');
		$ejecutivo 						= $this->User->list_all_role_ejecutivos();
		$clase 							= Configure::read('variables.lista_planes');
		$como_paga 						= Configure::read('variables.lista_como_paga');
		$cantidad_comercios 			= Configure::read('variables.lista_cantidad_comercios');
		$cuenta_con 					= Configure::read('variables.lista_cuenta_con');
		$this->set(compact('gremio','tipo_cuenta','ejecutivo','clase','como_paga','cantidad_comercios','cuenta_con'));
	}

	public function addClientSave() {
		$this->autoRender 				= false;
		if ($this->request->is('ajax')) {
			$datos['User']['name'] 							= $this->request->data['User']['razon_social'];
			$datos['User']['email'] 						= $this->request->data['User']['email'];
			$datos['User']['telephone'] 					= $this->request->data['User']['telephone'];
			$datos['User']['role'] 							= Configure::read('variables.rolCliente');
			$datos['User']['password'] 						= Configure::read('variables.password');
			$datos['User']['hash_change_password'] 			= '';
			$datos['User']['state']				 			= Configure::read('variables.revision');
			if ($this->User->save($datos['User'])) {
				$user_id 										= $this->User->id;
				$datos['Client']['user_id'] 					= $user_id;
				$datos['Client']['nit']							= $this->request->data['User']['nit'];
		        $datos['Client']['gremio'] 						= $this->request->data['User']['gremio'];
		        $datos['Client']['administrador'] 				= $this->request->data['User']['administrador'];
	            $datos['Client']['cedula'] 						= $this->request->data['User']['cedula'];
	            $datos['Client']['direccion'] 					= $this->request->data['User']['direccion'];
	            $datos['Client']['barrio'] 						= $this->request->data['User']['barrio'];
	            $datos['Client']['municipio'] 					= $this->request->data['User']['municipio'];
	            $datos['Client']['tel_usuario'] 				= $this->request->data['User']['tel_usuario'];
	            $datos['Client']['banco'] 						= $this->request->data['User']['banco'];
	            $datos['Client']['numero_cuenta'] 				= $this->request->data['User']['numero_cuenta'];
	            $datos['Client']['tipo_cuenta'] 				= $this->request->data['User']['tipo_cuenta'];
	            $datos['Client']['nombre_propietario_cuenta'] 	= $this->request->data['User']['nombre_propietario_cuenta'];
	            $datos['Client']['cedula_propietario_cuenta'] 	= $this->request->data['User']['cedula_propietario_cuenta'];
	            $datos['Client']['ejecutivo'] 					= $this->request->data['User']['ejecutivo'];
	            $datos['Client']['clase'] 						= $this->request->data['User']['clase'];
	            $datos['Client']['como_paga'] 					= $this->request->data['User']['como_paga'];
	            $datos['Client']['departamento'] 				= $this->request->data['User']['departamento'];
	            $datos['Client']['cantidad_comercios'] 			= $this->request->data['User']['cantidad_comercios'];
	            $datos['Client']['cuanto_paga'] 				= $this->request->data['User']['cuanto_paga'];
	            $datos['Client']['productos_servicios'] 		= $this->request->data['User']['productos_servicios'];
	            $datos['Client']['nombre_completo_r1'] 			= $this->request->data['User']['nombre_completo_r1'];
	            $datos['Client']['identificacion_r1'] 			= $this->request->data['User']['identificacion_r1'];
	            $datos['Client']['celular_r1'] 					= $this->request->data['User']['celular_r1'];
	            $datos['Client']['comercio_r1'] 				= $this->request->data['User']['comercio_r1'];
	            $datos['Client']['nombre_completo_r2'] 			= $this->request->data['User']['nombre_completo_r2'];
	            $datos['Client']['identificacion_r2'] 			= $this->request->data['User']['identificacion_r2'];
	            $datos['Client']['celular_r2'] 					= $this->request->data['User']['celular_r2'];
		        $datos['Client']['comercio_r2'] 				= $this->request->data['User']['comercio_r2'];
		        $get_data 										= array(
		        	'cuenta_con' 									=> $this->request->data['User']['accessories'],
		        	'adjuntar_cedula_delantera' 					=> $this->request->data['User']['adjuntar_cedula_delantera'],
		        	'adjuntar_cedula_trasera' 						=> $this->request->data['User']['adjuntar_cedula_trasera'],
		        	'adjuntar_camara_comercio' 						=> $this->request->data['User']['adjuntar_camara_comercio'],
		        	'adjuntar_rut' 									=> $this->request->data['User']['adjuntar_rut'],
		        	'adjuntar_administrador' 						=> $this->request->data['User']['adjuntar_administrador'],
		        	'adjuntar_almacen' 								=> $this->request->data['User']['adjuntar_almacen']
		        );
		        $this->get_archives($datos,$get_data,$user_id);
			} else {
				$this->Session->setFlash('Los datos no se ha guardado, por favor inténtalo mas tarde','Flash/error');
			}
			return true;
		}
	}

	public function get_archives($datosClient,$data,$user_id) {
		$j 											= 0;
		foreach ($data['cuenta_con'] as $valueAcces) {
			$datosClient['cuenta'][$j]['cuenta_con'] 							= $valueAcces;
			$datosClient['cuenta'][$j]['user_id']				 				= $user_id;
			$j++;
		}
		$this->User->Accessory->create();
		$this->User->Accessory->saveAll($datosClient['cuenta']);
		$this->loadArchives($data['adjuntar_cedula_delantera'],'data_clients','adjuntar_cedula_delantera','adjuntar_cedula_delantera');
		$this->loadArchives($data['adjuntar_cedula_trasera'],'data_clients','adjuntar_cedula_trasera','adjuntar_cedula_trasera');
		$this->loadArchives($data['adjuntar_camara_comercio'],'data_clients','adjuntar_camara_comercio','adjuntar_camara_comercio');
		$this->loadArchives($data['adjuntar_rut'],'data_clients','adjuntar_rut','adjuntar_rut');
		$this->loadArchives($data['adjuntar_administrador'],'data_clients','adjuntar_administrador','adjuntar_administrador');
		$this->loadArchives($data['adjuntar_almacen'],'data_clients','adjuntar_almacen','adjuntar_almacen');
		$datosClient['Client']['adjuntar_cedula_delantera'] 					= $this->Session->read('archivo_adjuntar_cedula_delantera');
		$datosClient['Client']['adjuntar_cedula_trasra'] 						= $this->Session->read('archivo_adjuntar_cedula_trasera');
		$datosClient['Client']['adjuntar_camara_comercio'] 						= $this->Session->read('archivo_adjuntar_camara_comercio');
		$datosClient['Client']['adjuntar_rut'] 									= $this->Session->read('archivo_adjuntar_rut');
		$datosClient['Client']['adjuntar_administrador'] 						= $this->Session->read('archivo_adjuntar_administrador');
		$datosClient['Client']['adjuntar_almacen'] 								= $this->Session->read('archivo_adjuntar_almacen');
		if ($this->User->Client->save($datosClient)) {
			$description                                               = Configure::read('variables.description_notificaciones.crear_usuario_sistema');
            $url                                                       = $this->webroot.'Users/index';
            $usuarios                                                  = $this->User->all_role_administradores();
            foreach ($usuarios as $user) {
            	if ($user['User']['id'] != AuthComponent::user('id')) {
                	$this->saveManagesUser($description,$user['User']['id'],$url);
            	}
            }
			$this->enviarCorreoBienvenida($datos['User']['email'],Configure::read('variables.password'),$datos['User']['name'],Configure::read('variables.rolCliente'));
			$this->Session->setFlash('Registro correctamente, revisa el correo eléctronico y sigue las instrucciones, recuerda revisar la carpeta spam', 'Flash/success');
		} else {
			$this->Session->setFlash('Los datos no se ha guardado, por favor inténtalo mas tarde','Flash/error');
		}
	}

	public function enviarCorreoBienvenida($correo,$password,$nombreUsuario,$rol) {
		if ($rol == Configure::read('variables.rolCliente')) {
			$options = array(
				'to'		=> $correo,
				'template'	=> 'bienvenido_cliente',
				'subject'	=> 'Bienvenido',
				'vars'		=> array('name' => $nombreUsuario,'password' => $password),
				'file'		=> 'files/terminos.pdf'
			);
		} else {
			$options = array(
				'to'		=> $correo,
				'template'	=> 'bienvenido_usuario',
				'subject'	=> 'Bienvenido',
				'vars'		=> array('name' => $nombreUsuario,'password' => $password),
			);
		}
		$this->sendMail($options);
	}

	public function profile() {
		$user 					= $this->User->get_data('User',AuthComponent::user('id'));
		if ($this->request->is('post')) {
			if (isset($this->request->data['User']['email'])) {
				unset($this->request->data['User']['email']);
			}
			if (isset($this->request->data['User']['role'])) {
				unset($this->request->data['User']['role']);
			}
			$this->request->data['User']['id']			= AuthComponent::user('id');
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('La información se ha guardado satisfactoriamente', 'Flash/success');
				$this->overwrite_session_user();
				$this->redirect(array('action' => 'profile'));
			} else {
				$this->Session->setFlash('La información no se ha guardado, por favor inténtalo mas tarde','Flash/error');
			}
		}
		$this->set(compact('user'));
	}

	public function changePasswordUser(){
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$datos 		= $this->User->get_data('User',AuthComponent::user('id'));
			$actual 	= AuthComponent::password($this->request->data['actual']);
			$nueva 		= $this->request->data['nueva'];
			if ($actual == $datos['User']['password']) {
				$datos['User']['password'] = $nueva;
				if ($this->User->save($datos)) {
					return 1;
				} else {
					return 0;
				}
			} else {
				return 2;
			}
		}
	}

	public function overwrite_session_user(){
		$user 				= $this->User->get_data('User',AuthComponent::user('id'));
        $this->Session->write('Auth.User', $user['User'], true);
	}

	public function evitarExpiracion(){
		$this->autoRender 				= false;
    	@session_start();
    }

	public function login() {
		$this->layout 					= false;
	}

	public function loginData(){
		$this->autoRender 				= false;
		if ($this->request->is('ajax')) {
			$this->request->data['User']['email'] 			= $this->request->data['email'];
    		$this->request->data['User']['password'] 		= $this->request->data['contrasena'];
			if ($this->Auth->login()) {
				if (AuthComponent::user('state') != Configure::read('variables.habilitado')) {
					$this->validStateConnexion(AuthComponent::user('state'));
				} else {
					$this->Session->setFlash('Bienvenido', 'Flash/success');
					// $this->paintValidateMenu(AuthComponent::user('role'));
				}
			} else {
				$this->Session->setFlash('Correo electrónico o contraseña incorrectos', 'Flash/Error');
			}
			return true;
		}
	}

	public function validStateConnexion($state) {
		$this->Session->destroy();
		if ($state == Configure::read('variables.revision')) {
			$this->Session->setFlash('Un asesor se encuentra revisando tu registro', 'Flash/Error');
		} else {
			$this->Session->setFlash('Comunícate con el administrador ya que tu cuenta esta deshabilitada', 'Flash/Error');
		}
	}

	public function logout() {
		if (AuthComponent::user('id')) {
			echo AuthComponent::user('id');
			return $this->redirect($this->Auth->logout());
		} else {
			$this->redirect(array('controller' => 'Pages','action' => 'home'));
		}
	}

	public function remember_password(){
		$this->validateSessionTrue();
		if ($this->request->is('post')) {
			$user = $this->User->get_user_email($this->request->data['User']['email']);
			if (empty($user)) {
				$this->Session->setFlash('El correo electrónico no existe en nuestra base de datos','Flash/error');
				$this->redirect(array('controller'=>'Pages','action' => 'home'));
			}
			$hash = $this->User->generate_hash_change_password();
			$data = array(
				'User' => array(
					'id' => $user['User']['id'],
					'hash_change_password' => $hash
				)
			);
			$this->User->save($data);
			$options = array(
				'to'		=> $this->request->data['User']['email'],
				'template'	=> 'remember_password',
				'subject'	=> '¡Ya puedes restablecer tu contraseña!',
				'vars'		=> array('hash' => $hash, 'name' => $user['User']['name']),
			);
			$this->sendMail($options);
			$this->Session->setFlash('Ahora ingresa a tu correo electrónico y sigue las instrucciones', 'Flash/success');
			$this->redirect(array('controller'=>'Pages','action' => 'home'));
		}
	}

	public function remember_password_step_2($hash = null) {
		$user = $this->User->findByHashChangePassword($hash);
		if ($user['User']['hash_change_password'] != $hash || empty($user)) {
			$this->Session->setFlash('Ocurrió un error, por favor vuelve a restablecer la contraseña','Flash/error');
			$this->redirect(array('controller'=>'Pages','action' => 'home'));
		}
		if ($this->request->is('post')) {
			if ($this->request->data['User']['password'] === $this->request->data['User']['re_password']) {
				$this->request->data['User']['id'] = $user['User']['id'];
				$this->request->data['User']['hash_change_password'] = '';
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash('Se guardó la contraseña satisfactoriamente', 'Flash/success');
				} else {
					$this->Session->setFlash('No se pudo guardar la contraseña','Flash/error');
				}
				$this->redirect(array('controller'=>'Pages','action' => 'home'));
			}
		}
		$this->set(compact('hash'));
	}

}