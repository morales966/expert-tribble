<?php
App::uses('AppModel', 'Model');

class Message extends AppModel {

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(11-07-2020)
        * @description Metodo que se encargara de devolver el número de notificaciones por leer
        * @variables $user_id = id del usuario
        * @return Número de notificaciones por leer
    */
	public function count_user_manages_new($user_id){
		$conditions 			= array('Message.user_id' => $user_id,'Message.state' => Configure::read('variables.noti_por_leer'));
		return $this->find('count',compact('conditions')); 
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(11-07-2020)
        * @description Metodo que se encargara de devolver el número de notificaciones vistas
        * @variables $user_id = id del usuario
        * @return Número de notificaciones vistas
    */
	public function count_user_manages_read($user_id){
		$conditions 			= array('Message.user_id' => $user_id,'Message.state' => Configure::read('variables.noti_vista'));
		return $this->find('count',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(11-07-2020)
        * @description Metodo que se encargara de devolver las notificaciones por leer
        * @variables $user_id = id del usuario
        * @return Notificaciones por leer
    */
	public function get_data_user_limit_new($user_id){
		$this->recursive 		= -1;
		$limit 					= 6;
		$order					= array('Message.id' => 'desc');
		$conditions 			= array('Message.user_id' => $user_id,'Message.state' => Configure::read('variables.noti_por_leer'));
		return $this->find('all',compact('conditions','order','limit')); 
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(11-07-2020)
        * @description Metodo que se encargara de devolver las notificaciones
        * @variables $user_id = id del usuario
        * @return Todas las notificaciones
    */
	public function get_data_user($user_id){
		$this->recursive 		= -1;
		$order					= array('Message.id' => 'desc');
		$conditions 			= array('Message.user_id' => $user_id);
		return $this->find('all',compact('conditions','order')); 
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(11-07-2020)
        * @description Metodo que se encargara de modificar el estado a vistas del usuario
        * @variables $user_id = id del usuario
        * @return Modificar todas las notificaciones a estado leidas del usuario
    */
	public function update_notify_leidas_all($user_id) {
	    $this->updateAll(
	    	array('Message.state' => Configure::read('variables.noti_vista')), array('Message.user_id' => $user_id)
	    );
	}


}