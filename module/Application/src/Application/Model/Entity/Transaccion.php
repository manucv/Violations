<?php
	//Transaccion.php

namespace Application\Model\Entity;

class Transaccion
{

	private $tra_id;
	private $est_id;
	private $cli_id;
	private $tra_valor;
	private $tra_tipo;
	private $tra_descripcion;
	private $tra_saldo;
	private $tra_hora;

	/**
	* @return the $tra_id
	*/
	public function getTra_id(){
		return $this->tra_id;
	}

	/**
	* @return the $est_id
	*/
	public function getEst_id(){
		return $this->est_id;
	}

	/**
	* @return the $cli_id
	*/
	public function getCli_id(){
		return $this->cli_id;
	}

	/**
	* @return the $tra_valor
	*/
	public function getTra_valor(){
		return $this->tra_valor;
	}

	/**
	* @return the $tra_tipo	
	*/
	public function getTra_tipo	(){
		return $this->tra_tipo;
	}

	/**
	* @return the $tra_tipo	
	*/
	public function getTra_descripcion	(){
		return $this->tra_descripcion;
	}

	/**
	* @return the $tra_saldo
	*/
	public function getTra_saldo(){
		return $this->tra_saldo;
	}

	/**
	* @return the $tra_hora
	*/
	public function getTra_hora(){
		return $this->tra_hora;
	}

	/**
	* @param Ambigous <NULL, unknown> $tra_id
	*/
	public function setTra_id($tra_id){
		$this->tra_id=$tra_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $est_id
	*/
	public function setEst_id($est_id){
		$this->est_id=$est_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $cli_id
	*/
	public function setCli_id($cli_id){
		$this->cli_id=$cli_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $tra_valor
	*/
	public function setTra_valor($tra_valor){
		$this->tra_valor=$tra_valor;
	}

	/**
	* @param Ambigous <NULL, unknown> $tra_tipo
	*/
	public function setTra_tipo($tra_tipo){
		$this->tra_tipo=$tra_tipo;
	}

	/**
	* @param Ambigous <NULL, unknown> $tra_tipo
	*/
	public function setTra_descripcion($tra_descripcion){
		$this->tra_descripcion=$tra_descripcion;
	}

	/**
	* @param Ambigous <NULL, inknown> $tra_saldo
	*/
	public function setTra_saldo($tra_saldo){
		$this->tra_saldo=$tra_saldo;
	}

	/**
	* @param Ambigous <NULL, inknown> $tra_hora
	*/
	public function setTra_hora($tra_hora){
		$this->tra_hora=$tra_hora;
	}

	public function exchangeArray($data)
	{
		$this->tra_id = (isset($data['tra_id'])) ? $data['tra_id'] : null;
		$this->est_id = (isset($data['est_id'])) ? $data['est_id'] : null;
		$this->cli_id = (isset($data['cli_id'])) ? $data['cli_id'] : null;
		$this->tra_valor = (isset($data['tra_valor'])) ? $data['tra_valor'] : null;
		$this->tra_tipo = (isset($data['tra_tipo'])) ? $data['tra_tipo'] : null;
		$this->tra_descripcion = (isset($data['tra_descripcion'])) ? $data['tra_descripcion'] : null;
		$this->tra_saldo = (isset($data['tra_saldo'])) ? $data['tra_saldo'] : null;
		$this->tra_hora = (isset($data['tra_hora'])) ? $data['tra_hora'] : null;		
	}
		
	public function getArrayCopy(){
		return get_object_vars($this);
	}		

}