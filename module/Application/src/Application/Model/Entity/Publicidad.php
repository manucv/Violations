<?php
//Publicidad.php

namespace Application\Model\Entity;

class Publicidad {
	

	private $pub_id;
	private $pub_nombre;
	private $pub_imagen;
	private $pub_link;
	private $pub_estado;


	function _construct(){}

	/**
	* @return the $pub_id
	*/
	public function getPub_id(){
		return $this->pub_id;
	}
	/**
	* @return the $pub_nombre
	*/
	public function getPub_nombre(){
		return $this->pub_nombre;
	}
	/**
	* @return the $pub_imagen
	*/
	public function getPub_imagen(){
		return $this->pub_imagen;
	}
	/**
	* @return the $pub_link
	*/
	public function getPub_link(){
		return $this->pub_link;
	}
	/**
	* @return the $pub_estado
	*/
	public function getPub_estado(){
		return $this->pub_estado;
	}


	/**
	* @param Ambigous <NULL, unknown> $pub_id
	*/
	public function setPub_id($pub_id){
		$this->pub_id = $pub_id;
	}
	/**
	* @param Ambigous <NULL, unknown> $pub_nombre
	*/
	public function setPub_nombre($pub_nombre){
		$this->pub_nombre = $pub_nombre;
	}
	/**
	* @param Ambigous <NULL, unknown> $pub_imagen
	*/
	public function setPub_imagen($pub_imagen){
		$this->pub_imagen = $pub_imagen;
	}
	/**
	* @param Ambigous <NULL, unknown> $pub_link
	*/
	public function setPub_link($pub_link){
		$this->pub_link = $pub_link;
	}
	/**
	* @param Ambigous <NULL, unknown> $pub_estado	
	*/
	public function setPub_estado($pub_estado){
		$this->pub_estado = $pub_estado;
	}

	

	public function exchangeArray($data)
	{

		$this->pub_id = (isset($data['pub_id'])) ? $data['pub_id'] : null;
		$this->pub_nombre = (isset($data['pub_nombre'])) ? $data['pub_nombre'] : null;
		$this->pub_imagen = (isset($data['pub_imagen'])) ? $data['pub_imagen'] : null;
		$this->pub_link = (isset($data['pub_link'])) ? $data['pub_link'] : null;
		$this->pub_estado = (isset($data['pub_estado'])) ? $data['pub_estado'] : null;

	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}