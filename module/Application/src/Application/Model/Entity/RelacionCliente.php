<?php
	//RelacionCliente.php

namespace Application\Model\Entity;

class RelacionCliente
{
	private $rel_cli_id;
	private $cli_id;
	private $cli_id_relacionado;
	private $rel_cli_hora;
	private $rel_cli_tipo;

	/**
	* @return the $rel_cli_id
	*/
	public function getRel_cli_id(){
		return $this->rel_cli_id;
	}

	/**
	* @return the $cli_id
	*/
	public function getCli_id(){
		return $this->cli_id;
	}

	/**
	* @return the $cli_id_relacionado
	*/
	public function getCli_id_relacionado(){
		return $this->cli_id_relacionado;
	}

	/**
	* @return the $rel_cli_hora
	*/
	public function getRel_cli_hora(){
		return $this->rel_cli_hora;
	}

	/**
	* @return the $rel_cli_tipo
	*/
	public function getRel_cli_tipo(){
		return $this->rel_cli_tipo;
	}

	/**
	* @param Ambigous <Null, unknown> $tra_sal_id
	*/
	public function setTra_sal_id($tra_sal_id){
		$this->tra_sal_id=$tra_sal_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $rel_cli_id
	*/
	public function setRel_cli_id($rel_cli_id){
		$this->rel_cli_id=$rel_cli_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $cli_id
	*/
	public function setCli_id($cli_id){
		$this->cli_id=$cli_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $cli_id_relacionado
	*/
	public function setCli_id_relacionado($cli_id_relacionado){
		$this->cli_id_relacionado=$cli_id_relacionado;
	}

	/**
	* @param Ambigous <NULL, unknown> $rel_cli_hora
	*/
	public function setRel_cli_hora($rel_cli_hora){
		$this->rel_cli_hora=$rel_cli_hora;
	}

	/**
	* @param Ambigous <NULL, unknown> $rel_cli_tipo	
	*/
	public function setRel_cli_tipo($rel_cli_tipo){
		$this->rel_cli_tipo=$rel_cli_tipo;
	}

	public function exchangeArray($data)
	{
		$this->rel_cli_id = (isset($data['rel_cli_id'])) ? $data['rel_cli_id'] : null;
		$this->cli_id = (isset($data['cli_id'])) ? $data['cli_id'] : null;
		$this->cli_id_relacionado = (isset($data['cli_id_relacionado'])) ? $data['cli_id_relacionado'] : null;
		$this->rel_cli_hora = (isset($data['rel_cli_hora'])) ? $data['rel_cli_hora'] : null;
		$this->rel_cli_tipo = (isset($data['rel_cli_tipo'])) ? $data['rel_cli_tipo'] : null;
		$this->usu_nombre = (isset($data['usu_nombre'])) ? $data['usu_nombre'] : null;
		$this->usu_apellido = (isset($data['usu_apellido'])) ? $data['usu_apellido'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}	

}