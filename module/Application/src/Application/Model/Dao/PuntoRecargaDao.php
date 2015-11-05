<?php
	//PuntoRecargaDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\PuntoRecarga;
use Application\Model\Dao\InterfaceCrud;

class PuntoRecargaDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($pun_rec_id){
    	 
    	$pun_rec_id = (int) $pun_rec_id;
    	 
    	$resultSet = $this->tableGateway->select(array('pun_rec_id' => $pun_rec_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del establecimiento');
    	}
    	
    	return $row;
    }

    public function guardar(PuntoRecarga $punto_recarga){
    
    	$id = (int) $punto_recarga->getPun_rec_id();
    
    	$data = array(
			'pun_rec_id' => $punto_recarga->getPun_rec_id(),
			'pun_rec_nombre' => $punto_recarga->getPun_rec_nombre(),
			'pun_rec_ruc' => $punto_recarga->getPun_rec_ruc(),
			'pun_rec_lat' => $punto_recarga->getPun_rec_lat(),
			'pun_rec_lng' => $punto_recarga->getPun_rec_lng(),
			'pun_rec_direccion' => $punto_recarga->getPun_rec_direccion(),
			'pun_rec_saldo' => $punto_recarga->getPun_rec_saldo(),
            'pun_rec_habilitado' => $punto_recarga->getPun_rec_habilitado()
    	);
    	
    	$data ['pun_rec_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			$this->tableGateway->update ( $data, array ( 'pun_rec_id' => $id ) );
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
    	}
    }
    
    public function actualizar(PuntoRecarga $punto_recarga, $pun_rec_id) {
    
        $id = $punto_recarga->getPun_rec_id();
    
        $data = array (
            'pun_rec_id' => $punto_recarga->getPun_rec_id(),
            'pun_rec_nombre' => $punto_recarga->getPun_rec_nombre(),
            'pun_rec_ruc' => $punto_recarga->getPun_rec_ruc(),
            'pun_rec_lat' => $punto_recarga->getPun_rec_lat(),
            'pun_rec_lng' => $punto_recarga->getPun_rec_lng(),
            'pun_rec_direccion' => $punto_recarga->getPun_rec_direccion(),
            'pun_rec_observaciones' => $punto_recarga->getPun_rec_observaciones(),
            'pun_rec_saldo' => $punto_recarga->getPun_rec_saldo(),
            'pun_rec_habilitado' => $punto_recarga->getPun_rec_habilitado()
        );
    
        if (!empty ( $pun_rec_id ) && !is_null ( $pun_rec_id )) {
            if ($this->traer ( $pun_rec_id )) {
    
                $this->tableGateway->update ( $data, array ( 'pun_rec_id' => $pun_rec_id ) );
    
            } else {
                throw new \Exception ( 'No se encontro el id para actualizar' );
            }
        }
    }

	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'pun_rec_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
}