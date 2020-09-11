<?php
App::uses('AppModel', 'Model');

class Client extends AppModel {

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(28-06-2020)
        * @description Metodo que se encargara de devolver el código del cliente
        * @variables $user_id = id del cliente
        * @return Código del cliente
    */
	public function find_code_client($user_id) {
		$this->recursive 	= -1;
		$fields 			= array('Client.codigo');
		$conditions 		= array('Client.user_id' => $user_id);
		$dato 				= $this->find('first',compact('conditions','fields'));
		return $dato['Client']['codigo'];
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(18-08-2020)
        * @description Metodo que se encargara de devolver los datos del cliente para crear una solicitud de crédito
        * @variables $user_id = id del cliente
        * @return Ddatos del cliente para crear una solicitud de crédito
    */
	public function find_code_client_solicitud_credito($codigo) {
		$this->recursive 	= -1;
		$fields 			= array('Client.user_id');
		$conditions 		= array('Client.codigo' => $codigo);
		$dato 				= $this->find('first',compact('conditions','fields'));
		if (isset($dato['Client']['user_id'])) {
			return $dato['Client']['user_id'];
		} else {
			return 0;
		}
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(10-09-2020)
        * @description Metodo que se encargara de devolver los datos del cliente  referente al banco
        * @variables $user_id = id del cliente
        * @return Ddatos del cliente para crear una solicitud de crédito
    */
	public function all_data_user_banco($user_id) {
		$this->recursive 			= -1;
		$fields 					= array('Client.tel_usuario','banco','numero_cuenta','tipo_cuenta','nombre_propietario_cuenta');
		$conditions 				= array('Client.user_id' => $user_id);
		$datos 						= $this->find('first',compact('conditions','fields'));
		return $datos;
	}
}