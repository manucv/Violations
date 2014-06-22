<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\TipoInfraccion;

class TipoInfraccionDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	
    	return $this->tableGateway->select();
    }
    
    public function traer($tip_inf_id){
    
    	$tip_inf_id = (int) $tip_inf_id;
    
    	$resultSet = $this->tableGateway->select(array('tip_inf_id' => $tip_inf_id));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID del tipo de infraccion');
    	}
    
    	return $row;
    }
    
    
    public function guardar(TipoInfraccion $tipo_infraccion) {
    
    	$id = ( int ) $tipo_infraccion->getTip_inf_id ();
    
    	$data = array (
    			'tip_inf_descripcion' => $tipo_infraccion->getTip_inf_descripcion (),
    	);
    
    	$data ['tip_inf_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'tip_inf_id' => $id ) );
    
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
    				'tip_inf_id' => $id
    		) );
    	} else {
    		throw new \Exception ( 'No se encontro el id para eliminar' );
    	}
    }
    
}