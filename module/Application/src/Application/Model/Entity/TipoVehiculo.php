<?php
namespace Application\Model\Entity;

class TipoVehiculo {
	
	private $tip_veh_id;
	private $tip_veh_descripcion;
	
	function __construct() {}

	/**
	 * @return the $tip_veh_id
	 */
	public function getTip_veh_id() {
		return $this->tip_veh_id;
	}

	/**
	 * @return the $tip_veh_descripcion
	 */
	public function getTip_veh_descripcion() {
		return $this->tip_veh_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_veh_id
	 */
	public function setTip_veh_id($tip_veh_id) {
		$this->tip_veh_id = $tip_veh_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_veh_descripcion
	 */
	public function setTip_veh_descripcion($tip_veh_descripcion) {
		$this->tip_veh_descripcion = $tip_veh_descripcion;
	}

	public function exchangeArray($data)
	{
		$this->tip_veh_id = (isset($data['tip_veh_id'])) ? $data['tip_veh_id'] : null;
		$this->tip_veh_descripcion = (isset($data['tip_veh_descripcion'])) ? $data['tip_veh_descripcion'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}