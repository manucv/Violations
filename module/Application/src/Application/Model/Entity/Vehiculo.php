<?php
namespace Application\Model\Entity;

class Vehiculo {
	
	private $veh_id;
	private $tip_veh_id;
	private $veh_marca;
	private $veh_modelo;
	private $veh_placa;
	private $veh_camara_activa;
	
	private $tip_veh_descripcion;
	
	function __construct() {}


	/**
	 * @return the $veh_id
	 */
	public function getVeh_id() {
		return $this->veh_id;
	}

	/**
	 * @return the $tip_veh_id
	 */
	public function getTip_veh_id() {
		return $this->tip_veh_id;
	}

	/**
	 * @return the $veh_marca
	 */
	public function getVeh_marca() {
		return $this->veh_marca;
	}

	/**
	 * @return the $veh_modelo
	 */
	public function getVeh_modelo() {
		return $this->veh_modelo;
	}

	/**
	 * @return the $veh_placa
	 */
	public function getVeh_placa() {
		return $this->veh_placa;
	}

	/**
	 * @return the $veh_camara_activa
	 */
	public function getVeh_camara_activa() {
		return $this->veh_camara_activa;
	}

	/**
	 * @return the $tip_veh_descripcion
	 */
	public function getTip_veh_descripcion() {
		return $this->tip_veh_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $veh_id
	 */
	public function setVeh_id($veh_id) {
		$this->veh_id = $veh_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_veh_id
	 */
	public function setTip_veh_id($tip_veh_id) {
		$this->tip_veh_id = $tip_veh_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $veh_marca
	 */
	public function setVeh_marca($veh_marca) {
		$this->veh_marca = $veh_marca;
	}

	/**
	 * @param Ambigous <NULL, unknown> $veh_modelo
	 */
	public function setVeh_modelo($veh_modelo) {
		$this->veh_modelo = $veh_modelo;
	}

	/**
	 * @param Ambigous <NULL, unknown> $veh_placa
	 */
	public function setVeh_placa($veh_placa) {
		$this->veh_placa = $veh_placa;
	}

	/**
	 * @param Ambigous <NULL, unknown> $veh_camara_activa
	 */
	public function setVeh_camara_activa($veh_camara_activa) {
		$this->veh_camara_activa = $veh_camara_activa;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_veh_descripcion
	 */
	public function setTip_veh_descripcion($tip_veh_descripcion) {
		$this->tip_veh_descripcion = $tip_veh_descripcion;
	}

	public function exchangeArray($data)
	{
		$this->veh_id = (isset($data['veh_id'])) ? $data['veh_id'] : null;
		$this->tip_veh_id = (isset($data['tip_veh_id'])) ? $data['tip_veh_id'] : null;
		$this->veh_marca = (isset($data['veh_marca'])) ? $data['veh_marca'] : null;
		$this->veh_modelo = (isset($data['veh_modelo'])) ? $data['veh_modelo'] : null;
		$this->veh_placa = (isset($data['veh_placa'])) ? $data['veh_placa'] : null;
		$this->veh_camara_activa = (isset($data['veh_camara_activa'])) ? $data['veh_camara_activa'] : null;
		
		$this->tip_veh_descripcion = (isset($data['tip_veh_descripcion'])) ? $data['tip_veh_descripcion'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}