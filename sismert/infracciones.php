<?php 

	//$client = new SoapClient("http://sismertws.ibarra.gob.ec/notificaciones/getMultasByPlaca?wsdl", array('trace' => 1, "exception" => 0));

	require_once('nusoap/lib/nusoap.php');

	error_reporting(E_ALL);				//Mostramos todos los errores de código q encuentre
	ini_set('max_execution_time', 0); 	//Desabilitamos el limite en el tiempo de ejecución
	ini_set('memory_limit', '-1');		//Desabilitamos de igual manera el límite en el uso de la memoria

	//http://sismertws.ibarra.gob.ec/wsgadi.php/notificaciones/getMultasByPlaca?wsdl
	$client = new nusoap_client('http://sismertwsprod.ibarra.gob.ec/wsgadi.php/notificaciones/getMultasByPlaca?wsdl', 'wsdl');
	$err = $client->getError();
	if ($err) {
		die($err);
	}

	$placa=$_GET['placa'];

	$result = $client->call("getMultasByPlaca", array(	"numero_placa" => $placa, 
														"usuario" => "SISMERTWSE",
														"password" => "Eb2Yhye3"));

	$data=array();
	foreach($result as &$infraccion){
		$infraccion['calles']=utf8_encode($infraccion['calles']);
		$data[]=$infraccion;
	}

	echo json_encode($result);