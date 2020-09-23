<?php
App::uses('AppModel', 'Model');

class Credit extends AppModel {

	public $validate = array(
		'valor_credito' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'required' => true,
				'on' => 'create',
			),
		),
		'numero_meses' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
				'on' => 'create',
			),
		)
	);

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);

	public $hasMany = array(
		'Stage' => array(
			'className' => 'Stage',
			'foreignKey' => 'credit_id',
			'dependent' => false
		)
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(22-06-2020)
        * @description Metodo que se encargara de devolver los datos del credito
        * @variables $credit_id = id del credito
        * @return Los datos del credito
    */
	public function all_data_credit($credit_id) {
		$conditions 		= array('Credit.id' => $credit_id);
		return $this->find('first',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(09-06-2020)
        * @description Metodo que se encarga de devolver los registros del estado solicitado
        * @variables $state = Estado solicitado
        * @return Los registros del estado solicitado en orden descendente
    */
	public function all_data_state($state) {
		$conditions 		= array('Credit.state' => $state);
		$order				= array('Credit.id' => 'desc');
		return $this->find('all',compact('conditions','order'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(11-09-2020)
        * @description Metodo que se encarga de devolver los registros del estado solicitado del usuario
        * @variables $state = Estado solicitado
        * @return Los registros del estado solicitado en orden descendente por el usuario
    */
	public function all_data_state_user_id($state) {
		$recursive  		= 1;
		$conditions 		= array('Credit.state' => $state);
		$order				= array('Credit.id' => 'desc');
		return $this->find('all',compact('conditions','order','recursive'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(12-06-2020)
        * @description Metodo que se encarga de devolver el total(valor_credito) del estado solicitado
        * @variables $state = Estado solicitado
        * @return El total del estado solicitado
    */
	public function sum_total_state($state) {
		$fields 			= array('SUM(Credit.valor_credito) as total');
		$conditions 		= array('Credit.state' => $state);
		return $this->find('first',compact('fields','conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(12-06-2020)
        * @description Metodo que se encarga de devolver el total(cupo_aprobado) del estado solicitado
        * @variables $state = Estado solicitado
        * @return El total del estado solicitado
    */
	public function sum_cupo_aprobado_state($state) {
		$fields 			= array('SUM(Credit.cupo_aprobado) as total');
		$conditions 		= array('Credit.state' => $state);
		return $this->find('first',compact('fields','conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(19-06-2020)
        * @description Metodo que se encargara de devolver el estado del credito solicitado
        * @variables $credit_id = id del credito
        * @return El estado del credito
    */
	public function find_state($credit_id) {
		$fields 			= array('Credit.state');
		$conditions 		= array('Credit.id' => $credit_id);
		return $this->find('first',compact('fields','conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(19-06-2020)
        * @description Metodo que se encargara de devolver el id del usuario que solicito el crédito
        * @variables $credit_id = id del credito
        * @return El id del cliente
    */
	public function find_user_id($credit_id) {
		$fields 			= array('Credit.user_id');
		$conditions 		= array('Credit.id' => $credit_id);
		return $this->find('first',compact('fields','conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(20-06-2020)
        * @description Metodo que se encargara de devolver el cupo aprobado del credito solicitado
        * @variables $credit_id = id del credito
        * @return El cupo aprobado del credito
    */
	public function find_cupo_aprobado($credit_id) {
		$fields 			= array('Credit.cupo_aprobado','Credit.valor_credito');
		$conditions 		= array('Credit.id' => $credit_id);
		return $this->find('first',compact('fields','conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(27-06-2020)
        * @description Metodo que se encargara de devolver el o los creditos del usuario en el estado solicitado
        * @variables $user_id = id del usuario, $state = estado solicitado
        * @return Los creditos del usuario en el estado solicitado
    */
	public function find_credits_usuario_state($user_id,$state) {
		$this->recursive 	= -1;
		$conditions         = array(
									'Credit.user_id' => $user_id,
                                    'Credit.state' => $state
                                );
		return $this->find('all',compact('conditions'));
	}
	
}