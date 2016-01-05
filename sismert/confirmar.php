<?php //confirmar.php

	require_once('nusoap/lib/nusoap.php');

	error_reporting(E_ALL);				//Mostramos todos los errores de código q encuentre
	ini_set('max_execution_time', 0); 	//Desabilitamos el limite en el tiempo de ejecución
	ini_set('memory_limit', '-1');		//Desabilitamos de igual manera el límite en el uso de la memoria

	
	//http://sismertws.ibarra.gob.ec/wsgadi.php/notificaciones/insertNotificacion?wsdl
	//$client = new nusoap_client('http://sismertwsprod.ibarra.gob.ec/wsgadi.php/notificaciones/insertNotificacion?wsdl', 'wsdl');
	$client = new nusoap_client('http://sismertws.ibarra.gob.ec/wsgadi.php/notificaciones/insertNotificacion?wsdl');
	$err = $client->getError();
	if ($err) {
		die($err);
	}

	$inmovilizado=false;
	if($_GET['inmovilizado']=='t')
		$inmovilizado=true;

	$a=false;
	if($_GET['a']=='t')
		$a=true;

	$b=false;
	if($_GET['b']=='t')
		$b=true;

	$c=false;
	if($_GET['c']=='t')
		$c=true;

	$d=false;
	if($_GET['d']=='t')
		$d=true;

	$e=false;
	if($_GET['e']=='t')
		$e=true;

	$f=false;
	if($_GET['f']=='t')
		$f=true;

	$g=false;
	if($_GET['g']=='t')
		$g=true;

	$h=false;
	if($_GET['h']=='t')
		$h=true;

	$i=false;
	if($_GET['i']=='t')
		$i=true;

	$j=false;
	if($_GET['j']=='t')
		$j=true;

	$data = array(	
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
	);

	$result = $client->call("insertNotificacion", $data);

	$log = fopen("/var/www/html/Violations/public/logs/log.txt", "a");
	fwrite($log, "\n". $result);
	fclose($log); 

	if($result == $_GET['numero'])
		echo 1;
	else
		echo 0;
