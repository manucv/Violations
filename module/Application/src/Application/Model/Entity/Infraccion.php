<?php
namespace Application\Model\Entity;

class Infraccion {
	
	private $inf_id;
	private $inf_fecha;
	private $inf_detalles;
	private $usu_id;
	private $tip_inf_id;
	private $sec_id;
	
	function __construct() {}

	/**
	 * @return the $inf_id
	 */
	public function getInf_id() {
		return $this->inf_id;
	}

	/**
	 * @return the $inf_fecha
	 */
	public function getInf_fecha() {
		return $this->inf_fecha;
	}

	/**
	 * @return the $inf_detalles
	 */
	public function getInf_detalles() {
		return $this->inf_detalles;
	}

	/**
	 * @return the $usu_id
	 */
	public function getUsu_id() {
		return $this->usu_id;
	}

	/**
	 * @return the $tip_inf_id
	 */
	public function getTip_inf_id() {
		return $this->tip_inf_id;
	}

	/**
	 * @return the $sec_id
	 */
	public function getSec_id() {
		return $this->sec_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $inf_id
	 */
	public function setInf_id($inf_id) {
		$this->inf_id = $inf_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $inf_fecha
	 */
	public function setInf_fecha($inf_fecha) {
		$this->inf_fecha = $inf_fecha;
	}

	/**
	 * @param Ambigous <NULL, unknown> $inf_detalles
	 */
	public function setInf_detalles($inf_detalles) {
		$this->inf_detalles = $inf_detalles;
	}

	/**
	 * @param Ambigous <NULL, unknown> $usu_id
	 */
	public function setUsu_id($usu_id) {
		$this->usu_id = $usu_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_inf_id
	 */
	public function setTip_inf_id($tip_inf_id) {
		$this->tip_inf_id = $tip_inf_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sec_id
	 */
	public function setSec_id($sec_id) {
		$this->sec_id = $sec_id;
	}

	public function exchangeArray($data)
	{
		$this->inf_id = (isset($data['inf_id'])) ? $data['inf_id'] : null;
		$this->inf_fecha = (isset($data['inf_fecha'])) ? $data['inf_fecha'] : null;
		$this->inf_detalles = (isset($data['inf_detalles'])) ? $data['inf_detalles'] : null;
		$this->usu_id = (isset($data['usu_id'])) ? $data['usu_id'] : null;
		$this->tip_inf_id = (isset($data['tip_inf_id'])) ? $data['tip_inf_id'] : null;
		$this->sec_id = (isset($data['sec_id'])) ? $data['sec_id'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}