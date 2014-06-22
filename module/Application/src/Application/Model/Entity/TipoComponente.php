<?php
namespace Application\Model\Entity;

class TipoComponente {
	
	private $tip_com_id;
	private $tip_com_descripcion;
	private $tip_com_imagen;
	
	function __construct() {}

	/**
	 * @return the $tip_com_id
	 */
	public function getTip_com_id() {
		return $this->tip_com_id;
	}

	/**
	 * @return the $tip_com_descripcion
	 */
	public function getTip_com_descripcion() {
		return $this->tip_com_descripcion;
	}

	/**
	 * @return the $tip_com_imagen
	 */
	public function getTip_com_imagen() {
		return $this->tip_com_imagen;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_com_id
	 */
	public function setTip_com_id($tip_com_id) {
		$this->tip_com_id = $tip_com_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_com_descripcion
	 */
	public function setTip_com_descripcion($tip_com_descripcion) {
		$this->tip_com_descripcion = $tip_com_descripcion;
	}

	/**
	 * @param Ambigous <NULL, unknown> $tip_com_imagen
	 */
	public function setTip_com_imagen($tip_com_imagen) {
		$this->tip_com_imagen = $tip_com_imagen;
	}

	public function exchangeArray($data)
	{
		$this->tip_com_id = (isset($data['tip_com_id'])) ? $data['tip_com_id'] : null;
		$this->tip_com_descripcion = (isset($data['tip_com_descripcion'])) ? $data['tip_com_descripcion'] : null;
		$this->tip_com_imagen = (isset($data['tip_com_imagen'])) ? $data['tip_com_imagen'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}