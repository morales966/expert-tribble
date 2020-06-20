<?php 
	$jsTranslations = array(
		'base_url'										=> $this->webroot,
		'controller'									=> $this->request->controller,
		'controller_menu'								=> mb_strtoupper($this->request->controller),
		'action'										=> $this->request->action,
		'user_id'										=> (AuthComponent::user('id') > 0) ? AuthComponent::user('id') : 0,
		'state_credito_id_negado' 						=> Configure::read('variables.nombres_estados_creditos.Negado'),
		'state_credito_id_solicitud' 					=> Configure::read('variables.nombres_estados_creditos.Solicitud'),
		'state_credito_id_estudio' 						=> Configure::read('variables.nombres_estados_creditos.En_estudio'),
		'state_credito_id_detenido' 					=> Configure::read('variables.nombres_estados_creditos.Detenido'),
		'state_credito_id_aprobadoNoRetirado' 			=> Configure::read('variables.nombres_estados_creditos.Aprobado_no_retirado'),
		'state_credito_id_aprobadoRetirado' 			=> Configure::read('variables.nombres_estados_creditos.Aprobado_retirado'),
		'state_credito_id_pagado' 						=> Configure::read('variables.nombres_estados_creditos.Pagado')

	);
	echo $this->Html->scriptBlock("copy_js =".json_encode($jsTranslations),				array('block' => 'variablesAppScript'));
?>