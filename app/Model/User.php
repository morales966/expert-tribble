<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $validate = array(
		'name' => array(
			'notBlank' 	=> array(
				'rule' 		=> array('notBlank'),
			),
		),
		'telephone' => array(
			'notBlank' 	=> array(
				'rule' 		=> array('notBlank'),
				'on' 		=> 'create',
			),
		),
		'email' => array(
            'rule'    => array('isUnique'),
            'message' => 'El correo electrónico ya existe en nuestra base de datos',
            'on' => 'create',
        ),
		'password' => array(
			'notBlank' 	=> array(
				'rule' 		=> array('notBlank'),
				'on'		=> 'create',
			),
		),
		'role' => array(
			'notBlank' 	=> array(
				'rule' 		=> array('notBlank'),
				'on' 		=> 'create',
			),
		),
	);

	public $hasMany = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Accessory' => array(
			'className' => 'Accessory',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Credit' => array(
			'className' => 'Credit',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Deduct' => array(
			'className' => 'Deduct',
			'foreignKey' => 'user_id',
			'dependent' => false
		)
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2020)
        * @description Metodo que encripta si llega un valor llamado password
        * @return Dato encriptado
    */
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password']) && !empty($this->data[$this->alias]['password'])){
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(24-06-2020)
        * @description Metodo que devuelve la lista de usuarios menos el rol Comercios
        * @return Lista de usuarios menos el rol Comercios
    */
	public function list_all_users() {
		$this->recursive 	= -1;
		$conditions 		= array(
								'User.role != ' => Configure::read('variables.rolCliente'),
								'User.state' 	=> Configure::read('variables.habilitado')
							);
		return $this->find('list',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(10-07-2020)
        * @description Metodo que devuelve todos los usuarios con el rol Coordinador_analista
        * @return Todos los usuarios con el rol Coordinador_analista
    */
	public function all_role_coordinador_analista() {
		$this->recursive 	= -1;
		$conditions 		= array(
								'User.role' => array(
													Configure::read('variables.roles.Administrador'),
													Configure::read('variables.roles.Administrador_secundario'),
													Configure::read('variables.roles.Coordinador_analista'),
												),
								'User.state'=> Configure::read('variables.habilitado')
							);
		return $this->find('all',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(10-07-2020)
        * @description Metodo que devuelve todos los usuarios con los roles administradores
        * @return Todos los usuarios con los roles administrador
    */
	public function all_role_administradores() {
		$this->recursive 	= -1;
		$conditions 		= array(
								'User.role' => array(
													Configure::read('variables.roles.Administrador'),
													Configure::read('variables.roles.Administrador_secundario'),
												),
								'User.state'=> Configure::read('variables.habilitado')
							);
		return $this->find('all',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(10-07-2020)
        * @description Metodo que devuelve la lista de usuarios con el rol Ejecutivo
        * @return Lista de usuarios con el rol Ejecutivo
    */
	public function all_role_ejecutivos() {
		$this->recursive 	= -1;
		$conditions 		= array(
								'User.role' => array(
													Configure::read('variables.roles.Ejecutivo'),
													Configure::read('variables.roles.Administrador'),
													Configure::read('variables.roles.Administrador_secundario'),
												),
								'User.state' 	=> Configure::read('variables.habilitado')
							);
		return $this->find('all',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(10-07-2020)
        * @description Metodo que devuelve la lista de usuarios con el rol Finanzas
        * @return Lista de usuarios con el rol Finanzas
    */
	public function all_role_finanzas() {
		$this->recursive 	= -1;
		$conditions 		= array(
								'User.role' => array(
													Configure::read('variables.roles.Finanzas'),
													Configure::read('variables.roles.Administrador'),
													Configure::read('variables.roles.Administrador_secundario'),
												),
								'User.state' 	=> Configure::read('variables.habilitado')
							);
		return $this->find('all',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(01-07-2020)
        * @description Metodo que se encarga de devolver los registros de los usuarios con rol Comercios habilitados
        * @return Los registros de los usuarios con rol Comercios habilitados
    */
	public function all_role_cliente_habilitados() {
        $conditions 			= array(
        							'User.role' 	=> Configure::read('variables.rolCliente'),
									'User.state' 	=> Configure::read('variables.habilitado')
        						);
		return $this->find('all',compact('conditions'));
	}
	
	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(23-07-2020)
        * @description Metodo que se encarga de devolver los registros de los usuarios con rol Comercios por revisar
        * @return Los registros de los usuarios con rol Comercios por revisar
    */
	public function all_role_cliente_revisar() {
        $conditions 			= array(
        							'User.role' 	=> Configure::read('variables.rolCliente'),
									'User.state' 	=> Configure::read('variables.revision')
        						);
		return $this->find('all',compact('conditions'));
	}
	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2020)
        * @description Metodo que genera el codigo para cambiar la contraseña
        * @return Codigo para cambiar la contraseña
    */
	public function generate_hash_change_password() {
	    $salt 		= Configure::read('Security.salt');
	    $salt_v2 	= Configure::read('Security.cipherSeed');
	    $rand 		= mt_rand(1,999999999);
	    $rand_v2 	= mt_rand(1,999999999);
	    return hash('sha256',$salt.$rand.$salt_v2.$rand_v2);
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2020)
        * @description Metodo para buscar los datos por el email ingresado
        * @variables $email = email del usuario
        * @return Datos por el email ingresado
    */
	public function get_user_email($email) {
		return $this->findByEmail($email);
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(19-06-2020)
        * @description Metodo para devolver el nombre del usuario
        * @variables $user_id = id del usuario
        * @return Nombre del usuario
    */
	public function name_user($user_id) {
		$fields 			= array('User.name');
		$conditions 		= array('User.id' => $user_id);
		$datos 				= $this->find('first',compact('fields','conditions'));
		return $datos['User']['name'];
	}

	
}
