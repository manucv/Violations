<?php
namespace Application\Model\Entity;

class Infraccion {
	
	private $inf_id;
	private $inf_fecha;
	private $inf_detalles;
	private $usu_id;
	private $tip_inf_id;
    private $tip_inf_codigo;
	private $sec_id;
    private $inf_latitud;
    private $inf_longitud;    
	
	private $usu_nombre;
	private $usu_apellido;
	private $tip_inf_descripcion;
	private $sec_nombre;
	private $ciu_nombre_es;
	private $est_nombre_es;
	private $pai_nombre_es;

    private $par_id;
    private $aut_placa;
    private $inf_estado;

	
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
     * @return the $tip_inf_codigo
     */
    public function getTip_inf_codigo()
    {
        return $this->tip_inf_codigo;
    }

	/**
     * @return the $sec_id
     */
    public function getSec_id()
    {
        return $this->sec_id;
    }

    /**
     * @return the $inf_latitud
     */
    public function getInf_latitud()
    {
        return $this->inf_latitud;
    }

    /**
     * @return the $inf_latitud
     */
    public function getInf_longitud()
    {
        return $this->inf_longitud;
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
     * @return the $par_id
     */
    public function getPar_id()
    {
        return $this->par_id;
    }

    /**
     * @return the $aut_placa
     */
    public function getAut_placa()
    {
        return $this->aut_placa;
    }

    /**
     * @return the $inf_estado
     */
    public function getInf_estado()
    {
        return $this->inf_estado;
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
     * @param Ambigous <NULL, unknown> $tip_inf_id
     */
    public function setTip_inf_codigo($tip_inf_codigo)
    {
        $this->tip_inf_codigo = $tip_inf_codigo;
    }

	/**
     * @param Ambigous <NULL, unknown> $sec_id
     */
    public function setSec_id($sec_id)
    {
        $this->sec_id = $sec_id;
    }

    /**
     * @param Ambigous <NULL, unknown> $inf_latitud
     */
    public function setInf_latitud($inf_latitud)
    {
        $this->inf_latitud = $inf_latitud;
    }

    /**
     * @param Ambigous <NULL, unknown> $inf_longitud
     */
    public function setInf_longitud($inf_longitud)
    {
        $this->inf_longitud = $inf_longitud;
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

    /**
     * @param Ambigous <NULL, unknown> $par_id
     */
    public function setPar_id($par_id)
    {
        $this->par_id = $par_id;
    }

    /**
     * @param Ambigous <NULL, unknown> $aut_placa
     */
    public function setAut_placa($aut_placa)
    {
        $this->aut_placa = $aut_placa;
    }

    /**
     * @param Ambigous <NULL, unknown> $inf_estado
     */
    public function setInf_estado($inf_estado)
    {
        $this->inf_estado = $inf_estado;
    }

	public function exchangeArray($data)
	{
		$this->inf_id = (isset($data['inf_id'])) ? $data['inf_id'] : null;
		$this->inf_fecha = (isset($data['inf_fecha'])) ? $data['inf_fecha'] : null;
		$this->inf_detalles = (isset($data['inf_detalles'])) ? $data['inf_detalles'] : null;
		$this->usu_id = (isset($data['usu_id'])) ? $data['usu_id'] : null;

		$this->tip_inf_id = (isset($data['tip_inf_id'])) ? $data['tip_inf_id'] : null;
		$this->tip_inf_codigo = (isset($data['tip_inf_codigo'])) ? $data['tip_inf_codigo'] : null;

        $this->sec_id = (isset($data['sec_id'])) ? $data['sec_id'] : null;
        $this->inf_latitud = (isset($data['inf_latitud'])) ? $data['inf_latitud'] : null;
        $this->inf_longitud = (isset($data['inf_longitud'])) ? $data['inf_longitud'] : null;

		$this->usu_nombre = (isset($data['usu_nombre'])) ? $data['usu_nombre'] : null;
		$this->usu_apellido = (isset($data['usu_apellido'])) ? $data['usu_apellido'] : null;
		$this->tip_inf_descripcion = (isset($data['tip_inf_descripcion'])) ? $data['tip_inf_descripcion'] : null;
		$this->sec_nombre = (isset($data['sec_nombre'])) ? $data['sec_nombre'] : null;
		$this->ciu_nombre_es = (isset($data['ciu_nombre_es'])) ? $data['ciu_nombre_es'] : null;
		$this->est_nombre_es = (isset($data['est_nombre_es'])) ? $data['est_nombre_es'] : null;
		$this->pai_nombre_es = (isset($data['pai_nombre_es'])) ? $data['pai_nombre_es'] : null;

        $this->par_id = (isset($data['par_id'])) ? $data['par_id'] : null;
        $this->aut_placa = (isset($data['aut_placa'])) ? $data['aut_placa'] : null;
        $this->inf_estado = (isset($data['inf_estado'])) ? $data['inf_estado'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}