<?php

App::uses('HtmlHelper', 'View/Helper');

class UtilitiesHelper extends HtmlHelper {

	public $helpers = array('Html');

	public function UtilitiesHelper(){
		// App::import("model","ClientsLegal");

		// $this->__ClientsLegal			= new ClientsLegal();
	}

	public function estados_creditos($state){
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

}