<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Infraccion;
use Application\Model\Dao\InterfaceCrud;

class InfraccionDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($inf_id){
    	 
    	$inf_id = (int) $inf_id;
    	 
    	$resultSet = $this->tableGateway->select(array('inf_id' => $inf_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la infraccion');
    	}
    	
    	return $row;
    }
    
    public function guardar(Infraccion $infraccion){
    
    	$id = (int) $infraccion->getInf_id();
    
    	$data = array(
    			'inf_fecha' => $infraccion->getInf_fecha(),
    			'inf_detalles' => $infraccion->getInf_detalles(),
    			'usu_id' => $infraccion->getUsu_id(),
    			'tip_inf_id' => $infraccion->getTip_inf_id(),
    			'sec_id' => $infraccion->getSec_id()
    	);
    	
    	$data ['inf_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'inf_id' => $id ) );
    	
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
					'inf_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
}