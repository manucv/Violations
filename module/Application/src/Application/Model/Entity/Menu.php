<?php
namespace Application\Model\Entity;

class Menu {
	
	private $men_id;
	private $men_nombre;
	private $men_etiqueta;
	private $apl_id;
	private $men_icon;
	private $men_padre;
	private $men_divisor;
	
	private $apl_descripcion;
	private $apl_nombre;
	
	function __construct() {}

	/**
	 * @return the $men_id
	 */
	public function getMen_id() {
		return $this->men_id;
	}

	/**
	 * @return the $men_nombre
	 */
	public function getMen_nombre() {
		return $this->men_nombre;
	}

	/**
	 * @return the $men_etiqueta
	 */
	public function getMen_etiqueta() {
		return $this->men_etiqueta;
	}

	/**
	 * @return the $apl_id
	 */
	public function getApl_id() {
		return $this->apl_id;
	}

	/**
	 * @return the $men_icon
	 */
	public function getMen_icon() {
		return $this->men_icon;
	}

	/**
	 * @return the $men_padre
	 */
	public function getMen_padre() {
		return $this->men_padre;
	}

	/**
	 * @return the $men_divisor
	 */
	public function getMen_divisor() {
		return $this->men_divisor;
	}

	/**
	 * @return the $apl_descripcion
	 */
	public function getApl_descripcion() {
		return $this->apl_descripcion;
	}

	/**
	 * @return the $apl_nombre
	 */
	public function getApl_nombre() {
		return $this->apl_nombre;
	}

	/**
	 * @param Ambigous <NULL, unknown> $men_id
	 */
	public function setMen_id($men_id) {
		$this->men_id = $men_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $men_nombre
	 */
	public function setMen_nombre($men_nombre) {
		$this->men_nombre = $men_nombre;
	}

	/**
	 * @param Ambigous <NULL, unknown> $men_etiqueta
	 */
	public function setMen_etiqueta($men_etiqueta) {
		$this->men_etiqueta = $men_etiqueta;
	}

	/**
	 * @param Ambigous <NULL, unknown> $apl_id
	 */
	public function setApl_id($apl_id) {
		$this->apl_id = $apl_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $men_icon
	 */
	public function setMen_icon($men_icon) {
		$this->men_icon = $men_icon;
	}

	/**
	 * @param Ambigous <NULL, unknown> $men_padre
	 */
	public function setMen_padre($men_padre) {
		$this->men_padre = $men_padre;
	}

	/**
	 * @param Ambigous <NULL, unknown> $men_divisor
	 */
	public function setMen_divisor($men_divisor) {
		$this->men_divisor = $men_divisor;
	}

	/**
	 * @param Ambigous <NULL, unknown> $apl_descripcion
	 */
	public function setApl_descripcion($apl_descripcion) {
		$this->apl_descripcion = $apl_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $apl_nombre
	 */
	public function setApl_nombre($apl_nombre) {
		$this->apl_nombre = $apl_nombre;
	}

	public function exchangeArray($data)
	{
		$this->men_id = (isset($data['men_id'])) ? $data['men_id'] : null;
		$this->men_nombre = (isset($data['men_nombre'])) ? $data['men_nombre'] : null;
		$this->men_etiqueta = (isset($data['men_etiqueta'])) ? $data['men_etiqueta'] : null;
		$this->apl_id = (isset($data['apl_id'])) ? $data['apl_id'] : null;
		$this->men_icon = (isset($data['men_icon'])) ? $data['men_icon'] : null;
		$this->men_padre = (isset($data['men_padre'])) ? $data['men_padre'] : null;
		$this->men_divisor = (isset($data['men_divisor'])) ? $data['men_divisor'] : null;
		
		$this->apl_descripcion = (isset($data['apl_descripcion'])) ? $data['apl_descripcion'] : null;
		$this->apl_nombre = (isset($data['apl_nombre'])) ? $data['apl_nombre'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}