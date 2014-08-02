<?php
namespace Application\Model\Entity;

class LogParqueadero {
	

private $log_par_id;
private $log_par_fecha_ingreso;
private $log_par_fecha_salida;
private $log_par_horas_parqueo;
private $log_par_estado;
private $par_id;
private $aut_idprivate $;

function __construct() {}

/**
* @return the $log_par_id
*/
public function getLog_par_id(){
	return $this->log_par_id;
}
/**
* @return the $log_par_fecha_ingreso
*/
public function getLog_par_fecha_ingreso(){
	return $this->log_par_fecha_ingreso;
}
/**
* @return the $log_par_fecha_salida
*/
public function getLog_par_fecha_salida(){
	return $this->log_par_fecha_salida;
}
/**
* @return the $log_par_horas_parqueo
*/
public function getLog_par_horas_parqueo(){
	return $this->log_par_horas_parqueo;
}
/**
* @return the $log_par_estado
*/
public function getLog_par_estado(){
	return $this->log_par_estado;
}
/**
* @return the $par_id
*/
public function getPar_id(){
	return $this->par_id;
}
/**
* @return the $aut_id
*/
public function getAut_id(){
	return $this->aut_id;
}


/**
* @param Ambigous <NULLm unknown> $log_par_id
*/
public function setLog_par_id($log_par_id){
	$this->log_par_id=$log_par_id;
}
/**
* @param Ambigous <NULLm unknown> $log_par_fecha_ingreso
*/
public function setLog_par_fecha_ingreso($log_par_fecha_ingreso){
	$this->log_par_fecha_ingreso=$log_par_fecha_ingreso;
}
/**
* @param Ambigous <NULLm unknown> $log_par_fecha_salida
*/
public function setLog_par_fecha_salida($log_par_fecha_salida){
	$this->log_par_fecha_salida=$log_par_fecha_salida;
}
/**
* @param Ambigous <NULLm unknown> $log_par_horas_parqueo
*/
public function setLog_par_horas_parqueo($log_par_horas_parqueo){
	$this->log_par_horas_parqueo=$log_par_horas_parqueo;
}
/**
* @param Ambigous <NULLm unknown> $log_par_estado
*/
public function setLog_par_estado($log_par_estado){
	$this->log_par_estado=$log_par_estado;
}
/**
* @param Ambigous <NULLm unknown> $par_id
*/
public function setPar_id($par_id){
	$this->par_id=$par_id;
}
/**
* @param Ambigous <NULLm unknown> $aut_id
*/
public function setAut_id($aut_id){
	$this->aut_id=$aut_id;
}



	public function exchangeArray($data)
	{

		$this->log_par_id = (isset($data['log_par_id'])) ? $data['log_par_id'] : null;
		$this->log_par_fecha_ingreso = (isset($data['log_par_fecha_ingreso'])) ? $data['log_par_fecha_ingreso'] : null;
		$this->log_par_fecha_salida = (isset($data['log_par_fecha_salida'])) ? $data['log_par_fecha_salida'] : null;
		$this->log_par_horas_parqueo = (isset($data['log_par_horas_parqueo'])) ? $data['log_par_horas_parqueo'] : null;
		$this->log_par_estado = (isset($data['log_par_estado'])) ? $data['log_par_estado'] : null;
		$this->par_id = (isset($data['par_id'])) ? $data['par_id'] : null;
		$this->aut_id = (isset($data['aut_id'])) ? $data['aut_id'] : null;

	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}	
}