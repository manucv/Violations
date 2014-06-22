<?php
namespace Application\Model\Entity;

class Rol {
	
	private $rol_id;
	private $rol_descripcion;
	private $rol_estado;
	
	public function __construct(){}
	
	/**
	 * @return the $rol_id
	 */
	public function getRol_id() {
		return $this->rol_id;
	}

	/**
	 * @return the $rol_descripcion
	 */
	public function getRol_descripcion() {
		return $this->rol_descripcion;
	}

	/**
	 * @return the $rol_estado
	 */
	public function getRol_estado() {
		return $this->rol_estado;
	}

	/**
	 * @param Ambigous <NULL, unknown> $rol_id
	 */
	public function setRol_id($rol_id) {
		$this->rol_id = $rol_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $rol_descripcion
	 */
	public function setRol_descripcion($rol_descripcion) {
		$this->rol_descripcion = $rol_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $rol_estado
	 */
	public function setRol_estado($rol_estado) {
		$this->rol_estado = $rol_estado;
	}

	public function exchangeArray($data) {
		$this->rol_id = (isset ( $data ['rol_id'] )) ? $data ['rol_id'] : null;
		$this->rol_descripcion = (isset ( $data ['rol_descripcion'] )) ? $data ['rol_descripcion'] : null;
		$this->rol_estado = (isset ( $data ['rol_estado'] )) ? $data ['rol_estado'] : null;
	}
	
	public function getArrayCopy() {
		return get_object_vars ( $this );
	}
}