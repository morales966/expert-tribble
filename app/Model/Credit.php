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
				'rule' => array('notBlank')
			),
		),
		'nomre_persona' => array(
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
        * @date(07-06-2019)
        * @description Metodo que se encarga de devolver los registros en estado solicitud
        * @return Los registros en estado solicitud
    */
	public function all_state_solicitud() {
		$state 				= Configure::read('variables.nombres_estados_creditos.Solicitud');
		$conditions 		= array('Credit.state' => $state);
		return $this->find('all',compact('conditions')); 
	}
}
