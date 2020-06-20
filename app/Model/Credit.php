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
		),
		'valor_cuota' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'on' => 'create',
			),
		),
		'nombre_persona' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
				'on' => 'create',
			),
		),
		'apellido_persona' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
				'on' => 'create',
			),
		),
		'cedula_persona' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'required' => true,
				'on' => 'create',
			),
		),
		'telefono_persona' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
				'on' => 'create',
			),
		),
	);

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(09-06-2019)
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
        * @date(12-06-2019)
        * @description Metodo que se encarga de devolver el total(valor_credito) del estado solicitado
        * @variables $state = Estado solicitado
        * @return El del estado solicitado
    */
	public function sum_total_state($state) {
		$fields 			= array('SUM(Credit.valor_credito) as total');
		$conditions 		= array('Credit.state' => $state);
		return $this->find('first',compact('fields','conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(19-06-2019)
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
        * @date(20-06-2019)
        * @description Metodo que se encargara de devolver el cupo aprobado del credito solicitado
        * @variables $credit_id = id del credito
        * @return El cupo aprobado del credito
    */
	public function find_cupo_aprobado($credit_id) {
		$fields 			= array('Credit.cupo_aprobado');
		$conditions 		= array('Credit.id' => $credit_id);
		return $this->find('first',compact('fields','conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(20-06-2019)
        * @description Metodo que se encargara de devolver la descripción del estado negado del credito
        * @variables $credit_id = id del credito
        * @return La descripción del estado negado del credito
    */
	public function find_descripcion_negado($credit_id) {
		$fields 			= array('Credit.descripcion_negado');
		$conditions 		= array('Credit.id' => $credit_id);
		return $this->find('first',compact('fields','conditions'));
	}
}