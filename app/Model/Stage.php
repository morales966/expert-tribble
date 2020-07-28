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
			'foreignKey' => 'credit_id'
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
		$conditions 		= array('Stage.credit_id' => $credit_id);
		return $this->find('all',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(14-07-2020)
        * @description Metodo que se encargara de devolver la información de los planes de pagos
        * @variables $credit_id = id del credito
        * @return La información de los planes de pagos
    */
	public function archivos_credito_id($credit_id) {
		$conditions 		= array(
								'Stage.credit_id' => $credit_id,
								'Stage.state_credit' => Configure::read('variables.estados_creditos.adjuntar_plan_pagos')
							);
		return $this->find('all',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(30-06-2020)
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
        * @date(30-06-2020)
        * @description Metodo que se encarga de devolver todos los pasos del estado solicitado
        * @variables $state = Estado solicitado,$credit_id = id del credito
        * @return Filas del estado solicitado po identificador del credito
    */
	public function all_cupo_aprobado_state_credit($state,$credit_id) {
		$conditions 		= array('Stage.state_credit' => $state,'Stage.credit_id' => $credit_id);
		return $this->find('all',compact('conditions'));
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(28-06-2020)
        * @description Metodo que se encargara de devolver el cupo aprobado para el crédito
        * @variables $credit_id = id del credito
        * @return Cupo aprobado
    */
	public function find_cupo_aprobado_credito($credit_id) {
		$this->recursive 	= -1;
		$fields 			= array('Stage.cupo_aprobado');
		$conditions 		= array(
								'Stage.credit_id' => $credit_id,
								'Stage.state_credit !=' => array(
																Configure::read('variables.estados_creditos.description'),
																Configure::read('variables.estados_creditos.adjuntar_plan_pagos'),
																Configure::read('variables.estados_creditos.7')
								)
							);
		$order				= array('Stage.id' => 'desc');
		$dato 				= $this->find('first',compact('conditions','fields','order'));
		return $dato['Stage']['cupo_aprobado'];
	}
}
