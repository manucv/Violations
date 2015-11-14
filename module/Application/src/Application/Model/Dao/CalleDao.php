<?php
	//CalleDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Calle;
use Application\Model\Dao\InterfaceCrud;

class CalleDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($cal_id){
    	 
    	$cal_id = (int) $cal_id;
    	 
    	$resultSet = $this->tableGateway->select(array('cal_id' => $cal_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del establecimiento');
    	}
    	
    	return $row;
    }

    public function traerTodosArreglo(){
    
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from($this->tableGateway->table);
    
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
    
        $calles = new \ArrayObject();
        $result = array();
    
        foreach ($results as $row){
            $calle = new Calle();
            $calle->exchangeArray($row);
            $calles->append($calle);
        }
    
        foreach ($calles as $cal){
            $result[$cal->getCal_id()] = $cal->getCal_nombre();
        }
    
        return $result;
    }

    public function guardar(Calle $calle){

    	$id = (int) $calle->getCal_id();
    
    	$data = array(
			'cal_codigo' => $calle->getCal_codigo(),
			'cal_nombre' => $calle->getCal_nombre()
    	);
    	
    	$data ['cal_id'] = $id;

    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			$this->tableGateway->update ( $data, array ( 'cal_id' => $id ) );
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
    	}
    }
    
    public function actualizar(Calle $calle, $cal_id) {
    
        $id = $calle->getCal_id();
    
        $data = array (
            'cal_id' => $calle->getCal_id(),
			'cal_codigo' => $calle->getCal_codigo(),
			'cal_nombre' => $calle->getCal_nombre()
        );
    
        if (!empty ( $cal_id ) && !is_null ( $cal_id )) {
            if ($this->traer ( $cal_id )) {
                $this->tableGateway->update ( $data, array ( 'cal_id' => $cal_id ) );
            } else {
                throw new \Exception ( 'No se encontro el id para actualizar' );
            }
        }
    }

    public function buscar($placa){
    	
    }

	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'cal_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
}	