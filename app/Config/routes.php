<?php
	Router::connect('/', array('controller' => 'Pages', 'action' => 'home'));
	
	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';