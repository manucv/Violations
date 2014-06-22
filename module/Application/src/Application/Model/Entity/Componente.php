<?php
namespace Application\Model\Entity;

class Componente {
	
	private $com_id;
	private $sit_id;
	private $com_descripcion;
	private $com_ip_local;
	private $com_ip_publica;
	private $com_usuario;
	private $com_clave;
	private $com_puerto;
	private $com_mascara;
	private $com_gateway;
	private $com_dns1;
	private $com_dns2;
	
	function __construct() {}
	
	/**
	 * @return the $com_id
	 */
	public function getCom_id() {
		return $this->com_id;
	}

	/**
	 * @return the $sit_id
	 */
	public function getSit_id() {
		return $this->sit_id;
	}

	/**
	 * @return the $com_descripcion
	 */
	public function getCom_descripcion() {
		return $this->com_descripcion;
	}

	/**
	 * @return the $com_ip_local
	 */
	public function getCom_ip_local() {
		return $this->com_ip_local;
	}

	/**
	 * @return the $com_ip_publica
	 */
	public function getCom_ip_publica() {
		return $this->com_ip_publica;
	}

	/**
	 * @return the $com_usuario
	 */
	public function getCom_usuario() {
		return $this->com_usuario;
	}

	/**
	 * @return the $com_clave
	 */
	public function getCom_clave() {
		return $this->com_clave;
	}

	/**
	 * @return the $com_puerto
	 */
	public function getCom_puerto() {
		return $this->com_puerto;
	}

	/**
	 * @return the $com_mascara
	 */
	public function getCom_mascara() {
		return $this->com_mascara;
	}

	/**
	 * @return the $com_gateway
	 */
	public function getCom_gateway() {
		return $this->com_gateway;
	}

	/**
	 * @return the $com_dns1
	 */
	public function getCom_dns1() {
		return $this->com_dns1;
	}

	/**
	 * @return the $com_dns2
	 */
	public function getCom_dns2() {
		return $this->com_dns2;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_id
	 */
	public function setCom_id($com_id) {
		$this->com_id = $com_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_id
	 */
	public function setSit_id($sit_id) {
		$this->sit_id = $sit_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_descripcion
	 */
	public function setCom_descripcion($com_descripcion) {
		$this->com_descripcion = $com_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_ip_local
	 */
	public function setCom_ip_local($com_ip_local) {
		$this->com_ip_local = $com_ip_local;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_ip_publica
	 */
	public function setCom_ip_publica($com_ip_publica) {
		$this->com_ip_publica = $com_ip_publica;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_usuario
	 */
	public function setCom_usuario($com_usuario) {
		$this->com_usuario = $com_usuario;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_clave
	 */
	public function setCom_clave($com_clave) {
		$this->com_clave = $com_clave;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_puerto
	 */
	public function setCom_puerto($com_puerto) {
		$this->com_puerto = $com_puerto;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_mascara
	 */
	public function setCom_mascara($com_mascara) {
		$this->com_mascara = $com_mascara;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_gateway
	 */
	public function setCom_gateway($com_gateway) {
		$this->com_gateway = $com_gateway;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_dns1
	 */
	public function setCom_dns1($com_dns1) {
		$this->com_dns1 = $com_dns1;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_dns2
	 */
	public function setCom_dns2($com_dns2) {
		$this->com_dns2 = $com_dns2;
	}

	public function exchangeArray($data)
	{
		$this->com_id = (isset($data['com_id'])) ? $data['com_id'] : null;
		$this->sit_id = (isset($data['sit_id'])) ? $data['sit_id'] : null;
		$this->com_descripcion = (isset($data['com_descripcion'])) ? $data['com_descripcion'] : null;
		$this->com_ip_local = (isset($data['com_ip_local'])) ? $data['com_ip_local'] : null;
		$this->com_ip_publica = (isset($data['com_ip_publica'])) ? $data['com_ip_publica'] : null;
		$this->com_usuario = (isset($data['com_usuario'])) ? $data['com_usuario'] : null;
		$this->com_clave = (isset($data['com_clave'])) ? $data['com_clave'] : null;
		$this->com_puerto = (isset($data['com_puerto'])) ? $data['com_puerto'] : null;
		$this->com_mascara = (isset($data['com_mascara'])) ? $data['com_mascara'] : null;
		$this->com_gateway = (isset($data['com_gateway'])) ? $data['com_gateway'] : null;
		$this->com_dns1 = (isset($data['com_dns1'])) ? $data['com_dns1'] : null;
		$this->com_dns2 = (isset($data['com_dns2'])) ? $data['com_dns2'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}