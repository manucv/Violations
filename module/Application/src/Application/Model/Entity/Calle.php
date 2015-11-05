<?php //Calle.php

namespace Application\Model\Entity;

class Calle {

	private $cal_id;
	private $cal_codigo;
	private $cal_nombre;

	/*
	* @return the $cal_id
	*/
	public function getCal_id(){
		return $this->cal_id;
	}
	/*
	* @return the $cal_codigo
	*/
	public function getCal_codigo(){
		return $this->cal_codigo;
	}
	/*
	* @return the $cal_nombre
	*/
	public function getCal_nombre(){
		return $this->cal_nombre;
	}

	/**
	* @param Ambigous <NULL, unknown> $cal_id
	*/
	public function setCal_id($cal_id){
		$this->cal_id =	$cal_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $cal_codigo
	*/
	public function setCal_codigo($cal_codigo){
		$this->cal_codigo =	$cal_codigo;
	}

	/**
	* @param Ambigous <NULL, unknown> $cal_nombre
	*/
	public function setCal_nombre($cal_nombre){
		$this->cal_nombre =	$cal_nombre;
	}

	public function exchangeArray($data)
	{
		$this->cal_id = (isset($data['cal_id'])) ? $data['cal_id'] : null;
		$this->cal_codigo = (isset($data['cal_codigo'])) ? $data['cal_codigo'] : null;
		$this->cal_nombre = (isset($data['cal_nombre'])) ? $data['cal_nombre'] : null;
	}
		
	public function getArrayCopy(){
		return get_object_vars($this);
	}


}