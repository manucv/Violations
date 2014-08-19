<?php 
/*Autmovil.php*/
namespace Application\Model\Entity;

class Automovil {
	
	private $aut_placa;
	
	function __construct() {}

	/**
	 * @return the $ciu_id
	 */
	public function getAut_placa() {
		return $this->aut_placa;
	}

	/**
	 * @param Ambigous <NULL, unknown> $ciu_id
	 */
	public function setAut_placa($aut_placa) {
		$this->aut_placa = $aut_placa;
	}

	public function exchangeArray($data)
	{
		$this->aut_placa = (isset($data['aut_placa'])) ? $data['aut_placa'] : null;

	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}