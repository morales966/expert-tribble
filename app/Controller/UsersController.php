<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $components = array('Paginator');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','login','loginData','logout','remember_password','remember_password_step_2','saveContact','find_code_clients','addSolicitudCreditoUsuario');
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
        $users_clientes_habilitados 			= $this->User->all_role_cliente_habilitados();
        $users_clientes_revision				= $this->User->all_role_cliente_revisar();
		$this->set(compact('users','users_clientes_habilitados','users_clientes_revision'));
	}

	public function view($id = null) {
		if (!$this->User->exists($id)) {
            $this->Session->setFlash('No se encuentran datos de usuario','Flash/error');
            $this->redirect(array('controller' => 'Pages','action' => 'profile'));
		}
		$user 						= $this->User->get_data_model('User',$id);
		$get                        = $this->request->query;
        if (!empty($get)) {
            if (isset($get['q'])) {
	        	$conditions         	    = array(
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

	public function view_data() {
		$user_id 					= AuthComponent::user('id');
		$user 						= $this->User->get_data_model('User',$user_id);
		$this->set(compact('user','user_id'));
	}

	public function add() {
		$roles 						=  Configure::read('variables.roles');
		if ($this->request->is('post')) {
			$this->request->data['User']['password'] 					= Configure::read('variables.password');
			$this->request->data['User']['hash_change_password'] 		= '';
			$this->request->data['User']['state']				 		= Configure::read('variables.habilitado');
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$description                                               = Configure::read('variables.description_notificaciones.crear_usuario_sistema');
                $url                                                       = $this->webroot.'Users/index';
                $usuarios                                                  = $this->User->all_role_administradores();
                foreach ($usuarios as $user) {
                	if ($user['User']['id'] != AuthComponent::user('id')) {
                    	$this->saveManagesUser($description,$user['User']['id'],$url);
                	}
                }
				$correo = $this->enviarCorreoBienvenida($this->request->data['User']['email'],Configure::read('variables.password'),$this->request->data['User']['name'],$this->request->data['User']['role']);
				if ($correo) {
					$this->Session->setFlash('Se ha creado el usuario satisfactoriamente', 'Flash/success');
				} else {
					$this->Session->setFlash('Registro correctamente, pero algo a fallado al momento de enviarte el correo electrónico', 'Flash/success');
				}
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('El usuario no se ha guardado, por favor inténtalo mas tarde','Flash/error');
			}
		}
		$this->set(compact('roles'));
	}

	public function comercios() {
		$get                        = $this->request->query;
        if (!empty($get)) {
        	if (AuthComponent::user('role') == Configure::read('variables.roles.Ejecutivo')) {
        		$conditions             = array(
	                                            'Client.ejecutivo' => AuthComponent::user('id'),
	                                            'User.state' 	=> Configure::read('variables.habilitado'),
	                                            'OR' => array(
	                                                'User.email LIKE'            => '%'.mb_strtolower($get['q']).'%'
	                                            )
                                    		);
        	} else {
        		$conditions             = array(
        										'User.state' 	=> Configure::read('variables.habilitado'),
        										'OR' => array(
                                            		'User.email LIKE'            => '%'.mb_strtolower($get['q']).'%'
                                        		)
                                   	 		);
        	}
        } else {
            if (AuthComponent::user('role') == Configure::read('variables.roles.Ejecutivo')) {
           		$conditions             = array(
           									'Client.ejecutivo' => AuthComponent::user('id'),
           									'User.state' 	=> Configure::read('variables.habilitado')
           								);
            } else {
            	$conditions         	= array('User.state' 	=> Configure::read('variables.habilitado'));
            }
        }
        $order                      = array('Client.id' => 'desc');
        $this->paginate             = array(
                                        'order'         => $order,
                                        'limit'         => 10,
                                        'conditions'    => $conditions
                                    );
        $clients                    = $this->paginate('Client');
		$this->set(compact('clients'));
	}

	public function add_client() {
		$gremio 						= Configure::read('variables.lista_gremios');
		$tipo_cuenta 					= Configure::read('variables.tipos_cuenta');
		$clase 							= Configure::read('variables.lista_planes');
		$como_paga 						= Configure::read('variables.lista_como_paga');
		$cantidad_comercios 			= Configure::read('variables.lista_cantidad_comercios');
		$cuenta_con 					= Configure::read('variables.lista_cuenta_con');
		if ($this->request->is('post')) {
			$this->addClientSave();
			$this->redirect(array('controller' => 'Users','action' => 'comercios'));
		}
		$this->set(compact('gremio','tipo_cuenta','clase','como_paga','cantidad_comercios','cuenta_con'));
	}

	public function client_mail() {
		if ($this->request->is('post')) {
			$datos['User']['email'] 						= $this->request->data['User']['email'];
			$datos['User']['password'] 						= Configure::read('variables.password');
			$datos['User']['hash_change_password'] 			= '';
			$datos['User']['state']				 			= Configure::read('variables.habilitado');
			$datos['User']['role'] 							= Configure::read('variables.rolCliente');
			$datos['User']['name'] 							= Configure::read('variables.Actualizar');
			$datos['User']['telephone'] 					= Configure::read('variables.Actualizar');
			$this->User->create();
			if ($this->User->save($datos['User'])) {
				$user_id 											= $this->User->id;
				$datos['Client']['user_id'] 						= $user_id;
				$datos['Client']['nit']								= Configure::read('variables.Actualizar');
		        $datos['Client']['gremio'] 							= Configure::read('variables.Actualizar');
		        $datos['Client']['administrador'] 					= Configure::read('variables.Actualizar');
	            $datos['Client']['cedula'] 							= Configure::read('variables.Actualizar');
	            $datos['Client']['direccion'] 						= Configure::read('variables.Actualizar');
	            $datos['Client']['barrio'] 							= Configure::read('variables.Actualizar');
	            $datos['Client']['municipio'] 						= Configure::read('variables.Actualizar');
	            $datos['Client']['tel_usuario'] 					= Configure::read('variables.Actualizar');
	            $datos['Client']['banco'] 							= Configure::read('variables.Actualizar');
	            $datos['Client']['numero_cuenta'] 					= Configure::read('variables.Actualizar');
	            $datos['Client']['tipo_cuenta'] 					= Configure::read('variables.Actualizar');
	            $datos['Client']['codigo'] 							= Configure::read('variables.Actualizar');
	            $datos['Client']['nombre_propietario_cuenta'] 		= Configure::read('variables.Actualizar');
	            $datos['Client']['cedula_propietario_cuenta'] 		= Configure::read('variables.Actualizar');
	            $datos['Client']['ejecutivo'] 						= AuthComponent::user('id');
	            $datos['Client']['clase'] 							= Configure::read('variables.Actualizar');
	            $datos['Client']['como_paga'] 						= Configure::read('variables.Actualizar');
	            $datos['Client']['departamento'] 					= Configure::read('variables.Actualizar');
	            $datos['Client']['cantidad_comercios'] 				= '0';
	            $datos['Client']['cuanto_paga'] 					= Configure::read('variables.Actualizar');
	            $datos['Client']['productos_servicios'] 			= Configure::read('variables.Actualizar');
	            $datos['Client']['nombre_completo_r1'] 				= Configure::read('variables.Actualizar');
	            $datos['Client']['identificacion_r1'] 				= Configure::read('variables.Actualizar');
	            $datos['Client']['celular_r1'] 						= Configure::read('variables.Actualizar');
	            $datos['Client']['comercio_r1'] 					= Configure::read('variables.Actualizar');
	            $datos['Client']['nombre_completo_r2'] 				= Configure::read('variables.Actualizar');
	            $datos['Client']['identificacion_r2'] 				= Configure::read('variables.Actualizar');
	            $datos['Client']['celular_r2'] 						= Configure::read('variables.Actualizar');
		        $datos['Client']['comercio_r2'] 					= Configure::read('variables.Actualizar');
				$datos['Client']['adjuntar_cedula_delantera'] 		= Configure::read('variables.Actualizar');
				$datos['Client']['adjuntar_cedula_trasera'] 		= Configure::read('variables.Actualizar');
				$datos['Client']['adjuntar_camara_comercio'] 		= Configure::read('variables.Actualizar');
				$datos['Client']['adjuntar_rut'] 					= Configure::read('variables.Actualizar');
				$datos['Client']['adjuntar_administrador'] 			= Configure::read('variables.Actualizar');
				$datos['Client']['adjuntar_almacen'] 				= Configure::read('variables.Actualizar');
				$this->User->Client->create();
				if ($this->User->Client->save($datos['Client'])) {
					$correo = $this->enviarCorreoBienvenidaClientExist($datos['User']['email'],Configure::read('variables.password'),$datos['User']['name']);
					if ($correo) {
						$this->Session->setFlash('Registro correctamente, el correo electrónico fue enviado correctamente', 'Flash/success');
						$this->redirect(array('controller' => 'Users','action' => 'client_mail'));
					} else {
						$this->Session->setFlash('Registro correctamente, pero algo a fallado al momento de enviarte el correo electrónico, comunícate con el administrador del sistema', 'Flash/success');
					}
				}
			} else {
				$this->Session->setFlash('Algo salio mal, los datos no se ha guardado, por favor inténtalo mas tarde','Flash/error');
			}
		}
	}

	public function enviarCorreoBienvenidaClientExist($correo,$password,$nombreUsuario) {
		$options = array(
			'to'					=> $correo,
			// 'template'				=> 'bienvenido_usuario',
			'subject'				=> 'Bienvenido',
			'vName' 				=> $nombreUsuario,
			'vPassword' 			=> $password,
			'vclienteNuevo' 		=> true,
			'vUsuario' 				=> false,
			'vCliente' 				=> false
		);
		$r = $this->sendMail($options);
		return $r;
	}

	public function addClientSave() {
		$datos['User']['name'] 							= $this->request->data['User']['razon_social'];
		$datos['User']['email'] 						= $this->request->data['User']['email'];
		$datos['User']['telephone'] 					= $this->request->data['User']['telephone'];
		$datos['User']['role'] 							= Configure::read('variables.rolCliente');
		$datos['User']['password'] 						= Configure::read('variables.password');
		$datos['User']['hash_change_password'] 			= '';
		$datos['User']['state']				 			= Configure::read('variables.revision');
		$this->User->create();
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
            $datos['Client']['codigo'] 						= uniqid();
            $datos['Client']['nombre_propietario_cuenta'] 	= $this->request->data['User']['nombre_propietario_cuenta'];
            $datos['Client']['cedula_propietario_cuenta'] 	= $this->request->data['User']['cedula_propietario_cuenta'];
            $datos['Client']['ejecutivo'] 					= AuthComponent::user('id');
            if ($this->request->data['User']['clase'] == '390800') {
            	$datos['Client']['clase'] 						= 'Clase A';
            } else {
            	$datos['Client']['clase'] 						= 'Clase B';
            }
            $datos['Client']['como_paga'] 					= $this->request->data['User']['como_paga'];
            $datos['Client']['departamento'] 				= $this->request->data['User']['departamento'];
            $datos['Client']['cantidad_comercios'] 			= $this->request->data['User']['cantidad_comercios'];
            $datos['Client']['cuanto_paga'] 				= $this->request->data['cuanto_paga'];
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
	        $this->redirect(array('action' => 'comercios'));
		} else {
			$this->Session->setFlash('Algo salio mal, los datos no se ha guardado, por favor inténtalo mas tarde','Flash/error');
		}
		return true;
		
	}

	public function get_archives($datosClient,$data,$user_id) {
		$j 									= 0;
		if (isset($datosClient['cuenta'][$j])) {
			foreach ($data['cuenta_con'] as $valueAcces) {
				$datosClient['cuenta'][$j]['cuenta_con'] 							= $valueAcces;
				$datosClient['cuenta'][$j]['user_id']				 				= $user_id;
				$j++;
			}
		}
		$this->loadArchives($data['adjuntar_cedula_delantera'],'data_clients','adjuntar_cedula_delantera','adjuntar_cedula_delantera');
		$this->loadArchives($data['adjuntar_cedula_trasera'],'data_clients','adjuntar_cedula_trasera','adjuntar_cedula_trasera');
		$this->loadArchives($data['adjuntar_camara_comercio'],'data_clients','adjuntar_camara_comercio','adjuntar_camara_comercio');
		$this->loadArchives($data['adjuntar_rut'],'data_clients','adjuntar_rut','adjuntar_rut');
		$this->loadArchives($data['adjuntar_administrador'],'data_clients','adjuntar_administrador','adjuntar_administrador');
		$this->loadArchives($data['adjuntar_almacen'],'data_clients','adjuntar_almacen','adjuntar_almacen');
		$datosClient['Client']['adjuntar_cedula_delantera'] 					= $this->Session->read('archivo_adjuntar_cedula_delantera');
		$datosClient['Client']['adjuntar_cedula_trasera'] 						= $this->Session->read('archivo_adjuntar_cedula_trasera');
		$datosClient['Client']['adjuntar_camara_comercio'] 						= $this->Session->read('archivo_adjuntar_camara_comercio');
		$datosClient['Client']['adjuntar_rut'] 									= $this->Session->read('archivo_adjuntar_rut');
		$datosClient['Client']['adjuntar_administrador'] 						= $this->Session->read('archivo_adjuntar_administrador');
		$datosClient['Client']['adjuntar_almacen'] 								= $this->Session->read('archivo_adjuntar_almacen');
		$this->User->Client->create();
		if ($this->User->Client->save($datosClient)) {
			$this->User->Accessory->create();
			if (isset($datosClient['cuenta'])) {
				$this->User->Accessory->saveAll($datosClient['cuenta']);
			}
			$description                                               = Configure::read('variables.description_notificaciones.crear_cliente');
            $url                                                       = $this->webroot.'Users/index';
            $usuarios                                                  = $this->User->all_role_administradores();
            foreach ($usuarios as $user) {
                $this->saveManagesUser($description,$user['User']['id'],$url);
            }
			$correo = $this->enviarCorreoBienvenida($datosClient['User']['email'],Configure::read('variables.password'),$datosClient['User']['name'],Configure::read('variables.rolCliente'));
			if ($correo) {
				$this->Session->setFlash('Registro correctamente, revisa el correo eléctronico y sigue las instrucciones, recuerda revisar la carpeta spam', 'Flash/success');
			} else {
				$this->Session->setFlash('Registro correctamente, pero algo a fallado al momento de enviarte el correo electrónico, comunícate con un asesor', 'Flash/success');
			}
		} else {
			$this->Session->setFlash('Algo fallo, el registro no fue satisfactorio, por favor inténtalo mas tarde','Flash/error');
		}
	}

	public function enviarCorreoBienvenida($correo,$password,$nombreUsuario,$rol) {
		$options = array(
			'to'		=> $correo,
			// 'template'	=> 'bienvenido_usuario',
			'subject'	=> 'Bienvenido',
			'vName' 	=> $nombreUsuario,
			'vPassword' => $password,
			'vUsuario' 	=> true,
			'vCliente' 	=> false
		);
		$r = $this->sendMail($options);
		return $r;
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
				$this->Session->setFlash('Correo electrónico o contraseña incorrectos', 'Flash/error');
			}
			return true;
		}
	}

	public function validStateConnexion($state) {
		$this->Session->destroy();
		if ($state == Configure::read('variables.revision')) {
			$this->Session->setFlash('Un asesor se encuentra revisando tu registro', 'Flash/error');
		} else {
			$this->Session->setFlash('Comunícate con el administrador ya que tu cuenta esta deshabilitada', 'Flash/error');
		}
	}

	public function logout() {
		if (AuthComponent::user('id')) {
			echo AuthComponent::user('id');
			return $this->redirect($this->Auth->logout());
		} else {
            $this->Session->setFlash('La sesión se ha perdido, por favor vuélvete a iniciar sesión','Flash/error');
			$this->redirect(array('controller' => 'Pages','action' => 'home'));
		}
	}

	public function remember_password(){
        $this->layout = "landing";
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
					'id' 					=> $user['User']['id'],
					'hash_change_password'	=> $hash
				)
			);
			$this->User->save($data);
			$options = array(
				'to'		=> $this->request->data['User']['email'],
				// 'template'	=> 'remember_password',
				'subject'	=> '¡Ya puedes restablecer tu contraseña!',

				'vHash' 	=> $hash,
				'vName' 	=> $user['User']['name'],
				'vUsuario' 	=> false,
				'vCliente' 	=> false

			);
			if ($this->sendMail($options)) {
				$this->Session->setFlash('Ahora ingresa a tu correo electrónico y sigue las instrucciones', 'Flash/success');
			} else {
				$this->Session->setFlash('Algo fallo, Intentalo mas tarde, comunícate con un asesor', 'Flash/error');
			}
			$this->redirect(array('controller'=>'Pages','action' => 'home'));
		}
	}

	public function remember_password_step_2($hash = null) {
        $this->layout = "landing";
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

	public function changestate(){
		$this->autoRender 						= false;
		if ($this->request->is('ajax')) {
			$datosA 								= $this->User->get_data('User',$this->request->data['user_id']);
			$datosN['User']['state']				= $this->request->data['state'];
			$datosN['User']['id']					= $this->request->data['user_id'];
			$this->User->save($datosN);
		}
		return true;
	}

	public function saveContact() {
		$this->autoRender 							= false;
		$this->loadModel('Contact');
        $this->autoRender          					= false;
        $description                                = Configure::read('variables.description_notificaciones.dejar_datos');
        $url                                        = $this->webroot.'Users/messages_data';
        $usuarios                                   = $this->User->all_role_ejecutivos();
        foreach ($usuarios as $user) {
            $this->saveManagesUser($description,$user['User']['id'],$url);
        }
        $this->request->data['Contact']['state']    = Configure::read('variables.noti_por_leer');
		$this->Contact->save($this->request->data['Contact']);
	}

	public function changestateContact(){
		$this->autoRender 						= false;
		$this->loadModel('Contact');
		if ($this->request->is('ajax')) {
			$datosA 								= $this->Contact->get_data('Contact',$this->request->data['contact_id']);
			$datosN['Contact']['state']				= $this->request->data['state'];
			$datosN['Contact']['id']				= $this->request->data['contact_id'];
			$this->Contact->save($datosN);
		}
		return true;
	}

	public function messages_data() {
		$this->loadModel('Contact');
		$contacs 									= $this->Contact->all_datos();
		$this->set(compact('contacs'));
	}

	public function find_code_clients() {
		$this->layout 					= false;
        if ($this->request->is('ajax')) {
            $txt_codigo                     = $this->request->data['txt_codigo'];
            $user_id 						= $this->User->Client->find_code_client_solicitud_credito($txt_codigo);
            if ($user_id > 0) {
				$this->set(compact('user_id'));
            } else {
				$this->autoRender 				= false;
            	return $user_id;
            }
        }
    }

    public function addSolicitudCreditoUsuario() {
		$this->autoRender 				= false;
        if ($this->request->is('ajax')) {
            $this->request->data['Credit']['numero_meses']                  = $this->request->data['select_dias'];
            unset($this->request->data['select_dias']);
			$this->request->data['Credit']['valor_cuota'] 					= $this->replaceText($this->request->data['Credit']['valor_cuota'],".","");
			$this->request->data['Credit']['foto_cedula_delantera'] 		= $this->request->data['Credit']['foto_cedula_delantera1'];
			$this->request->data['Credit']['foto_cedula_trasera'] 			= $this->request->data['Credit']['foto_cedula_trasera1'];
			$this->request->data['Credit']['foto_perfil'] 					= $this->request->data['Credit']['foto_perfil1'];
			$this->User->Credit->create();
			if ($this->User->Credit->save($this->request->data['Credit'])) {
                $state_name                                                 = Configure::read('variables.estados_creditos.1');
                $this->saveStage($state_name,AuthComponent::user('id'),$this->Credit->id,'','',0);
                $description                                                = Configure::read('variables.description_notificaciones.crear_credito');
                $url                                                        = $this->webroot.'Credits/index';
                $usuarios                                                   = $this->User->all_role_coordinador_analista();
                $description_cliente                                        = Configure::read('variables.description_notificaciones.crear_credito_cliente');
                foreach ($usuarios as $user) {
                    $this->saveManagesUser($description,$user['User']['id'],$url);
                }
                $this->saveManagesUser($description_cliente,$this->request->data['Credit']['user_id'],$url);
				$this->Session->setFlash('El crédito se ha guardado satisfactoriamente','Flash/success');
				return $this->redirect(array('controller' => 'Pages','action' => 'home'));
			} else {
				$this->Session->setFlash('El crédito no se ha guardado, por favor inténtalo más tarde','Flash/error');
				return $this->redirect(array('controller' => 'Pages','action' => 'home'));
			}
		}
    }
}