<?php
// Cliente.php
namespace Application\Model\Entity;

class Cliente
{

    private $cli_id;

    private $usu_id;

    private $cli_saldo;

    private $cli_foto;
    
    private $cli_cod_pais;
    
    private $cli_cod_ciudad;
    
    private $cli_direccion;
    
    private $cli_movil;
    
    private $usu_usuario;
    
    private $usu_email;
    
    private $usu_nombre;
    
    private $usu_apellido;
    
    private $usu_clave;
    
    private $usu_estado;
    
    private $usu_fecha_registro;

    function __construct(){}

	/**
     * @return the $cli_id
     */
    public function getCli_id()
    {
        return $this->cli_id;
    }

	/**
     * @return the $usu_id
     */
    public function getUsu_id()
    {
        return $this->usu_id;
    }

	/**
     * @return the $cli_saldo
     */
    public function getCli_saldo()
    {
        return $this->cli_saldo;
    }

	/**
     * @return the $cli_foto
     */
    public function getCli_foto()
    {
        return $this->cli_foto;
    }

	/**
     * @return the $cli_cod_pais
     */
    public function getCli_cod_pais()
    {
        return $this->cli_cod_pais;
    }

	/**
     * @return the $cli_cod_ciudad
     */
    public function getCli_cod_ciudad()
    {
        return $this->cli_cod_ciudad;
    }

	/**
     * @return the $cli_direccion
     */
    public function getCli_direccion()
    {
        return $this->cli_direccion;
    }

	/**
     * @return the $cli_movil
     */
    public function getCli_movil()
    {
        return $this->cli_movil;
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
     * @param Ambigous <NULL, unknown> $cli_id
     */
    public function setCli_id($cli_id)
    {
        $this->cli_id = $cli_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $usu_id
     */
    public function setUsu_id($usu_id)
    {
        $this->usu_id = $usu_id;
    }

	/**
     * @param Ambigous <NULL, unknown> $cli_saldo
     */
    public function setCli_saldo($cli_saldo)
    {
        $this->cli_saldo = $cli_saldo;
    }

	/**
     * @param Ambigous <NULL, unknown> $cli_foto
     */
    public function setCli_foto($cli_foto)
    {
        $this->cli_foto = $cli_foto;
    }

	/**
     * @param Ambigous <NULL, unknown> $cli_cod_pais
     */
    public function setCli_cod_pais($cli_cod_pais)
    {
        $this->cli_cod_pais = $cli_cod_pais;
    }

	/**
     * @param Ambigous <NULL, unknown> $cli_cod_ciudad
     */
    public function setCli_cod_ciudad($cli_cod_ciudad)
    {
        $this->cli_cod_ciudad = $cli_cod_ciudad;
    }

	/**
     * @param Ambigous <NULL, unknown> $cli_direccion
     */
    public function setCli_direccion($cli_direccion)
    {
        $this->cli_direccion = $cli_direccion;
    }

	/**
     * @param Ambigous <NULL, unknown> $cli_movil
     */
    public function setCli_movil($cli_movil)
    {
        $this->cli_movil = $cli_movil;
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

	public function exchangeArray($data)
    {
        $this->cli_id = (isset($data['cli_id'])) ? $data['cli_id'] : null;
        $this->usu_id = (isset($data['usu_id'])) ? $data['usu_id'] : null;
        $this->cli_saldo = (isset($data['cli_saldo'])) ? $data['cli_saldo'] : null;
        $this->cli_foto = (isset($data['cli_foto'])) ? $data['cli_foto'] : null;
        $this->cli_cod_pais = (isset($data['cli_cod_pais'])) ? $data['cli_cod_pais'] : null;
        $this->cli_cod_ciudad = (isset($data['cli_cod_ciudad'])) ? $data['cli_cod_ciudad'] : null;
        $this->cli_direccion = (isset($data['cli_direccion'])) ? $data['cli_direccion'] : null;
        $this->cli_movil = (isset($data['cli_movil'])) ? $data['cli_movil'] : null;
        
        $this->usu_usuario = (isset($data['usu_usuario'])) ? $data['usu_usuario'] : null;
        $this->usu_email = (isset($data['usu_email'])) ? $data['usu_email'] : null;
        $this->usu_nombre = (isset($data['usu_nombre'])) ? $data['usu_nombre'] : null;
        $this->usu_apellido = (isset($data['usu_apellido'])) ? $data['usu_apellido'] : null;
        $this->usu_clave = (isset($data['usu_clave'])) ? $data['usu_clave'] : null;
        $this->usu_estado = (isset($data['usu_estado'])) ? $data['usu_estado'] : null;
        $this->usu_fecha_registro = (isset($data['usu_fecha_registro'])) ? $data['usu_fecha_registro'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}