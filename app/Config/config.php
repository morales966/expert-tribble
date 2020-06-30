<?php

$config = array(
	'Application' => array(
		'name' 	  => 'Crediventas.com',
		'version' => 'CAKEPHP v2.10.10',
		'status'  => false,
		'maintenance' => 0
	),
	'Meta' => array(
		'title' 	  => '{{title}}',
		'description' => '{{description}}',
		'keywords' 	  => '{{keywords}}',
	),
	
	'Google' => array(
		'analytics'  => '{{analytics}}',
	),
	
	'Email' => array(
		'from_email' 		=> array('Nuevo mensaje' 				=> 'dlmorales096@gmail.com'),
		'contact_mail' 		=> array('dlmorales096@gmail.com' 		=> 'Nuevo mensaje')
	),

	'variables' 				=> array(
		'tiempos_creditos'			=> array(
			'2' 						=> '2 meses',
			'3' 						=> '3 meses',
			'4' 						=> '4 meses',
			'5' 						=> '5 meses',
			'6' 						=> '6 meses',
			'7'							=> '7 meses',
			'8' 						=> '8 meses',
			'9' 						=> '9 meses',
			'10' 						=> '10 meses',
			'11'						=> '11 meses',
			'12' 						=> '12 meses',
			'13' 						=> '13 meses',
			'14' 						=> '14 meses',
			'15' 						=> '15 meses',
			'16' 						=> '16 meses',
			'17'						=> '17 meses',
			'18' 						=> '18 meses',
			'19' 						=> '19 meses',
			'20' 						=> '20 meses',
			'21'						=> '21 meses',
			'22' 						=> '22 meses',
			'23' 						=> '23 meses',
			'24' 						=> '24 meses'
		),
		'estados_creditos' 			=> array(
			'0'							=> 'Negado',
			'1'							=> 'Solicitud',
			'2'							=> 'En estudio',
			'3'							=> 'Detenido',
			'4'							=> 'Aprobado, no retirado',
			'5'							=> 'Aprobado, retirado',
			'6' 						=> 'Pagado',

			'description' 				=> 'Descripción',
			'editar_cupo_aprobado'		=> 'Editar cupo aprobado',
			'registrar_retiro_cupo' 	=> 'Registrar retiro del cupo',
			'adjuntar_plan_pagos'		=> 'Plan de pagos'
		),
		'nombres_estados_creditos' 	=> array(
			'Negado'					=> '0',
			'Solicitud'					=> '1',
			'En_estudio'				=> '2',
			'Detenido'					=> '3',
			'Aprobado_no_retirado'		=> '4',
			'Aprobado_retirado'			=> '5',
			'Pagado'					=> '6'
		),
		'pasos_estados' 			=> array(
			'razones_negado' 			=> array(
				'Reportado en centrales' 				=> 'Reportado en centrales',
				'No capacidad de endeudamiento'			=> 'No capacidad de endeudamiento',
				'Mora en entidades' 					=> 'Mora en entidades',
				'Sin historial crediticio' 				=> 'Sin historial crediticio',
				'No cumple con scoring' 				=> 'No cumple con scoring',
				'Política laboral' 						=> 'Política laboral'
			)
		)
	)
);

?>
