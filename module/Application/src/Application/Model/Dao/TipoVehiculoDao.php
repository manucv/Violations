<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\TipoVehiculo;

class TipoVehiculoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	
    	return $this->tableGateway->select();
    }
    
    public function traer($tip_veh_id){
    
    	$tip_veh_id = (int) $tip_veh_id;
    
    	$resultSet = $this->tableGateway->select(array('tip_veh_id' => $tip_veh_id));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID del tipo de infraccion');
    	}
    
    	return $row;
    }
    
    
    public function guardar(TipoVehiculo $tipo_vehiculo) {
    
    	$id = ( int ) $tipo_vehiculo->getTip_veh_id ();
    
    	$data = array (
    			'tip_veh_descripcion' => $tipo_vehiculo->getTip_veh_descripcion(),
    	);
    
    	$data ['tip_veh_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'tip_veh_id' => $id ) );
    
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
    				'tip_veh_id' => $id
    		) );
    	} else {
    		throw new \Exception ( 'No se encontro el id para eliminar' );
    	}
    }
    
}