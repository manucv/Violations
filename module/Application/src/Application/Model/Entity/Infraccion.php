<?php
namespace Application\Model\Entity;

class Infraccion {
	
	private $inf_id;
	private $inf_fecha;
	private $inf_detalles;
	private $usu_id;
	private $tip_inf_id;
	private $sec_id;
	
	private $usu_nombre;
	private $usu_apellido;
	private $tip_inf_descripcion;
	private $sec_nombre;
	private $ciu_nombre_es;
	private $est_nombre_es;
	private $pai_nombre_es;
	
	function __construct() {}

	/**
     * @return the $inf_id
     */
    public function getInf_id()
    {
        return $this->inf_id;
    }

	/**
     * @return the $inf_fecha
     */
    public function getInf_fecha()
    {
        return $this->inf_fecha;
    }

	/**
     * @return the $inf_detalles
     */
    public function getInf_detalles()
    {
        return $this->inf_detalles;
    }

	/**
     * @return the $usu_id
     */
    public function getUsu_id()
    {
        return $this->usu_id;
    }

	/**
     * @return the $tip_inf_id
     */
    public function getTip_inf_id()
    {
        return $this->tip_inf_id;
    }

	/**
     * @return the $sec_id
     */
    public function getSec_id()
    {
        return $this->sec_id;
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
     * @return the $tip_inf_descripcion
     */
    public function getTip_inf_descripcion()
    {
        return $this->tip_inf_descripcion;
    }

	/**
     * @return the $sec_nombre
     */
    public function getSec_nombre()
    {
        return $this->sec_nombre;
    }

	/**
     * @return the $ciu_nombre_es
     */
    public function getCiu_nombre_es()
    {
        return $this->ciu_nombre_es;
    }

	/**
     * @return the $est_nombre_es
     */
    public function getEst_nombre_es()
    {
        return $this->est_nombre_es;
    }

	/**
     * @return the $pai_nombre_es
     */
    public function getPai_nombre_es()
    {
        return $this->pai_nombre_es;
    }

	/**
     * @param Ambigous <NULL, unknown> $inf_id
     */
    public function setInf_id($inf_id)
    {
        $this->inf_id = $inf_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $inf_fecha
     */
    public function setInf_fecha($inf_fecha)
    {
        $this->inf_fecha = $inf_fecha;
    }

	/**
     * @param Ambigous <NULL, unknown> $inf_detalles
     */
    public function setInf_detalles($inf_detalles)
    {
        $this->inf_detalles = $inf_detalles;
    }

	/**
     * @param Ambigous <NULL, unknown> $usu_id
     */
    public function setUsu_id($usu_id)
    {
        $this->usu_id = $usu_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $tip_inf_id
     */
    public function setTip_inf_id($tip_inf_id)
    {
        $this->tip_inf_id = $tip_inf_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $sec_id
     */
    public function setSec_id($sec_id)
    {
        $this->sec_id = $sec_id;
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
     * @param Ambigous <NULL, unknown> $tip_inf_descripcion
     */
    public function setTip_inf_descripcion($tip_inf_descripcion)
    {
        $this->tip_inf_descripcion = $tip_inf_descripcion;
    }

	/**
     * @param Ambigous <NULL, unknown> $sec_nombre
     */
    public function setSec_nombre($sec_nombre)
    {
        $this->sec_nombre = $sec_nombre;
    }

	/**
     * @param Ambigous <NULL, unknown> $ciu_nombre_es
     */
    public function setCiu_nombre_es($ciu_nombre_es)
    {
        $this->ciu_nombre_es = $ciu_nombre_es;
    }

	/**
     * @param Ambigous <NULL, unknown> $est_nombre_es
     */
    public function setEst_nombre_es($est_nombre_es)
    {
        $this->est_nombre_es = $est_nombre_es;
    }

	/**
     * @param Ambigous <NULL, unknown> $pai_nombre_es
     */
    public function setPai_nombre_es($pai_nombre_es)
    {
        $this->pai_nombre_es = $pai_nombre_es;
    }

	public function exchangeArray($data)
	{
		$this->inf_id = (isset($data['inf_id'])) ? $data['inf_id'] : null;
		$this->inf_fecha = (isset($data['inf_fecha'])) ? $data['inf_fecha'] : null;
		$this->inf_detalles = (isset($data['inf_detalles'])) ? $data['inf_detalles'] : null;
		$this->usu_id = (isset($data['usu_id'])) ? $data['usu_id'] : null;
		$this->tip_inf_id = (isset($data['tip_inf_id'])) ? $data['tip_inf_id'] : null;
		$this->sec_id = (isset($data['sec_id'])) ? $data['sec_id'] : null;
		
		$this->usu_nombre = (isset($data['usu_nombre'])) ? $data['usu_nombre'] : null;
		$this->usu_apellido = (isset($data['usu_apellido'])) ? $data['usu_apellido'] : null;
		$this->tip_inf_descripcion = (isset($data['tip_inf_descripcion'])) ? $data['tip_inf_descripcion'] : null;
		$this->sec_nombre = (isset($data['sec_nombre'])) ? $data['sec_nombre'] : null;
		$this->ciu_nombre_es = (isset($data['ciu_nombre_es'])) ? $data['ciu_nombre_es'] : null;
		$this->est_nombre_es = (isset($data['est_nombre_es'])) ? $data['est_nombre_es'] : null;
		$this->pai_nombre_es = (isset($data['pai_nombre_es'])) ? $data['pai_nombre_es'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}