<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\MultaParqueadero;
use Application\Model\Dao\InterfaceCrud;

class MultaParqueaderoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($mul_par_id){
    	 
    	$mul_par_id = (int) $mul_par_id;
    	 
    	$resultSet = $this->tableGateway->select(array('mul_par_id' => $mul_par_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la multa parqueadero');
    	}
    	
    	return $row;
    }
    
    public function guardar(MultaParqueadero $multaParqueadero){
    
    	$id = (int) $multaParqueadero->getMul_par_id();
    
    	$data = array(
    			'par_id' => $multaParqueadero->getPar_id(),
    			'aut_placa' => $multaParqueadero->getAut_placa(),
    			'inf_id' => $multaParqueadero->getInf_id(),
    			'mul_par_estado' => $multaParqueadero->getMul_par_estado(),
    			'mul_par_valor' => $multaParqueadero->getMul_par_valor()
    	);
    	
    	$data ['mul_par_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'mul_par_id' => $id ) );
    	
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
					'mul_par_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
}