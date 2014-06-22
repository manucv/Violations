<?php

namespace Application\Model\Entity;

 class RolAplicacion
 {
    private $rol_id;
    private $apl_id;

    public function __construct(){}

     /**
	 * @return the $rol_id
	 */
	public function getRol_id() {
		return $this->rol_id;
	}

	/**
	 * @return the $apl_id
	 */
	public function getApl_id() {
		return $this->apl_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $rol_id
	 */
	public function setRol_id($rol_id) {
		$this->rol_id = $rol_id;
	}

	/**
	 * @param Ambigous <NULL, unknown> $apl_id
	 */
	public function setApl_id($apl_id) {
		$this->apl_id = $apl_id;
	}

	public function exchangeArray($data)
     {
        $this->rol_id  = (!empty($data['rol_id'])) ? $data['rol_id'] : null;
        $this->apl_id  = (!empty($data['apl_id'])) ? $data['apl_id'] : null;
     }
     
     public function getArrayCopy() {
     	return get_object_vars ( $this );
     }
 }