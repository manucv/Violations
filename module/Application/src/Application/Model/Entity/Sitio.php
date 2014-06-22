<?php
namespace Application\Model\Entity;

class Sitio {
	
	private $sit_id;
	private $ciu_id;
	private $sit_descripcion;
	private $sit_direccion;
	private $sit_sector;
	private $sit_reference_number;
	private $sit_estado;
	
	private $ciu_nombre_es;
	private $ciu_nombre_en;
	
	function __construct() {}
	
	/**
	 * @return the $sit_id
	 */
	public function getSit_id() {
		return $this->sit_id;
	}

	/**
	 * @return the $ciu_id
	 */
	public function getCiu_id() {
		return $this->ciu_id;
	}

	/**
	 * @return the $sit_descripcion
	 */
	public function getSit_descripcion() {
		return $this->sit_descripcion;
	}

	/**
	 * @return the $sit_direccion
	 */
	public function getSit_direccion() {
		return $this->sit_direccion;
	}

	/**
	 * @return the $sit_sector
	 */
	public function getSit_sector() {
		return $this->sit_sector;
	}

	/**
	 * @return the $sit_reference_number
	 */
	public function getSit_reference_number() {
		return $this->sit_reference_number;
	}

	/**
	 * @return the $sit_estado
	 */
	public function getSit_estado() {
		return $this->sit_estado;
	}

	/**
	 * @return the $ciu_nombre_es
	 */
	public function getCiu_nombre_es() {
		return $this->ciu_nombre_es;
	}

	/**
	 * @return the $ciu_nombre_en
	 */
	public function getCiu_nombre_en() {
		return $this->ciu_nombre_en;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_id
	 */
	public function setSit_id($sit_id) {
		$this->sit_id = $sit_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $ciu_id
	 */
	public function setCiu_id($ciu_id) {
		$this->ciu_id = $ciu_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_descripcion
	 */
	public function setSit_descripcion($sit_descripcion) {
		$this->sit_descripcion = $sit_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_direccion
	 */
	public function setSit_direccion($sit_direccion) {
		$this->sit_direccion = $sit_direccion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_sector
	 */
	public function setSit_sector($sit_sector) {
		$this->sit_sector = $sit_sector;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_reference_number
	 */
	public function setSit_reference_number($sit_reference_number) {
		$this->sit_reference_number = $sit_reference_number;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_estado
	 */
	public function setSit_estado($sit_estado) {
		$this->sit_estado = $sit_estado;
	}

	/**
	 * @param Ambigous <NULL, unknown> $ciu_nombre_es
	 */
	public function setCiu_nombre_es($ciu_nombre_es) {
		$this->ciu_nombre_es = $ciu_nombre_es;
	}

	/**
	 * @param Ambigous <NULL, unknown> $ciu_nombre_en
	 */
	public function setCiu_nombre_en($ciu_nombre_en) {
		$this->ciu_nombre_en = $ciu_nombre_en;
	}

	public function exchangeArray($data)
	{
		$this->sit_id = (isset($data['sit_id'])) ? $data['sit_id'] : null;
		$this->ciu_id = (isset($data['ciu_id'])) ? $data['ciu_id'] : null;
		$this->sit_descripcion = (isset($data['sit_descripcion'])) ? $data['sit_descripcion'] : null;
		$this->sit_direccion = (isset($data['sit_direccion'])) ? $data['sit_direccion'] : null;
		$this->sit_sector = (isset($data['sit_sector'])) ? $data['sit_sector'] : null;
		$this->sit_reference_number = (isset($data['sit_reference_number'])) ? $data['sit_reference_number'] : null;
		$this->sit_estado = (isset($data['sit_estado'])) ? $data['sit_estado'] : null;
		
		$this->ciu_nombre_es = (isset($data['ciu_nombre_es'])) ? $data['ciu_nombre_es'] : null;
		$this->ciu_nombre_en = (isset($data['ciu_nombre_en'])) ? $data['ciu_nombre_en'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}