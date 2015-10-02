<?php
namespace Application\Model\Entity;

class MultaParqueadero {
	
	private $mul_par_id;
	private $par_id;
	private $aut_placa;
	private $inf_id;
	private $mul_par_estado;
	private $mul_par_valor;
	private $mul_par_imagen;
	private $mul_par_prueba_1;
	private $mul_par_prueba_2;
	private $mul_par_prueba_3;
	
	function __construct() {}

	/**
	 * @return the $mul_par_id
	 */
	public function getMul_par_id() {
		return $this->mul_par_id;
	}

	/**
	 * @return the $par_id
	 */
	public function getPar_id() {
		return $this->par_id;
	}

	/**
	 * @return the $aut_placa
	 */
	public function getAut_placa() {
		return $this->aut_placa;
	}

	/**
	 * @return the $inf_id
	 */
	public function getInf_id() {
		return $this->inf_id;
	}

	/**
	 * @return the $mul_par_estado
	 */
	public function getMul_par_estado() {
		return $this->mul_par_estado;
	}

	/**
	 * @return the $mul_par_valor
	 */
	public function getMul_par_valor() {
		return $this->mul_par_valor;
	}

	/**
	 * @return the $mul_par_imagen
	 */
	public function getMul_par_imagen() {
		return $this->mul_par_imagen;
	}

	/**
	 * @return the $mul_par_prueba_1
	 */
	public function getMul_par_prueba_1() {
		return $this->mul_par_prueba_1;
	}

	/**
	 * @return the $mul_par_prueba_2
	 */
	public function getMul_par_prueba_2() {
		return $this->mul_par_prueba_2;
	}

	/**
	 * @return the $mul_par_prueba_3
	 */
	public function getMul_par_prueba_3() {
		return $this->mul_par_prueba_3;
	}



	/**
	 * @param Ambigous <NULL, unknown> $mul_par_id
	 */
	public function setMul_par_id($mul_par_id) {
		$this->mul_par_id = $mul_par_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $par_id
	 */
	public function setPar_id($par_id) {
		$this->par_id = $par_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $aut_placa
	 */
	public function setAut_placa($aut_placa) {
		$this->aut_placa = $aut_placa;
	}

	/**
	 * @param Ambigous <NULL, unknown> $inf_id
	 */
	public function setInf_id($inf_id) {
		$this->inf_id = $inf_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $mul_par_estado
	 */
	public function setMul_par_estado($mul_par_estado) {
		$this->mul_par_estado = $mul_par_estado;
	}

	/**
	 * @param Ambigous <NULL, unknown> $mul_par_valor
	 */
	public function setMul_par_valor($mul_par_valor) {
		$this->mul_par_valor = $mul_par_valor;
	}

	/**
	 * @param Ambigous <NULL, unknown> $mul_par_imagen
	 */
	public function setMul_par_imagen($mul_par_imagen) {
		$this->mul_par_imagen = $mul_par_imagen;
	}

	/**
	 * @param Ambigous <NULL, unknown> $mul_par_prueba_1
	 */
	public function setMul_par_prueba_1($mul_par_prueba_1) {
		$this->mul_par_prueba_1 = $mul_par_prueba_1;
	}

	/**
	 * @param Ambigous <NULL, unknown> $mul_par_prueba_2
	 */
	public function setMul_par_prueba_2($mul_par_prueba_2) {
		$this->mul_par_prueba_2 = $mul_par_prueba_2;
	}

	/**
	 * @param Ambigous <NULL, unknown> $mul_par_prueba_3
	 */
	public function setMul_par_prueba_3($mul_par_prueba_3) {
		$this->mul_par_prueba_3 = $mul_par_prueba_3;
	}

	public function exchangeArray($data)
	{
		$this->mul_par_id = (isset($data['mul_par_id'])) ? $data['mul_par_id'] : null;
		$this->par_id = (isset($data['par_id'])) ? $data['par_id'] : null;
		$this->aut_placa = (isset($data['aut_placa'])) ? $data['aut_placa'] : null;
		$this->inf_id = (isset($data['inf_id'])) ? $data['inf_id'] : null;
		$this->mul_par_estado = (isset($data['mul_par_estado'])) ? $data['mul_par_estado'] : null;
		$this->mul_par_valor = (isset($data['mul_par_valor'])) ? $data['mul_par_valor'] : null;
		$this->mul_par_imagen = (isset($data['mul_par_imagen'])) ? $data['mul_par_imagen'] : null;
		$this->mul_par_prueba_1 = (isset($data['mul_par_prueba_1'])) ? $data['mul_par_prueba_1'] : null;
		$this->mul_par_prueba_2 = (isset($data['mul_par_prueba_2'])) ? $data['mul_par_prueba_2'] : null;
		$this->mul_par_prueba_3 = (isset($data['mul_par_prueba_3'])) ? $data['mul_par_prueba_3'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}