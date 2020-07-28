<?php

App::uses('HtmlHelper', 'View/Helper');

class UtilitiesHelper extends HtmlHelper {

	public $helpers = array('Html');

	public function UtilitiesHelper() {
		App::import("model","User");
		App::import("model","Message");
		App::import("model","Client");
		App::import("model","Stage");

		$this->__User			= new User();
		$this->__Message 		= new Message();
		$this->__Client			= new Client();
		$this->__Stage			= new Stage();
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
				$texto = 'Solicittud de desembolso';
				break;
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

	public function find_cupo_aprobado_credito($credit_id) {
		return $this->__Stage->find_cupo_aprobado_credito($credit_id);
	}

}