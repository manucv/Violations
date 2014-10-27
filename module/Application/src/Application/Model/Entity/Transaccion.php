<?php
	//Transaccion.php

namespace Application\Model\Entity;

class Transaccion
{
	private $tra_id;
	private $eta_id;
	private $cli_id;
	private $tra_valor;
	private $tra_saldo;
	private $tra_fecha;
	private $ciu_nombre_es;
	private $sec_nombre;
	private $log_par_horas_parqueo;
	private $sec_valor_hora;
	private $par_id;
	private $usu_nombre;
	private $usu_apellido;
	private $aut_placa;
	
	
	public function __construct(){}


	/**
     * @return the $tra_id
     */
    public function getTra_id()
    {
        return $this->tra_id;
    }

	/**
     * @return the $eta_id
     */
    public function getEta_id()
    {
        return $this->eta_id;
    }

	/**
     * @return the $cli_id
     */
    public function getCli_id()
    {
        return $this->cli_id;
    }

	/**
     * @return the $tra_valor
     */
    public function getTra_valor()
    {
        return $this->tra_valor;
    }

	/**
     * @return the $tra_saldo
     */
    public function getTra_saldo()
    {
        return $this->tra_saldo;
    }

	/**
     * @return the $tra_fecha
     */
    public function getTra_fecha()
    {
        return $this->tra_fecha;
    }

	/**
     * @return the $ciu_nombre_es
     */
    public function getCiu_nombre_es()
    {
        return $this->ciu_nombre_es;
    }

	/**
     * @return the $sec_nombre
     */
    public function getSec_nombre()
    {
        return $this->sec_nombre;
    }

	/**
     * @return the $log_par_horas_parqueo
     */
    public function getLog_par_horas_parqueo()
    {
        return $this->log_par_horas_parqueo;
    }

	/**
     * @return the $sec_valor_hora
     */
    public function getSec_valor_hora()
    {
        return $this->sec_valor_hora;
    }

	/**
     * @return the $par_id
     */
    public function getPar_id()
    {
        return $this->par_id;
    }

	/**
     * @return the $usu_nombre
     */
    public function getUsu_nombre()
    {
        return $this->usu_nombre;
    }

	/**
     * @return the $usu_apellido
     */
    public function getUsu_apellido()
    {
        return $this->usu_apellido;
    }

	/**
     * @return the $aut_placa
     */
    public function getAut_placa()
    {
        return $this->aut_placa;
    }

	/**
     * @param Ambigous <NULL, unknown> $tra_id
     */
    public function setTra_id($tra_id)
    {
        $this->tra_id = $tra_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $eta_id
     */
    public function setEta_id($eta_id)
    {
        $this->eta_id = $eta_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $cli_id
     */
    public function setCli_id($cli_id)
    {
        $this->cli_id = $cli_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $tra_valor
     */
    public function setTra_valor($tra_valor)
    {
        $this->tra_valor = $tra_valor;
    }

	/**
     * @param Ambigous <NULL, unknown> $tra_saldo
     */
    public function setTra_saldo($tra_saldo)
    {
        $this->tra_saldo = $tra_saldo;
    }

	/**
     * @param Ambigous <NULL, unknown> $tra_fecha
     */
    public function setTra_fecha($tra_fecha)
    {
        $this->tra_fecha = $tra_fecha;
    }

	/**
     * @param Ambigous <NULL, unknown> $ciu_nombre_es
     */
    public function setCiu_nombre_es($ciu_nombre_es)
    {
        $this->ciu_nombre_es = $ciu_nombre_es;
    }

	/**
     * @param Ambigous <NULL, unknown> $sec_nombre
     */
    public function setSec_nombre($sec_nombre)
    {
        $this->sec_nombre = $sec_nombre;
    }

	/**
     * @param Ambigous <NULL, unknown> $log_par_horas_parqueo
     */
    public function setLog_par_horas_parqueo($log_par_horas_parqueo)
    {
        $this->log_par_horas_parqueo = $log_par_horas_parqueo;
    }

	/**
     * @param Ambigous <NULL, unknown> $sec_valor_hora
     */
    public function setSec_valor_hora($sec_valor_hora)
    {
        $this->sec_valor_hora = $sec_valor_hora;
    }

	/**
     * @param Ambigous <NULL, unknown> $par_id
     */
    public function setPar_id($par_id)
    {
        $this->par_id = $par_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $usu_nombre
     */
    public function setUsu_nombre($usu_nombre)
    {
        $this->usu_nombre = $usu_nombre;
    }

	/**
     * @param Ambigous <NULL, unknown> $usu_apellido
     */
    public function setUsu_apellido($usu_apellido)
    {
        $this->usu_apellido = $usu_apellido;
    }

	/**
     * @param Ambigous <NULL, unknown> $aut_placa
     */
    public function setAut_placa($aut_placa)
    {
        $this->aut_placa = $aut_placa;
    }

	public function exchangeArray($data)
	{
		$this->tra_id = (isset($data['tra_id'])) ? $data['tra_id'] : null;
		$this->eta_id = (isset($data['eta_id'])) ? $data['eta_id'] : null;
		$this->cli_id = (isset($data['cli_id'])) ? $data['cli_id'] : null;
		$this->tra_valor = (isset($data['tra_valor'])) ? $data['tra_valor'] : null;
		$this->tra_saldo = (isset($data['tra_saldo'])) ? $data['tra_saldo'] : null;
		$this->tra_fecha = (isset($data['tra_fecha'])) ? $data['tra_fecha'] : null;		
		
		$this->ciu_nombre_es = (isset($data['ciu_nombre_es'])) ? $data['ciu_nombre_es'] : null;
		$this->sec_nombre = (isset($data['sec_nombre'])) ? $data['sec_nombre'] : null;
		$this->log_par_horas_parqueo = (isset($data['log_par_horas_parqueo'])) ? $data['log_par_horas_parqueo'] : null;
		$this->sec_valor_hora = (isset($data['sec_valor_hora'])) ? $data['sec_valor_hora'] : null;
		$this->par_id = (isset($data['par_id'])) ? $data['par_id'] : null;
		$this->usu_nombre = (isset($data['usu_nombre'])) ? $data['usu_nombre'] : null;
		$this->usu_apellido = (isset($data['usu_apellido'])) ? $data['usu_apellido'] : null;
		$this->aut_placa = (isset($data['aut_placa'])) ? $data['aut_placa'] : null;
	}
		
	public function getArrayCopy(){
		return get_object_vars($this);
	}		
}