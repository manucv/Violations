<?php
namespace Application\Model\Entity;

class Aplicacion {
	
	private $apl_descripcion;
	private $apl_id;
	private $apl_nombre;
	
	public function __construct(){}
	
	/**
	 * @return the $apl_descripcion
	 */
	public function getApl_descripcion() {
		return $this->apl_descripcion;
	}

	/**
	 * @return the $apl_id
	 */
	public function getApl_id() {
		return $this->apl_id;
	}

	/**
	 * @return the $apl_nombre
	 */
	public function getApl_nombre() {
		return $this->apl_nombre;
	}

	/**
	 * @param Ambigous <NULL, unknown> $apl_descripcion
	 */
	public function setApl_descripcion($apl_descripcion) {
		$this->apl_descripcion = $apl_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $apl_id
	 */
	public function setApl_id($apl_id) {
		$this->apl_id = $apl_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $apl_nombre
	 */
	public function setApl_nombre($apl_nombre) {
		$this->apl_nombre = $apl_nombre;
	}

	public function exchangeArray($data) {
		$this->apl_descripcion = (! empty ( $data ['apl_descripcion'] )) ? $data ['apl_descripcion'] : null;
		$this->apl_id = (! empty ( $data ['apl_id'] )) ? $data ['apl_id'] : null;
		$this->apl_nombre = (! empty ( $data ['apl_nombre'] )) ? $data ['apl_nombre'] : null;
	}
	
	public function getArrayCopy() {
		return get_object_vars ( $this );
	}
}