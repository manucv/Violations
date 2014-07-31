<?php
namespace Application\Model\Entity;

class Componente {
	
	private $com_id;
	private $sit_id;
	private $tip_com_id;
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
	private $com_estado;
	private $com_ultima_respuesta;
	private $com_ultimo_valor;
	
	private $sit_descripcion;
	private $tip_com_descripcion;
	
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
	 * @return the $tip_com_id
	 */
	public function getTip_com_id() {
		return $this->tip_com_id;
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
	 * @return the $com_estado
	 */
	public function getCom_estado() {
		return $this->com_estado;
	}

	/**
	 * @return the $com_ultima_respuesta
	 */
	public function getCom_ultima_respuesta() {
		return $this->com_ultima_respuesta;
	}

	/**
	 * @return the $com_ultimo_valor
	 */
	public function getCom_ultimo_valor() {
		return $this->com_ultimo_valor;
	}

	/**
	 * @return the $sit_descripcion
	 */
	public function getSit_descripcion() {
		return $this->sit_descripcion;
	}

	/**
	 * @return the $tip_com_descripcion
	 */
	public function getTip_com_descripcion() {
		return $this->tip_com_descripcion;
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
	 * @param Ambigous <NULL, unknown> $tip_com_id
	 */
	public function setTip_com_id($tip_com_id) {
		$this->tip_com_id = $tip_com_id;
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

	/**
	 * @param Ambigous <NULL, unknown> $com_estado
	 */
	public function setCom_estado($com_estado) {
		$this->com_estado = $com_estado;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_ultima_respuesta
	 */
	public function setCom_ultima_respuesta($com_ultima_respuesta) {
		$this->com_ultima_respuesta = $com_ultima_respuesta;
	}

	/**
	 * @param Ambigous <NULL, unknown> $com_ultimo_valor
	 */
	public function setCom_ultimo_valor($com_ultimo_valor) {
		$this->com_ultimo_valor = $com_ultimo_valor;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sit_descripcion
	 */
	public function setSit_descripcion($sit_descripcion) {
		$this->sit_descripcion = $sit_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_com_descripcion
	 */
	public function setTip_com_descripcion($tip_com_descripcion) {
		$this->tip_com_descripcion = $tip_com_descripcion;
	}

	public function exchangeArray($data)
	{
		$this->com_id = (isset($data['com_id'])) ? $data['com_id'] : null;
		$this->sit_id = (isset($data['sit_id'])) ? $data['sit_id'] : null;
		$this->tip_com_id = (isset($data['tip_com_id'])) ? $data['tip_com_id'] : null;
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
		$this->com_estado = (isset($data['com_estado'])) ? $data['com_estado'] : null;
		$this->com_ultima_respuesta = (isset($data['com_ultima_respuesta'])) ? $data['com_ultima_respuesta'] : null;
		$this->com_ultimo_valor = (isset($data['com_ultimo_valor'])) ? $data['com_ultimo_valor'] : null;
		
		$this->sit_descripcion = (isset($data['sit_descripcion'])) ? $data['sit_descripcion'] : null;
		$this->tip_com_descripcion = (isset($data['tip_com_descripcion'])) ? $data['tip_com_descripcion'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}