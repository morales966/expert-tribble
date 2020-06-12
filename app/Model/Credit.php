<?php
App::uses('AppModel', 'Model');

class Credit extends AppModel {

	public $validate = array(
		'valor_credito' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'required' => true,
			),
		),
		'numero_meses' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
			),
		),
		'valor_cuota' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'nombre_persona' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
			),
		),
		'apellido_persona' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
			),
		),
		'cedula_persona' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'required' => true,
			),
		),
		'telefono_persona' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
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
        * @return El del estado solicitado
    */
	public function sum_total_state($state) {
		$fields 			= array('SUM(Credit.valor_credito) as total');
		$conditions 		= array('Credit.state' => $state);
		return $this->find('first',compact('fields','conditions'));


	}
}