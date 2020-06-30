<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'telephone' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'on' => 'create',
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'on' => 'create',
			),
		),
	);

	public $hasMany = array(
		'Credit' => array(
			'className' => 'Credit',
			'foreignKey' => 'user_id',
			'dependent' => false
		)
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2019)
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
        * @date(24-06-2019)
        * @description Metodo que devuelve la lista de usuarios
        * @return Lista de usuarios
    */
	public function list_all_role() {
		$this->recursive 	= -1;
		return $this->find('list');
	}
	
	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2019)
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
        * @date(07-06-2019)
        * @description Metodo para buscar los datos por el email ingresado
        * @variables $email = email del usuario
        * @return Datos por el email ingresado
    */
	public function get_user_email($email) {
		return $this->findByEmail($email);
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(19-06-2019)
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
