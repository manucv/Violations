<?php
namespace Application\Model\Entity;

class Pais {
	
	private $pai_id;
	private $pai_nombre_es;
	private $pai_nombre_en;
	private $pai_codigo_telefono;
	
	function __construct() {}
	
	/**
	 * @return the $pai_id
	 */
	public function getPai_id() {
		return $this->pai_id;
	}

	/**
	 * @return the $pai_nombre_es
	 */
	public function getPai_nombre_es() {
		return $this->pai_nombre_es;
	}

	/**
	 * @return the $pai_nombre_en
	 */
	public function getPai_nombre_en() {
		return $this->pai_nombre_en;
	}

	/**
	 * @return the $pai_codigo_telefono
	 */
	public function getPai_codigo_telefono() {
		return $this->pai_codigo_telefono;
	}

	/**
	 * @param Ambigous <NULL, unknown> $pai_id
	 */
	public function setPai_id($pai_id) {
		$this->pai_id = $pai_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $pai_nombre_es
	 */
	public function setPai_nombre_es($pai_nombre_es) {
		$this->pai_nombre_es = $pai_nombre_es;
	}

	/**
	 * @param Ambigous <NULL, unknown> $pai_nombre_en
	 */
	public function setPai_nombre_en($pai_nombre_en) {
		$this->pai_nombre_en = $pai_nombre_en;
	}

	/**
	 * @param Ambigous <NULL, unknown> $pai_codigo_telefono
	 */
	public function setPai_codigo_telefono($pai_codigo_telefono) {
		$this->pai_codigo_telefono = $pai_codigo_telefono;
	}

	public function exchangeArray($data)
	{
		$this->pai_id = (isset($data['pai_id'])) ? $data['pai_id'] : null;
		$this->pai_nombre_es = (isset($data['pai_nombre_es'])) ? $data['pai_nombre_es'] : null;
		$this->pai_nombre_en = (isset($data['pai_nombre_en'])) ? $data['pai_nombre_en'] : null;
		$this->pai_codigo_telefono = (isset($data['pai_codigo_telefono'])) ? $data['pai_codigo_telefono'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}	
}
