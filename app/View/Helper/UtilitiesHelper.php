<?php

App::uses('HtmlHelper', 'View/Helper');

class UtilitiesHelper extends HtmlHelper {

	public $helpers = array('Html');

	public function UtilitiesHelper() {
		App::import("model","User");
		App::import("model","Message");
		App::import("model","Client");
		App::import("model","Stage");
		App::import("model","Deduct");
		App::import("model","Credit");

		$this->__User			= new User();
		$this->__Message 		= new Message();
		$this->__Client			= new Client();
		$this->__Stage			= new Stage();
		$this->__Deduct			= new Deduct();
		$this->__Credit			= new Credit();
	}

	public function estado_usuario($state) {
		$texto = '';
		switch ($state) {
			case '0':
				$texto = 'Inhabilitado';
				break;
			case '1':
				$texto = 'Habilitado';
				break;
			case '2':
				$texto = 'Por revisar';
				break;
		}
		return $texto;
	}

	public function estados_creditos($state) {
		$texto = '';
		switch ($state) {
			case '0':
				$texto = 'Negado';
				break;
			case '1':
				$texto = 'Solicitado';
				break;
			case '2':
				$texto = 'En estudio';
				break;
			case '3':
				$texto = 'Detenido';
				break;
			case '4':
				$texto = 'Aprobado, no retirado';
				break;
			case '5':
				$texto = 'Aprobado, retirado';
				break;
			case '6':
				$texto = 'Pagado';
				break;
			case '7':
				$texto = 'Solicitud de desembolso';
				break;
		}
		return $texto;
	}

	public function estados_pago($state) {
		$texto = '';
		switch ($state) {
			case '5':
				$texto = 'Por solicitar';
				break;
			case '6':
				$texto = 'Procesando';
				break;
			case '7':
				$texto = 'Solicitud de desembolso';
				break;
		}
		return $texto;
	}

	public function estado_solicitud_pagado($state,$numero_comprobante) {
		$texto = '';
		if ($numero_comprobante  != '') {
			$texto = 'Pagado';
		} else {
			$texto = 'Procesando';
		}
		return $texto;
	}

	public function name_user($user_id) {
		return $this->__User->name_user($user_id);
	}

	public function count_notificaciones_user() {
		return $this->__Message->count_user_manages_new(AuthComponent::user('id'));
	}

	public function data_null_notifications_new($datos) {
		if ($datos == 0) {
			return 'No hay notificaciones sin leer';
		}
	}

	public function data_null_notifications_read($datos) {
		if ($datos == 0) {
			return 'No tienes notificaciones';
		}
	}

	public function find_codigo_cliente($user_id) {
		return $this->__Client->find_code_client($user_id);
	}

	public function find_deduciones_comercio($user_id) {
		return $this->__Deduct->find_deduciones_comercio($user_id);
	}

	public function sum_deboluciones_comercio($user_id,$state) {
		if ($state != Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')) {
			return 0;
		} else {
			return $this->__Deduct->sum_deboluciones_comercio($user_id);
		}
	}

	public function find_cupo_aprobado_credito($credit_id) {
		$valor = $this->__Stage->find_cupo_aprobado_credito($credit_id);
		if ($valor == 0) {
			$datos = $this->__Credit->find_cupo_aprobado($credit_id);
			return $datos['Credit']['valor_credito'];
		} else {
			return $valor;
		}
	}

	public function total_pagar($user_id,$credit_id,$state) {
		if ($state != Configure::read('variables.nombres_estados_creditos.Solicitud_de_desembolso')) {
			$retirado 			= $this->__Stage->find_cupo_aprobado_credito($credit_id);
			if ($retirado == 0) {
				$datos 			= $this->__Credit->find_cupo_aprobado($credit_id);
				$retirado 		= $datos['Credit']['valor_credito'];
			}
			$total 				= $retirado;
			return $total;
		} else {
			$retirado 			= $this->__Stage->find_cupo_aprobado_credito($credit_id);
			if ($retirado == 0) {
				$datos 			= $this->__Credit->find_cupo_aprobado($credit_id);
				$retirado 		= $datos['Credit']['valor_credito'];
			}
			$deduccion  		= $this->__Deduct->sum_deboluciones_comercio($user_id);
			$total 				= $retirado - $deduccion;
			return $total;
		}
	}

}