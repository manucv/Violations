<?php

namespace Application\Model\Entity;

class RolUsuario {
	
	private $rol_id;
	private $usu_id;
	
	public function __construct() {
	}
	
	/**
	 *
	 * @return the $rol_id
	 */
	public function getRol_id() {
		return $this->rol_id;
	}
	
	/**
	 *
	 * @return the $usu_id
	 */
	public function getUsu_id() {
		return $this->usu_id;
	}
	
	/**
	 *
	 * @param
	 *        	Ambigous <NULL, unknown> $rol_id
	 */
	public function setRol_id($rol_id) {
		$this->rol_id = $rol_id;
	}
	
	/**
	 *
	 * @param
	 *        	Ambigous <NULL, unknown> $usu_id
	 */
	public function setUsu_id($usu_id) {
		$this->usu_id = $usu_id;
	}
	
	public function exchangeArray($data) {
		$this->rol_id = (! empty ( $data ['rol_id'] )) ? $data ['rol_id'] : null;
		$this->usu_id = (! empty ( $data ['usu_id'] )) ? $data ['usu_id'] : null;
	}
	
	public function getArrayCopy() {
		return get_object_vars ( $this );
	}
}