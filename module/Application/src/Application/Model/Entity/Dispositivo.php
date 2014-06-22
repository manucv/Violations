<?php
namespace Application\Model\Entity;

class Dispositivo {
	
	private $dis_id;
	private $veh_id;
	private $dis_descripcion;
	private $dis_link;
	private $dis_usuario;
	private $dis_clave;
	
	function __construct() {}

	/**
	 * @return the $dis_id
	 */
	public function getDis_id() {
		return $this->dis_id;
	}

	/**
	 * @return the $veh_id
	 */
	public function getVeh_id() {
		return $this->veh_id;
	}

	/**
	 * @return the $dis_descripcion
	 */
	public function getDis_descripcion() {
		return $this->dis_descripcion;
	}

	/**
	 * @return the $dis_link
	 */
	public function getDis_link() {
		return $this->dis_link;
	}

	/**
	 * @return the $dis_usuario
	 */
	public function getDis_usuario() {
		return $this->dis_usuario;
	}

	/**
	 * @return the $dis_clave
	 */
	public function getDis_clave() {
		return $this->dis_clave;
	}

	/**
	 * @param Ambigous <NULL, unknown> $dis_id
	 */
	public function setDis_id($dis_id) {
		$this->dis_id = $dis_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $veh_id
	 */
	public function setVeh_id($veh_id) {
		$this->veh_id = $veh_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $dis_descripcion
	 */
	public function setDis_descripcion($dis_descripcion) {
		$this->dis_descripcion = $dis_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $dis_link
	 */
	public function setDis_link($dis_link) {
		$this->dis_link = $dis_link;
	}

	/**
	 * @param Ambigous <NULL, unknown> $dis_usuario
	 */
	public function setDis_usuario($dis_usuario) {
		$this->dis_usuario = $dis_usuario;
	}

	/**
	 * @param Ambigous <NULL, unknown> $dis_clave
	 */
	public function setDis_clave($dis_clave) {
		$this->dis_clave = $dis_clave;
	}

	public function exchangeArray($data)
	{
		$this->dis_id = (isset($data['dis_id'])) ? $data['dis_id'] : null;
		$this->veh_id = (isset($data['veh_id'])) ? $data['veh_id'] : null;
		$this->dis_descripcion = (isset($data['dis_descripcion'])) ? $data['dis_descripcion'] : null;
		$this->dis_link = (isset($data['dis_link'])) ? $data['dis_link'] : null;
		$this->dis_usuario = (isset($data['dis_usuario'])) ? $data['dis_usuario'] : null;
		$this->dis_clave = (isset($data['dis_clave'])) ? $data['dis_clave'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}