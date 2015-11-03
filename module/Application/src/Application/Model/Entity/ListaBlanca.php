<?php
	//ListaBlanca.php

	
namespace Application\Model\Entity;

class ListaBlanca {

	private $lis_bla_id;
	private $lis_bla_placa;

	/*
	* @return the $lis_bla_id
	*/
	public function getLis_bla_id(){
		return $this->lis_bla_id;
	}

	/*
	* @return the $lis_bla_placa
	*/
	public function getLis_bla_placa(){
		return $this->lis_bla_placa;
	}

	/**
	* @param Ambigous <NULL, unknown> $lis_bla_id 
	*/
	public function setLis_bla_id($lis_bla_id){
		$this->lis_bla_id = $lis_bla_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $lis_bla_placa 
	*/
	public function setLis_bla_placa($lis_bla_placa){
		$this->lis_bla_placa = $lis_bla_placa;
	}

	public function exchangeArray($data)
	{
		$this->lis_bla_id = (isset($data['lis_bla_id'])) ? $data['lis_bla_id'] : null;
		$this->lis_bla_placa = (isset($data['lis_bla_placa'])) ? $data['lis_bla_placa'] : null;

	}
		
	public function getArrayCopy(){
		return get_object_vars($this);
	}


}