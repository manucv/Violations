<?php
	//Categoria.php

namespace Application\Model\Entity;

class Establecimiento {

	private $est_id;
	private $cat_id;
	private $est_nombre;
	private $est_descripcion;


	/**
	* @return the $est_id
	*/
	public function getEst_id(){
		return $this->est_id;
	}

	/**
	* @return the $cat_id
	*/
	public function getCat_id(){
		return $this->cat_id;
	}

	/**
	* @return the $est_nombre
	*/
	public function getEst_nombre(){
		return $this->est_nombre;
	}

	/**
	* @return the $est_descripcion
	*/
	public function getEst_descripcion(){
		return $this->est_descripcion;
	}

	/**
	* @param Ambigous <NULL, unknown> $est_id
	*/
	public function setEst_id($est_id){
		$this->est_id=$est_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $cat_id
	*/
	public function setCat_id($cat_id){
		$this->cat_id=$cat_id;
	}

	/**
	* @param Ambigous <NULL, unknown> $est_nombre
	*/
	public function setEst_nombre($est_nombre){
		$this->est_nombre=$est_nombre;
	}

	/**
	* @param Ambigous <NULL, unknown> $est_descripcion
	*/
	public function setEst_descripcion($est_descripcion){
		$this->est_descripcion=$est_descripcion;
	}

	public function exchangeArray($data)
	{

		$this->est_id = (isset($data['est_id'])) ? $data['est_id'] : null;
		$this->cat_id = (isset($data['cat_id'])) ? $data['cat_id'] : null;
		$this->est_nombre = (isset($data['est_nombre'])) ? $data['est_nombre'] : null;
		$this->est_descripcion = (isset($data['est_descripcion'])) ? $data['est_descripcion'] : null;

	}
		
	public function getArrayCopy(){
		return get_object_vars($this);
	}		
}	