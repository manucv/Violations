<?php
namespace Application\Model\Entity;

class Sector {
	
	private $sec_id;
	private $sec_nombre;
	private $sec_latitud;
	private $sec_longitud;
	private $ciu_id;
	private $sec_ubicacion;
	
	private $ciu_nombre_es;
	private $pai_id;
	private $est_id;
	
	function __construct() {}

	/**
	 * @return the $sec_id
	 */
	public function getSec_id() {
		return $this->sec_id;
	}

	/**
	 * @return the $sec_nombre
	 */
	public function getSec_nombre() {
		return $this->sec_nombre;
	}

	/**
	 * @return the $sec_latitud
	 */
	public function getSec_latitud() {
		return $this->sec_latitud;
	}

	/**
	 * @return the $sec_longitud
	 */
	public function getSec_longitud() {
		return $this->sec_longitud;
	}

	/**
	 * @return the $ciu_id
	 */
	public function getCiu_id() {
		return $this->ciu_id;
	}

	/**
	 * @return the $sec_ubicacion
	 */
	public function getSec_ubicacion() {
		return $this->sec_ubicacion;
	}

	/**
	 * @return the $ciu_nombre_es
	 */
	public function getCiu_nombre_es() {
		return $this->ciu_nombre_es;
	}

	/**
	 * @return the $pai_id
	 */
	public function getPai_id() {
		return $this->pai_id;
	}

	/**
	 * @return the $est_id
	 */
	public function getEst_id() {
		return $this->est_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sec_id
	 */
	public function setSec_id($sec_id) {
		$this->sec_id = $sec_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sec_nombre
	 */
	public function setSec_nombre($sec_nombre) {
		$this->sec_nombre = $sec_nombre;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sec_latitud
	 */
	public function setSec_latitud($sec_latitud) {
		$this->sec_latitud = $sec_latitud;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sec_longitud
	 */
	public function setSec_longitud($sec_longitud) {
		$this->sec_longitud = $sec_longitud;
	}

	/**
	 * @param Ambigous <NULL, unknown> $ciu_id
	 */
	public function setCiu_id($ciu_id) {
		$this->ciu_id = $ciu_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sec_ubicacion
	 */
	public function setSec_ubicacion($sec_ubicacion) {
		$this->sec_ubicacion = $sec_ubicacion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $ciu_nombre_es
	 */
	public function setCiu_nombre_es($ciu_nombre_es) {
		$this->ciu_nombre_es = $ciu_nombre_es;
	}

	/**
	 * @param Ambigous <NULL, unknown> $pai_id
	 */
	public function setPai_id($pai_id) {
		$this->pai_id = $pai_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $est_id
	 */
	public function setEst_id($est_id) {
		$this->est_id = $est_id;
	}

	public function exchangeArray($data)
	{
		$this->sec_id = (isset($data['sec_id'])) ? $data['sec_id'] : null;
		$this->sec_nombre = (isset($data['sec_nombre'])) ? $data['sec_nombre'] : null;
		$this->sec_latitud = (isset($data['sec_latitud'])) ? $data['sec_latitud'] : null;
		$this->sec_longitud = (isset($data['sec_longitud'])) ? $data['sec_longitud'] : null;
		$this->ciu_id = (isset($data['ciu_id'])) ? $data['ciu_id'] : null;
		$this->sec_ubicacion = (isset($data['sec_ubicacion'])) ? $data['sec_ubicacion'] : null;
		$this->ciu_nombre_es = (isset($data['ciu_nombre_es'])) ? $data['ciu_nombre_es'] : null;
		$this->pai_id = (isset($data['pai_id'])) ? $data['pai_id'] : null;
		$this->est_id = (isset($data['est_id'])) ? $data['est_id'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}	
}