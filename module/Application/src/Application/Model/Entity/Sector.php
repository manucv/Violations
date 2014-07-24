<?php
namespace Application\Model\Entity;

class Sector {
	
	private $sec_id;
	private $sec_nombre;
	private $sec_latitud;
	private $sec_longitud;
	
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

	public function exchangeArray($data)
	{
		$this->sec_id = (isset($data['sec_id'])) ? $data['sec_id'] : null;
		$this->sec_nombre = (isset($data['sec_nombre'])) ? $data['sec_nombre'] : null;
		$this->sec_latitud = (isset($data['sec_latitud'])) ? $data['sec_latitud'] : null;
		$this->sec_longitud = (isset($data['sec_longitud'])) ? $data['sec_longitud'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}	
}