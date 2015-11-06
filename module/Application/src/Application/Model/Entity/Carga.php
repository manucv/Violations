<?php	//Carga.php

namespace Application\Model\Entity;

class Carga {

	private $car_id;
	private $pun_rec_id;
	private $car_valor;
	private $car_fecha;

	/*
	*@return the $car_id
	*/
	public function getCar_id(){
		return $this->car_id;
	}

	/*
	*@return the $pun_rec_id
	*/
	public function getPun_rec_id(){
		return $this->pun_rec_id;
	}

	/*
	*@return the $car_valor
	*/
	public function getCar_valor(){
		return $this->car_valor;
	}

	/*
	*@return the $car_fecha
	*/
	public function getCar_fecha(){
		return $this->car_fecha;
	}

	/**
	* @param Ambigous <NULL, unknown> $car_id
	*/
	public function setCar_id($car_id){
		$this->car_id= $car_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_id
	*/
	public function setPun_rec_id($pun_rec_id){
		$this->pun_rec_id= $pun_rec_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $car_valor
	*/
	public function setCar_valor($car_valor){
		$this->car_valor= $car_valor;
	}

	/**
	* @param Ambigous <NULL, unknown> $car_fecha
	*/
	public function setCar_fecha($car_fecha){
		$this->car_fecha= $car_fecha;
	}
	
	public function exchangeArray($data)
	{
		$this->car_id = (isset($data['car_id'])) ? $data['car_id'] : null;
		$this->pun_rec_id = (isset($data['pun_rec_id'])) ? $data['pun_rec_id'] : null;
		$this->car_valor = (isset($data['car_valor'])) ? $data['car_valor'] : null;
		$this->car_fecha = (isset($data['car_fecha'])) ? $data['car_fecha'] : null;
	}
		
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}	