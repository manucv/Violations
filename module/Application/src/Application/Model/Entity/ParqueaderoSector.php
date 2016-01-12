<?php
	//ParqueaderoSector.php

namespace Application\Model\Entity;

class ParqueaderoSector
{
	private $sec_id;
	private $par_id;

	function __construct() {}

	/**
	 * @return the $sec_id
	 */
	public function getSec_id() {
		return $this->sec_id;
	}

	/**
	 * @return the $par_id
	 */
	public function getPar_id() {
		return $this->par_id;
	}



	/**
	 * @param Ambigous <NULL, unknown> $sec_id
	 */
	public function setSec_id($sec_id) {
		$this->sec_id = $sec_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $par_id
	 */
	public function setPar_id($par_id) {
		$this->par_id = $par_id;
	}


	public function exchangeArray($data)
	{
		$this->sec_id = (isset($data['sec_id'])) ? $data['sec_id'] : null;
		$this->par_id = (isset($data['par_id'])) ? $data['par_id'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}	

}