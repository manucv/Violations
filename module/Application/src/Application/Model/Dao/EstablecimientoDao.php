<?php
	//EstablecimientoDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Establecimiento;
use Application\Model\Dao\InterfaceCrud;

class EstablecimientoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($est_id){
    	 
    	$est_id = (int) $est_id;
    	 
    	$resultSet = $this->tableGateway->select(array('est_id' => $est_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del establecimiento');
    	}
    	
    	return $row;
    }
    
    
    public function traerPorCategoria($cat_id){
         
        $select = $this->tableGateway->getSql()->select ();
        $select-> where ( array('cat_id'=>$cat_id) );
        $resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    

    public function guardar(Categoria $establecimiento){
    
    	$id = (int) $establecimiento->getEst_id();
    
    	$data = array(
			'est_nombre' => $establecimiento->getEst_nombre(),
			'est_descripcion' => $establecimiento->getEst_descripcion(),

    	);
    	
    	$data ['est_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'est_id' => $id ) );
    	
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
    	}
    }
    
	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'est_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
}