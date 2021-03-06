<?php
namespace Application\Model\Entity;

class Usuario {
	
	private $usu_id;
	private $ciu_id;
	private $usu_usuario;
	private $usu_email;
	private $usu_nombre;
	private $usu_apellido;
	private $usu_clave;
	private $usu_estado;
	private $usu_fecha_registro;
	private $usu_documento;

    private $usu_codigo_recuperacion;

	private $ciu_nombre_es;
	private $ciu_nombre_en;
	
	function __construct() {}

	/**
     * @return the $usu_id
     */
    public function getUsu_id()
    {
        return $this->usu_id;
    }

	/**
     * @return the $ciu_id
     */
    public function getCiu_id()
    {
        return $this->ciu_id;
    }

    /**
     * @return the $usu_documento
     */
    public function getUsu_documento()
    {
        return $this->usu_documento;
    }

	/**
     * @return the $usu_usuario
     */
    public function getUsu_usuario()
    {
        return $this->usu_usuario;
    }

	/**
     * @return the $usu_email
     */
    public function getUsu_email()
    {
        return $this->usu_email;
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
     * @return the $usu_clave
     */
    public function getUsu_clave()
    {
        return $this->usu_clave;
    }

	/**
     * @return the $usu_estado
     */
    public function getUsu_estado()
    {
        return $this->usu_estado;
    }

	/**
     * @return the $usu_fecha_registro
     */
    public function getUsu_fecha_registro()
    {
        return $this->usu_fecha_registro;
    }

	/**
     * @return the $ciu_nombre_es
     */
    public function getCiu_nombre_es()
    {
        return $this->ciu_nombre_es;
    }

	/**
     * @return the $ciu_nombre_en
     */
    public function getCiu_nombre_en()
    {
        return $this->ciu_nombre_en;
    }

    /**
     * @return the $usu_id
     */
    public function getUsu_codigo_recuperacion()
    {
        return $this->usu_codigo_recuperacion;
    }    

	/**
     * @param Ambigous <NULL, unknown> $usu_id
     */
    public function setUsu_id($usu_id)
    {
        $this->usu_id = $usu_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $ciu_id
     */
    public function setCiu_id($ciu_id)
    {
        $this->ciu_id = $ciu_id;
    }

    /**
     * @param Ambigous <NULL, unknown> $usu_documento
     */
    public function setUsu_documento($usu_documento)
    {
        $this->usu_documento = $usu_documento;
    }

	/**
     * @param Ambigous <NULL, unknown> $usu_usuario
     */
    public function setUsu_usuario($usu_usuario)
    {
        $this->usu_usuario = $usu_usuario;
    }

	/**
     * @param Ambigous <NULL, unknown> $usu_email
     */
    public function setUsu_email($usu_email)
    {
        $this->usu_email = $usu_email;
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
     * @param Ambigous <NULL, unknown> $usu_clave
     */
    public function setUsu_clave($usu_clave)
    {
        $this->usu_clave = $usu_clave;
    }

	/**
     * @param Ambigous <NULL, unknown> $usu_estado
     */
    public function setUsu_estado($usu_estado)
    {
        $this->usu_estado = $usu_estado;
    }

	/**
     * @param Ambigous <NULL, unknown> $usu_fecha_registro
     */
    public function setUsu_fecha_registro($usu_fecha_registro)
    {
        $this->usu_fecha_registro = $usu_fecha_registro;
    }

	/**
     * @param Ambigous <NULL, unknown> $ciu_nombre_es
     */
    public function setCiu_nombre_es($ciu_nombre_es)
    {
        $this->ciu_nombre_es = $ciu_nombre_es;
    }

	/**
     * @param Ambigous <NULL, unknown> $ciu_nombre_en
     */
    public function setCiu_nombre_en($ciu_nombre_en)
    {
        $this->ciu_nombre_en = $ciu_nombre_en;
    }

    /**
     * @param Ambigous <NULL, unknown> $usu_codigo_recuperacion
     */
    public function setUsu_codigo_recuperacion($usu_codigo_recuperacion)
    {
        $this->usu_codigo_recuperacion = $usu_codigo_recuperacion;
    }

	public function exchangeArray($data) {
		$this->usu_id = (isset ( $data ['usu_id'] )) ? $data ['usu_id'] : null;
		$this->ciu_id = (isset ( $data ['ciu_id'] )) ? $data ['ciu_id'] : null;
        $this->usu_documento = (isset ( $data ['usu_documento'] )) ? $data ['usu_documento'] : null;
		$this->usu_usuario = (isset ( $data ['usu_usuario'] )) ? $data ['usu_usuario'] : null;
		$this->usu_email = (isset ( $data ['usu_email'] )) ? $data ['usu_email'] : null;
		$this->usu_nombre = (isset ( $data ['usu_nombre'] )) ? $data ['usu_nombre'] : null;
		$this->usu_apellido = (isset ( $data ['usu_apellido'] )) ? $data ['usu_apellido'] : null;
		$this->usu_clave = (isset ( $data ['usu_clave'] )) ? $data ['usu_clave'] : null;
		$this->usu_estado = (isset ( $data ['usu_estado'] )) ? $data ['usu_estado'] : null;
		$this->usu_fecha_registro = (isset ( $data ['usu_fecha_registro'] )) ? $data ['usu_fecha_registro'] : null;
        $this->usu_codigo_recuperacion = (isset ( $data ['usu_codigo_recuperacion'] )) ? $data ['usu_codigo_recuperacion'] : null;
		
		$this->ciu_nombre_es = (isset ( $data ['ciu_nombre_es'] )) ? $data ['ciu_nombre_es'] : null;
		$this->ciu_nombre_en = (isset ( $data ['ciu_nombre_en'] )) ? $data ['ciu_nombre_en'] : null;
	}
	public function getArrayCopy() {
		return get_object_vars ( $this );
	}
	
}