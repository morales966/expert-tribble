<?php
App::uses('AppModel', 'Model');
/**
 * Credit Model
 *
 * @property User $User
 */
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
}
