<?php
	//ParqueaderoSectorDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Calle;
use Application\Model\Dao\InterfaceCrud;

class ParqueaderoSectorDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($sec_id){
    	 
    	$sec_id = (int) $sec_id;
    	 
    	$resultSet = $this->tableGateway->select(array('sec_id' => $sec_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del establecimiento');
    	}
    	
    	return $row;
    }

    public function traerTodosArreglo(){

        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT s.sec_id, s.sec_nombre,
                    COUNT( * ) AS total, 
                    SUM( CASE WHEN p.par_estado !=  'D' THEN 1 ELSE 0 END ) AS ocupados
            FROM sector AS s
                JOIN parqueadero_sector AS ps
                    ON s.sec_id=ps.sec_id
                JOIN parqueadero AS p 
                    ON p.par_id = ps.par_id ";

        $where="";          

        $query.= $where;
        $query.= " GROUP BY sec_id ";
        
        $statement = $adapter->query($query);
        $results = $statement->execute();
        foreach($results as $row){
            echo '<pre>';
            print_r($row);
            echo '</pre>';    
        }
        
    }

    public function guardar(ParqueaderoSector $parqueaderoSector){

    	$data = array(
    		'sec_id' => $calle->getSec_id(),
			'par_id' => $calle->getPar_id()
    	);
    	
    	$this->tableGateway->insert ( $data );
    	
    }
    
    public function actualizar(Calle $calle, $cal_id) {
    
        $id = $calle->getCal_id();
    
        $data = array (
            'sec_id' => $calle->getSec_id(),
			'par_id' => $calle->getPar_id()
        );
    
        if (!empty ( $sec_id ) && !is_null ( $sec_id )) {
            if ($this->traer ( $sec_id )) {
                $this->tableGateway->update ( $data, array ( 'sec_id' => $sec_id ) );
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
					'sec_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
}	