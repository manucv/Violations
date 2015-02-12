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

	public function exchangeArray($data)
	{
		$this->tip_inf_id = (isset($data['tip_inf_id'])) ? $data['tip_inf_id'] : null;
		$this->cat_inf_id = (isset($data['cat_inf_id'])) ? $data['cat_inf_id'] : null;
		$this->tip_inf_descripcion = (isset($data['tip_inf_descripcion'])) ? $data['tip_inf_descripcion'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}