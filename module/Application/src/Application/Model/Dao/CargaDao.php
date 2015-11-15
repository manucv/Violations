<?php //CargaDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Carga;
use Application\Model\Dao\InterfaceCrud;

class CargaDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($car_id){
    	 
    	$car_id = (int) $car_id;
    	 
    	$resultSet = $this->tableGateway->select(array('car_id' => $car_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la recarga');
    	}
    	
    	return $row;
    }


    public function traerPendientes(){
                 
        $resultSet = $this->tableGateway->select(array('car_estado' => 'P'));
        $row =  $resultSet->current();
        
        if(!$row){
            throw new \Exception('No se encontro el ID de la recarga');
        }
        
        return $row;
    }
    

    public function guardar(Carga $carga){
    	$id = (int) $carga->getCar_id();
    
    	$data = array(
			'pun_rec_id' => $carga->getPun_rec_id(),
			'car_valor' => $carga->getCar_valor()
    	);
    	
    	$data ['car_id'] = $id;

    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			$this->tableGateway->update ( $data, array ( 'car_id' => $id ) );
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
					'car_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}

    
}	