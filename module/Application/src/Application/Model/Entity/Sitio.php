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
	private $sit_latitud;
	private $sit_longitud;
	private $sit_ultima_respuesta;
	private $sit_ultimo_valor;
	private $ciu_nombre_es;
	private $ciu_nombre_en;
	private $est_id;
	private $est_nombre_es;
	private $pai_id;
	private $pai_nombre_es;
	
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
	 * @return the $sit_latitud
	 */
	public function getSit_latitud() {
		return $this->sit_latitud;
	}

	/**
	 * @return the $sit_longitud
	 */
	public function getSit_longitud() {
		return $this->sit_longitud;
	}

	/**
	 * @return the $sit_ultima_respuesta
	 */
	public function getSit_ultima_respuesta() {
		return $this->sit_ultima_respuesta;
	}

	/**
	 * @return the $sit_ultimo_valor
	 */
	public function getSit_ultimo_valor() {
		return $this->sit_ultimo_valor;
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
	 * @return the $est_id
	 */
	public function getEst_id() {
		return $this->est_id;
	}

	/**
	 * @return the $est_nombre_es
	 */
	public function getEst_nombre_es() {
		return $this->est_nombre_es;
	}

	/**
	 * @return the $pai_id
	 */
	public function getPai_id() {
		return $this->pai_id;
	}

	/**
	 * @return the $pai_nombre_es
	 */
	public function getPai_nombre_es() {
		return $this->pai_nombre_es;
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
	 * @param Ambigous <NULL, unknown> $sit_latitud
	 */
	public function setSit_latitud($sit_latitud) {
		$this->sit_latitud = $sit_latitud;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_longitud
	 */
	public function setSit_longitud($sit_longitud) {
		$this->sit_longitud = $sit_longitud;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_ultima_respuesta
	 */
	public function setSit_ultima_respuesta($sit_ultima_respuesta) {
		$this->sit_ultima_respuesta = $sit_ultima_respuesta;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_ultimo_valor
	 */
	public function setSit_ultimo_valor($sit_ultimo_valor) {
		$this->sit_ultimo_valor = $sit_ultimo_valor;
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

	/**
	 * @param Ambigous <NULL, unknown> $est_id
	 */
	public function setEst_id($est_id) {
		$this->est_id = $est_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $est_nombre_es
	 */
	public function setEst_nombre_es($est_nombre_es) {
		$this->est_nombre_es = $est_nombre_es;
	}

	/**
	 * @param Ambigous <NULL, unknown> $pai_id
	 */
	public function setPai_id($pai_id) {
		$this->pai_id = $pai_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $pai_nombre_es
	 */
	public function setPai_nombre_es($pai_nombre_es) {
		$this->pai_nombre_es = $pai_nombre_es;
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
		$this->sit_latitud = (isset($data['sit_latitud'])) ? $data['sit_latitud'] : null;
		$this->sit_longitud = (isset($data['sit_longitud'])) ? $data['sit_longitud'] : null;
		$this->sit_ultima_respuesta = (isset($data['sit_ultima_respuesta'])) ? $data['sit_ultima_respuesta'] : null;
		$this->sit_ultimo_valor = (isset($data['sit_ultimo_valor'])) ? $data['sit_ultimo_valor'] : null;
		$this->pai_id = (isset($data['pai_id'])) ? $data['pai_id'] : null;
		$this->est_id = (isset($data['est_id'])) ? $data['est_id'] : null;
		$this->est_nombre_es = (isset($data['est_nombre_es'])) ? $data['est_nombre_es'] : null;
		$this->pai_nombre_es = (isset($data['pai_nombre_es'])) ? $data['pai_nombre_es'] : null;
		$this->ciu_nombre_es = (isset($data['ciu_nombre_es'])) ? $data['ciu_nombre_es'] : null;
		$this->ciu_nombre_en = (isset($data['ciu_nombre_en'])) ? $data['ciu_nombre_en'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}