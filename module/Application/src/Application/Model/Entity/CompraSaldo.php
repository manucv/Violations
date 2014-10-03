<?php
	//CompraSaldo.php

namespace Application\Model\Entity;

class CompraSaldo {

	private $com_sal_id;
	private $cli_id;
	private $pun_rec_id;
	private $com_sal_valor;
	private $com_sal_hora;


	function __construct() {}

	/**
	* @return the $com_sal_id
	*/
	public function getCom_sal_id(){
		return $this->com_sal_id;
	}

	/**
	* @return the $cli_id
	*/
	public function getCli_id(){
		return $this->cli_id;
	}

	/**
	* @return the $pun_rec_id
	*/
	public function getPun_rec_id(){
		return $this->pun_rec_id;
	}

	/**
	* @return the $com_sal_valor
	*/
	public function getCom_sal_valor(){
		return $this->com_sal_valor;
	}

	/**
	* @return the $com_sal_hora
	*/
	public function getCom_sal_hora(){
		return $this->com_sal_hora;
	}


	/**
	* @param Ambigous <NULL, unknown> $com_sal_id
	*/
	public function setCom_sal_id($com_sal_id){
		$this->com_sal_id = $com_sal_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $cli_id
	*/
	public function setCli_id($cli_id){
		$this->cli_id = $cli_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $pun_rec_id
	*/
	public function setPun_rec_id($pun_rec_id){
		$this->pun_rec_id = $pun_rec_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $com_sal_valor
	*/
	public function setCom_sal_valor($com_sal_valor){
		$this->com_sal_valor = $com_sal_valor;
	}

	/**
	* @param Ambigous <NULL, unknown> $com_sal_hora
	*/
	public function setCom_sal_hora($com_sal_hora){
		$this->com_sal_hora = $com_sal_hora;
	}

	public function exchangeArray($data)
	{
		$this->com_sal_id = (isset($data['com_sal_id'])) ? $data['com_sal_id'] : null;
		$this->cli_id = (isset($data['cli_id'])) ? $data['cli_id'] : null;
		$this->pun_rec_id = (isset($data['pun_rec_id'])) ? $data['pun_rec_id'] : null;
		$this->com_sal_valor = (isset($data['com_sal_valor'])) ? $data['com_sal_valor'] : null;
		$this->om_sal_hora = (isset($data['om_sal_hora'])) ? $data['om_sal_hora'] : null;	
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}