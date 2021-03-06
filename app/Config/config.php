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
		'habilitado' 				=> '1',
		'deshabilitado' 			=> '0',
		'revision' 					=> '2',
		'noti_por_leer'				=> '0',
		'noti_vista'				=> '1',
		'estados_monto_deducion' 	=> array(
			'por_cobrar' 				=> '1',
			'cobrado' 					=> '2',
			'pagado' 					=> '3',
			'eliminado' 				=> '4'
		),
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
			'7' 						=> 'Solicitud de desembolso',
			'8'							=> 'Pago rechazado',
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
			'Pagado'					=> '6',
			'Solicitud_de_desembolso' 	=> '7'
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
		),
		'roles'						=> array(
			'Administrador'				=> 'Administrador',
			'Administrador_secundario' 	=> 'Administrador secundario',
			'Coordinador_analista' 		=> 'Coordinador analista',
			'Finanzas' 					=> 'Finanzas',
			'Ejecutivo' 				=> 'Ejecutivo',
			'Analista_credito' 			=> 'Analista crédito'
		),
		'rolCliente' 				=> 'Comercios',
		'password'					=> 'crediventas2020',
		'Actualizar'				=> 'Actualizar',
		'lista_gremios' 			=> array(
			'Accesorios' 				=> 'Accesorios',
			'Accesorios Militares' 		=> 'Accesorios Militares',
			'Asesorias' 				=> 'Asesorias',
			'Calzado' 					=> 'Calzado',
			'Cascos y accesorios' 		=> 'Cascos y accesorios',
			'Construcción' 				=> 'Construcción',
			'Deporte' 					=> 'Deporte',
			'Escuela de conducción' 	=> 'Escuela de conducción',
			'Hogar' 					=> 'Hogar',
			'Maquinas de coser' 		=> 'Maquinas de coser',
			'Motos' 					=> 'Motos',
			'Odontologia' 				=> 'Odontologia',
			'Optica' 					=> 'Optica',
			'Pinturas' 					=> 'Pinturas',
			'Salud y belleza' 			=> 'Salud y belleza',
			'Seguridad' 				=> 'Seguridad',
			'Sex Shop' 					=> 'Sex Shop',
			'Tatuajes' 					=> 'Tatuajes',
			'Tecnología' 				=> 'Tecnología',
			'Vehiculos' 				=> 'Vehiculos',
			'Viajes' 					=> 'Viajes',
			'Vestuario' 				=> 'Vestuario'
		),
		'tipos_cuenta' 				=> array(
			'Ahorros' 					=> 'Ahorros',
			'Corriente' 				=> 'Corriente'
		),
		'lista_planes'				=> array(
			'Clase A' 					=> array(
												'nombre' 		=> 'Clase A',
												'390800' 		=> '390800' // total
											),
			'Clase B'					=> array(
												'nombre' 		=> 'Clase B',
												'190400' 		=> '190400' // total
											)
		),
		'lista_como_paga'			=> array(
			'Contado (efectivo-transferencia)' 			=> 'Contado (efectivo-transferencia)',
			'Tarjeta de Crédito' 						=> 'Tarjeta de Crédito $400.800',
			'Con financiación' 							=> 'Con financiación'
		),
		'lista_cantidad_comercios' 	=> array(
			'1' 						=> '1',
			'2' 						=> '2',
			'3' 						=> '3',
			'4' 						=> '4',
			'5' 						=> '5',
			'6' 						=> '6',
			'7' 						=> '7',
			'8' 						=> '8',
			'9' 						=> '9',
			'10' 						=> '10',
			'11' 						=> '11',
			'12' 						=> '12',
			'13' 						=> '13',
			'14' 						=> '14',
			'15' 						=> '15',
			'16' 						=> '16'
		),
		'lista_cuenta_con'			=> array(
			'1' 						=> 'Cámara de seguridad',
			'2' 						=> 'Software contable',
			'3' 						=> 'Software administración',
			'4' 						=> 'Página web',
			'5' 						=> 'Ventas en redes sociales',
			'6' 						=> 'Manejo de seguros'
		),
		'description_notificaciones' 	=> array(
			'crear_credito' 				=> 'Han registrado un nuevo crédito',
			'crear_credito_cliente' 		=> 'Han registrado un crédito para tu negocio',
			'crear_usuario_sistema' 		=> 'Han registrado un nuevo usuario',
			'crear_cliente' 				=> 'Se ha registrado un cliente',
			'dejar_datos' 					=> 'Han dejado unos datos para que te comuniques con ellos',
			'desenbolsar_dinero' 			=> 'Han solicitado el desenbolso de un crédito',
			'pago_realizado'				=> 'Se realizo el pago de un crédito',
			'pago_rechazado' 				=> 'Un pago de un cr+edito fue rechazado'
		),
	)
);

?>
