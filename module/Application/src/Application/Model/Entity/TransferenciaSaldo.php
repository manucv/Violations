<?php
	//TransferenciaSaldo.php
namespace Application\Model\Entity;

class TransferenciaSaldo
{
	
	private $tra_sal_id;
	private $cli_id_de;
	private $cli_id_para;
	private $tra_sal_valor;
	private $tra_sal_hora;
		
	/**
	* @return the $tra_sal_id
	*/
	public function getTra_sal_id(){
		return $this->tra_sal_id;
	}

	/**
	* @return the $cli_id_de
	*/
	public function getCli_id_de(){
		return $this->cli_id_de;
	}

	/**
	* @return the $cli_id_para
	*/
	public function getCli_id_para(){
		return $this->cli_id_para;
	}

	/**
	* @return the $tra_sal_valor
	*/
	public function getTra_sal_valor(){
		return $this->tra_sal_valor;
	}

	/**
	* @return the $tra_sal_hora
	*/
	public function getTra_sal_hora(){
		return $this->tra_sal_hora;
	}

	/**
	* @param Ambigous <Null, unknown> $tra_sal_id
	*/
	public function setTra_sal_id($tra_sal_id){
		$this->tra_sal_id=$tra_sal_id;
	}

	/**
	* @param Ambigous <Null, unknown> $cli_id_de
	*/
	public function setCli_id_de($cli_id_de){
		$this->cli_id_de=$cli_id_de;
	}

	/**
	* @param Ambigous <Null, unknown> $cli_id_para
	*/
	public function setCli_id_para($cli_id_para){
		$this->cli_id_para=$cli_id_para;
	}

	/**
	* @param Ambigous <Null, unknown> $tra_sal_valor
	*/
	public function setTra_sal_valor($tra_sal_valor){
		$this->tra_sal_valor=$tra_sal_valor;
	}

	/**
	* @param Ambigous <Null, unknown> $tra_sal_hora	
	*/
	public function setTra_sal_hora($tra_sal_hora){
		$this->tra_sal_hora=$tra_sal_hora;
	}

	public function exchangeArray($data)
	{
		$this->tra_sal_id = (isset($data['tra_sal_id'])) ? $data['tra_sal_id'] : null;
		$this->cli_id_de = (isset($data['cli_id_de'])) ? $data['cli_id_de'] : null;
		$this->cli_id_para = (isset($data['cli_id_para'])) ? $data['cli_id_para'] : null;
		$this->tra_sal_valor = (isset($data['tra_sal_valor'])) ? $data['tra_sal_valor'] : null;
		$this->tra_sal_hora = (isset($data['tra_sal_hora'])) ? $data['tra_sal_hora'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}

}
