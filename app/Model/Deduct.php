<?php
App::uses('AppModel', 'Model');

class Deduct extends AppModel {

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(20-09-2020)
        * @description Metodo que se encargara de devolver las deduciones que han registraddo
        * @variables $user_id = id del comercio
        * @return Los datos de las deduciones en estado por cobrar
    */
	public function find_deduciones_comercio($user_id) {
		$conditions 			= array(
									'Deduct.state' 			=> Configure::read('variables.estados_monto_deducion.por_cobrar'),
									'Deduct.user_id' 		=> $user_id
        						);
		$deduciones 			= $this->find('all',compact('conditions'));
		$this->update_state($deduciones);
		return '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Actualizar monto deduciones para el comercio" class="
		 btn btn-sm btn-outline-primary"><i class="fa fa-refresh"></i><a>';
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(20-09-2020)
        * @description Metodo que se encargara de modificar a estado cobrado
        * @variables $deduciones = lista deducionea en estado por cobrar
    */
	public function update_state($deduciones) {
		foreach ($deduciones as $value) {
			$this->updateAll(
		    	array('Deduct.state' => Configure::read('variables.estados_monto_deducion.cobrado')), array('Deduct.id' => $value['Deduct']['id'])
		    );
		}
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(20-09-2020)
        * @description Metodo que se encargara de modificar a estado pagado
        * @variables $user_id = id del comercio
    */
	public function update_state_pagado($user_id) {
		$this->updateAll(
	    	array('Deduct.state' => Configure::read('variables.estados_monto_deducion.pagado')), 
	    	array(
	    		'Deduct.state' 			=> Configure::read('variables.estados_monto_deducion.cobrado'),
	    		'Deduct.user_id' 		=> $user_id
	    	)
	    );
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(20-09-2020)
        * @description Metodo que se encargara de devolver el total del monto a descontar
        * @variables $user_id = id del comercio
        * @return Total del valor
    */
	public function sum_deboluciones_comercio($user_id) {
		$fields 			= array('SUM(Deduct.monto) as total');
		$conditions 		= array('Deduct.user_id' => $user_id,'Deduct.state' => Configure::read('variables.estados_monto_deducion.cobrado'));
		$dato 				= $this->find('first',compact('fields','conditions'));
		return $dato[0]['total'];
	}

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(20-09-2020)
        * @description Metodo que se encargara de modificar a estado cobrado
        * @variables $user_id = 
        * id del comercio
        * @return Listado de deducciones
    */
	public function ver_deducciones($user_id) {
		$conditions 			= array(
										'Deduct.state' 			=> Configure::read('variables.estados_monto_deducion.cobrado'),
										'Deduct.user_id' 		=> $user_id
	        						);
		return $this->find('all',compact('conditions'));
	}
}