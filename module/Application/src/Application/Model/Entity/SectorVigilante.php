<?php
	//SectorVigilante.php

namespace Application\Model\Entity;

class SectorVigilante
{

	private $sec_vig_id;
	private $usu_id;
	private $sec_id;

	/**
	 * @return the $sec_vig_id
	 */
	public function getSec_vig_id()
	{
		return $this->sec_vig_id;
	}

	/**
	 * @return the $usu_id
	 */
	public function getUsu_id()
	{
		return $this->usu_id;
	}

	/**
	 * @return the $sec_id    
	 */
	public function getSec_id()
	{
		return $this->sec_id;
	}


	/**
	 * @param Amigous <NULL, unknown> $sec_vig_id
	 */
	public function setSec_vig_id($sec_vig_id)
	{
		$this->sec_vig_id = $sec_vig_id;
	}

	/**
	 * @param Amigous <NULL, unknown> $usu_id
	 */
	public function setUsu_id($usu_id)
	{
		$this->usu_id = $usu_id;
	}

	/**
	 * @param Amigous <NULL, unknown> $sec_id
	 */
	public function setSec_id($sec_id)
	{
		$this->sec_id = $sec_id;
	}


	public function exchangeArray($data)
    {
		$this->sec_vig_id = (isset($data['sec_vig_id'])) ? $data['sec_vig_id'] : null;
		$this->usu_id = (isset($data['usu_id'])) ? $data['usu_id'] : null;
		$this->sec_id = (isset($data['sec_id'])) ? $data['sec_id'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}