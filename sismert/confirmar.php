<?php //confirmar.php

	require_once('nusoap/lib/nusoap.php');

	error_reporting(E_ALL);				//Mostramos todos los errores de código q encuentre
	ini_set('max_execution_time', 0); 	//Desabilitamos el limite en el tiempo de ejecución
	ini_set('memory_limit', '-1');		//Desabilitamos de igual manera el límite en el uso de la memoria


	$client = new nusoap_client('http://sismertws.ibarra.gob.ec/wsgadi.php/notificaciones/insertNotificacion?wsdl', 'wsdl');
	$err = $client->getError();
	if ($err) {
		die($err);
	}

	$result = $client->call("insertNotificacion", array(	
		'numero' => $_GET['numero'], 
	    'numero_tarjeta' => $_GET['numero_tarjeta'], 
	    'numero_placa' => $_GET['numero_placa'], 
	    'calle_prin' => $_GET['calle_prin'], 
	    'calle_trans' => $_GET['calle_trans'], 
	    'fecha' => $_GET['fecha'], 
	    'hora' => $_GET['hora'], 
	    'a' => $_GET['a'], 
	    'b' => $_GET['b'], 
	    'c' => $_GET['c'], 
	    'd' => $_GET['d'], 
	    'e' => $_GET['e'], 
	    'f' => $_GET['f'], 
	    'g' => $_GET['g'], 
	    'h' => $_GET['h'], 
	    'i' => $_GET['i'], 
	    'j' => $_GET['j'], 
	    'tiempo_permanencia' => $_GET['tiempo_permanencia'], 
	    'supervisor' => $_GET['supervisor'], 
	    'estado' => $_GET['estado'], 
	    'observacion' => $_GET['observacion'], 
	    'inmovilizado' => $_GET['inmovilizado'],
	    'imagen1' => $_GET['imagen1'],
	    'imagen2' => $_GET['imagen2'],
	    'imagen3' => $_GET['imagen3'],
	    'usuario' => $_GET['usuario'], 
	    'password' => $_GET['password']
	));
	
	if($result == $_GET['numero'])
		echo 1;
	else
		echo 0;