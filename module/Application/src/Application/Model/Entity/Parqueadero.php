<?php
namespace Application\Model\Entity;

class Parqueadero {
	
	private $par_id;
	private $par_estado;
	private $par_tipo;
	private $sec_id;
	private $sec_nombre;
	private $par_latitud;
	private $par_longitud;
	private $par_cal_principal;
	private $par_cal_secundaria;

	function __construct() {}

	/**
	 * @return the $par_id
	 */
	public function getPar_id() {
		return $this->par_id;
	}

	/**
	 * @return the $par_estado
	 */
	public function getPar_estado() {
		return $this->par_estado;
	}

	/**
	 * @return the $par_estado
	 */
	public function getPar_tipo() {
		return $this->par_tipo;
	}

	/**
	 * @return the $sec_id
	 */
	public function getSec_id() {
		return $this->sec_id;
	}

	/**
	 * @return the $sec_nombre
	 */
	public function getSec_nombre() {
		return $this->sec_nombre;
	}

	/**
	 * @return the $par_latitud
	 */
	public function getPar_latitud() {
		return $this->par_latitud;
	}

	/**
	 * @return the $par_longitud
	 */
	public function getPar_longitud() {
		return $this->par_longitud;
	}

	/**
	 * @return the $par_cal_secundaria
	 */
	public function getPar_cal_secundaria(){
		return $this->par_cal_secundaria;
	} 

	/**
	 * @return the $par_cal_principal
	 */
	public function getPar_cal_principal(){
		return $this->par_cal_principal;
	} 


	/**
	 * @param Ambigous <NULL, unknown> $par_id
	 */
	public function setPar_id($par_id) {
		$this->par_id = $par_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $par_estado
	 */
	public function setPar_estado($par_estado) {
		$this->par_estado = $par_estado;
	}

	/**
	 * @param Ambigous <NULL, unknown> $par_estado
	 */
	public function setPar_tipo($par_tipo) {
		$this->par_tipo = $par_tipo;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sec_id
	 */
	public function setSec_id($sec_id) {
		$this->sec_id = $sec_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $sec_nombre
	 */
	public function setSec_nombre($sec_nombre) {
		$this->sec_nombre = $sec_nombre;
	}

	/**
	 * @param Ambiguos <NULL, unknown> $par_cal_secundaria
	 */
	public function setPar_cal_secundaria($par_cal_secundaria){
		$this->par_cal_secundaria = $par_cal_secundaria;
	}  
	/**
	 * @param Ambiguos <NULL, unknown> $par_cal_principal
	 */
	public function setPar_cal_principal($par_cal_principal){
		$this->par_cal_principal = $par_cal_principal;
	}  


	public function exchangeArray($data)
	{
		$this->par_id = (isset($data['par_id'])) ? $data['par_id'] : null;
		$this->par_estado = (isset($data['par_estado'])) ? $data['par_estado'] : null;
		$this->par_tipo = (isset($data['par_tipo'])) ? $data['par_tipo'] : null;
		$this->sec_id = (isset($data['sec_id'])) ? $data['sec_id'] : null;
		$this->sec_nombre = (isset($data['sec_nombre'])) ? $data['sec_nombre'] : null;

		$this->aut_placa = (isset($data['aut_placa'])) ? $data['aut_placa'] : null;
		$this->par_fecha_ingreso = (isset($data['par_fecha_ingreso'])) ? $data['par_fecha_ingreso'] : null;
		$this->par_horas_parqueo = (isset($data['par_horas_parqueo'])) ? $data['par_horas_parqueo'] : null;

		$this->par_latitud = (isset($data['par_latitud'])) ? $data['par_latitud'] : null;
		$this->par_longitud = (isset($data['par_longitud'])) ? $data['par_longitud'] : null;
		$this->par_cal_secundaria = (isset($data['par_cal_secundaria'])) ? $data['par_cal_secundaria'] : null;
		$this->par_cal_principal = (isset($data['par_cal_principal'])) ? $data['par_cal_principal'] : null;		
		
		$this->inf_id = (isset($data['inf_id'])) ? $data['inf_id'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}	
}