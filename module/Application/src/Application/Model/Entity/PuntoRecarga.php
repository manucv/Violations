<?php 
	//PuntoRecarga.php

namespace Application\Model\Entity;

class PuntoRecarga {

	private $pun_rec_id;
	private $pun_rec_nombre;
	private $pun_rec_ruc;
	private $pun_rec_lat;
	private $pun_rec_lng;
	private $pun_rec_direccion;
	private $pun_rec_observaciones;
	private $pun_rec_saldo;
	private $pun_rec_habilitado;
	private $pun_rec_clave;
	
	/*
	* @return the $pun_rec_id
	*/
	public function getPun_rec_id(){
		return $this->pun_rec_id;
	}

	/*
	* @return the $pun_rec_nombre
	*/
	public function getPun_rec_nombre(){
		return $this->pun_rec_nombre;
	}

	/*
	* @return the $pun_rec_ruc
	*/
	public function getPun_rec_ruc(){
		return $this->pun_rec_ruc;
	}

	/*
	* @return the $pun_rec_lat
	*/
	public function getPun_rec_lat(){
		return $this->pun_rec_lat;
	}

	/*
	* @return the $pun_rec_lng
	*/
	public function getPun_rec_lng(){
		return $this->pun_rec_lng;
	}

	/*
	* @return the $pun_rec_direccion
	*/
	public function getPun_rec_direccion(){
		return $this->pun_rec_direccion;
	}

	/*
	* @return the $pun_rec_observaciones
	*/
	public function getPun_rec_observaciones(){
		return $this->pun_rec_observaciones;
	}

	/*
	* @return the $pun_rec_saldo
	*/
	public function getPun_rec_saldo(){
		return $this->pun_rec_saldo;
	}

	/*
	* @return the $pun_rec_habilitado
	*/
	public function getPun_rec_habilitado(){
		return $this->pun_rec_habilitado;
	}

	/*
	* @return the $pun_rec_clave
	*/
	public function getPun_rec_clave(){
		return $this->pun_rec_clave;
	}


	/**
	* @param Ambigous <NULL, unknown> $pun_rec_id 
	*/
	public function setPun_rec_id($pun_rec_id){
		$this->pun_rec_id = $pun_rec_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_nombre 
	*/
	public function setPun_rec_nombre($pun_rec_nombre){
		$this->pun_rec_nombre = $pun_rec_nombre;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_ruc 
	*/
	public function setPun_rec_ruc($pun_rec_ruc){
		$this->pun_rec_ruc = $pun_rec_ruc;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_lat 
	*/
	public function setPun_rec_lat($pun_rec_lat){
		$this->pun_rec_lat = $pun_rec_lat;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_lng 
	*/
	public function setPun_rec_lng($pun_rec_lng){
		$this->pun_rec_lng = $pun_rec_lng;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_direccion 
	*/
	public function setPun_rec_direccion($pun_rec_direccion){
		$this->pun_rec_direccion = $pun_rec_direccion;
	}
	
	/**
	* @param Ambigous <NULL, unknown> $pun_rec_observaciones 
	*/
	public function setPun_rec_observaciones($pun_rec_observaciones){
		$this->pun_rec_observaciones = $pun_rec_observaciones;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_saldo 
	*/
	public function setPun_rec_saldo($pun_rec_saldo){
		$this->pun_rec_saldo = $pun_rec_saldo;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_habilitado 
	*/
	public function setPun_rec_habilitado($pun_rec_habilitado){
		$this->pun_rec_habilitado = $pun_rec_habilitado;
	}
	
	/**
	* @param Ambigous <NULL, unknown> $pun_rec_clave 
	*/
	public function setPun_rec_clave($pun_rec_clave){
		$this->pun_rec_clave = $pun_rec_clave;
	}

	public function exchangeArray($data)
	{
		$this->pun_rec_id = (isset($data['pun_rec_id'])) ? $data['pun_rec_id'] : null;
		$this->pun_rec_nombre = (isset($data['pun_rec_nombre'])) ? $data['pun_rec_nombre'] : null;
		$this->pun_rec_ruc = (isset($data['pun_rec_ruc'])) ? $data['pun_rec_ruc'] : null;
		$this->pun_rec_lat = (isset($data['pun_rec_lat'])) ? $data['pun_rec_lat'] : null;
		$this->pun_rec_lng = (isset($data['pun_rec_lng'])) ? $data['pun_rec_lng'] : null;
		$this->pun_rec_direccion = (isset($data['pun_rec_direccion'])) ? $data['pun_rec_direccion'] : null;
		$this->pun_rec_observaciones = (isset($data['pun_rec_observaciones'])) ? $data['pun_rec_observaciones'] : null;
		$this->pun_rec_saldo	= (isset($data['pun_rec_saldo'])) ? $data['pun_rec_saldo'] : null;
		$this->pun_rec_habilitado	= (isset($data['pun_rec_habilitado'])) ? $data['pun_rec_habilitado'] : null;
		$this->pun_rec_clave	= (isset($data['pun_rec_clave'])) ? $data['pun_rec_clave'] : null;

	}
		
	public function getArrayCopy(){
		return get_object_vars($this);
	}	

}