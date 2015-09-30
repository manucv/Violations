<?php
namespace Application\Model\Entity;

class TipoInfraccion {
	
	private $tip_inf_id;
	private $cat_inf_id;
	private $tip_inf_descripcion;

	
	function __construct() {}

	/**
	 * @return the $tip_inf_id
	 */
	public function getTip_inf_id() {
		return $this->tip_inf_id;
	}

	/**
	 * @return the $cat_inf_id
	 */
	public function getCat_inf_id() {
		return $this->cat_inf_id;
	}

	/**
	 * @return the $tip_inf_descripcion
	 */
	public function getTip_inf_descripcion() {
		return $this->tip_inf_descripcion;
	}

	/**
	 * @return the $tip_inf_legal
	 */
	public function getTip_inf_legal() {
		return $this->tip_inf_legal;
	}

	/**
	 * @return the $tip_inf_valor
	 */
	public function getTip_inf_valor() {
		return $this->tip_inf_valor;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_inf_id
	 */
	public function setTip_inf_id($tip_inf_id) {
		$this->tip_inf_id = $tip_inf_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_inf_id
	 */
	public function setCat_inf_id($cat_inf_id) {
		$this->cat_inf_id = $cat_inf_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_inf_descripcion
	 */
	public function setTip_inf_descripcion($tip_inf_descripcion) {
		$this->tip_inf_descripcion = $tip_inf_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_inf_legal
	 */
	public function setTip_inf_legal($tip_inf_legal) {
		$this->tip_inf_legal = $tip_inf_legal;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_inf_valor
	 */
	public function setTip_inf_valor($tip_inf_valor) {
		$this->tip_inf_valor = $tip_inf_valor;
	}

	public function exchangeArray($data)
	{
		$this->tip_inf_id = (isset($data['tip_inf_id'])) ? $data['tip_inf_id'] : null;
		$this->cat_inf_id = (isset($data['cat_inf_id'])) ? $data['cat_inf_id'] : null;
		$this->tip_inf_descripcion = (isset($data['tip_inf_descripcion'])) ? $data['tip_inf_descripcion'] : null;
		$this->tip_inf_legal = (isset($data['tip_inf_legal'])) ? $data['tip_inf_legal'] : null;
		$this->tip_inf_valor = (isset($data['tip_inf_valor'])) ? $data['tip_inf_valor'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}