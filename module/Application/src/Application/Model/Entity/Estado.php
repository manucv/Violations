<?php
namespace Application\Model\Entity;

class Estado {
	
	private $est_id;
	private $pai_id;
	private $est_nombre_es;
	private $est_nombre_en;
	
	private $pai_nombre_es;
	private $pai_nombre_en;
	
	function __construct() {}


	/**
	 * @return the $est_id
	 */
	public function getEst_id() {
		return $this->est_id;
	}

	/**
	 * @return the $pai_id
	 */
	public function getPai_id() {
		return $this->pai_id;
	}

	/**
	 * @return the $est_nombre_es
	 */
	public function getEst_nombre_es() {
		return $this->est_nombre_es;
	}

	/**
	 * @return the $est_nombre_en
	 */
	public function getEst_nombre_en() {
		return $this->est_nombre_en;
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
	 * @param Ambigous <NULL, unknown> $est_id
	 */
	public function setEst_id($est_id) {
		$this->est_id = $est_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $pai_id
	 */
	public function setPai_id($pai_id) {
		$this->pai_id = $pai_id;
	}

	/**
	 * @param field_type $est_nombre_es
	 */
	public function setEst_nombre_es($est_nombre_es) {
		$this->est_nombre_es = $est_nombre_es;
	}

	/**
	 * @param Ambigous <NULL, unknown> $est_nombre_en
	 */
	public function setEst_nombre_en($est_nombre_en) {
		$this->est_nombre_en = $est_nombre_en;
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

	public function exchangeArray($data)
	{
		$this->est_id = (isset($data['est_id'])) ? $data['est_id'] : null;
		$this->pai_id = (isset($data['pai_id'])) ? $data['pai_id'] : null;
		$this->est_nombre_es = (isset($data['est_nombre_es'])) ? $data['est_nombre_es'] : null;
		$this->est_nombre_en = (isset($data['est_nombre_en'])) ? $data['est_nombre_en'] : null;
		
		$this->pai_nombre_es = (isset($data['pai_nombre_es'])) ? $data['pai_nombre_es'] : null;
		$this->pai_nombre_en = (isset($data['pai_nombre_en'])) ? $data['pai_nombre_en'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}