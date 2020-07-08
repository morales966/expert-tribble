<?php
App::uses('AppModel', 'Model');

class Stage extends AppModel {

	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'credit_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		)
	);

	public $belongsTo = array(
		'Credit' => array(
			'className' => 'Credit',
			'foreignKey' => 'credit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(22-06-2019)
        * @description Metodo que se encargara de devolver los datos del credito
        * @variables $credit_id = id del credito
        * @return Los datos del credito
    */
	public function all_data_credit($credit_id) {
		$conditions 		= array('Stage.credit_id' => $credit_id);
		return $this->find('all',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(30-06-2019)
        * @description Metodo que se encarga de devolver el total(cupo_aprobado) del estado solicitado
        * @variables $state = Estado solicitado,$credit_id = id del credito
        * @return suma(total) del estado solicitado po identificador del credito
    */
	public function sum_cupo_aprobado_state_credit($state,$credit_id) {
		$fields 			= array('SUM(Stage.cupo_aprobado) as total');
		$conditions 		= array('Stage.state_credit' => $state,'Stage.credit_id' => $credit_id);
		return $this->find('first',compact('fields','conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(30-06-2019)
        * @description Metodo que se encarga de devolver todos los pasos del estado solicitado
        * @variables $state = Estado solicitado,$credit_id = id del credito
        * @return Filas del estado solicitado po identificador del credito
    */
	public function all_cupo_aprobado_state_credit($state,$credit_id) {
		$conditions 		= array('Stage.state_credit' => $state,'Stage.credit_id' => $credit_id);
		return $this->find('all',compact('conditions'));
	}
}
