<?php
	//Categoria.php

namespace Application\Model\Entity;

class Categoria {

	private $cat_id;
	private $cat_nombre;
	private $cat_descripcion;

	/**
	* @return the $cat_id
	*/
	public function getCat_id(){
		return $this->cat_id();
	}
	/**
	* @return the $cat_nombre
	*/
	public function getCat_nombre(){
		return $this->cat_nombre();
	}
	/**
	* @return the $cat_descripcion
	*/
	public function getCat_descripcion(){
		return $this->cat_descripcion();
	}

	/**
	* @param Ambigous <NULL, unknown> $cat_id
	*/
	public function setCat_id($cat_id){
		$this->cat_id=$cat_id;
	}
	/**
	* @param Ambigous <NULL, unknown> $cat_nombre
	*/
	public function setCat_nombre($cat_nombre){
		$this->cat_nombre=$cat_nombre;
	}
	/**
	* @param Ambigous <NULL, unknown> $cat_descripcion
	*/
	public function setCat_descripcion($cat_descripcion){
		$this->cat_descripcion=$cat_descripcion;
	}

	public function exchangeArray($data)
	{
		$this->cat_id = (isset($data['cat_id'])) ? $data['cat_id'] : null;
		$this->cat_nombre = (isset($data['cat_nombre'])) ? $data['cat_nombre'] : null;
		$this->cat_descripcion = (isset($data['cat_descripcion'])) ? $data['cat_descripcion'] : null;
	}
		
	public function getArrayCopy(){
		return get_object_vars($this);
	}		
}	