<?php
App::uses('AppController', 'Controller');

class MessagesController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$datosLeida 			= $this->Message->count_user_manages_read(AuthComponent::user('id'));
		$datosNueva 			= $this->Message->count_user_manages_new(AuthComponent::user('id'));
		$datos 					= $this->Message->get_data_user(AuthComponent::user('id'));
		$this->set(compact('datos','datosLeida','datosNueva'));
	}

	public function notificaciones() {
		$this->layout 			= false;
		if ($this->request->is('ajax')) {
			$datos 				= $this->Message->get_data_user_limit_new(AuthComponent::user('id'));
			$this->set(compact('datos'));
		}
	}

	public function marcarNotificacionesLeidas() {
		$this->autoRender 	= false;
		if ($this->request->is('ajax')) {
			$this->Message->update_notify_leidas_all(AuthComponent::user('id'));
			return true;
		}
	}

	public function changestate(){
		$this->autoRender 	= false;
		if ($this->request->is('ajax')) {
			$datosA 								= $this->Message->get_data('Message',$this->request->data['notificacion_id']);
			$datosN['Message']['state']				= $this->request->data['state'];
			$datosN['Message']['id']				= $this->request->data['notificacion_id'];
			$this->Message->save($datosN);
			return $datosA['Message']['url'];
		}
	}

}
