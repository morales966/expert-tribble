<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $validate = array(
		'nombre' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2019)
        * @description Metodo que encripta si llega un valor llamado password
        * @return Dato encriptado
    */
	public function beforeSave($options = array()){
		if (isset($this->data[$this->alias]['password']) && !empty($this->data[$this->alias]['password'])){
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
	}
	
	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2019)
        * @description Metodo que genera el codigo para cambiar la contraseña
        * @return Codigo para cambiar la contraseña
    */
	public function generate_hash_change_password(){
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
	public function get_user_email($email){
		return $this->findByEmail($email);
	}

	
}
