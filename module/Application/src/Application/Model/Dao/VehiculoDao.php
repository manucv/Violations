<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Vehiculo;

class VehiculoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join ( 'tipo_vehiculo', 'tipo_vehiculo.tip_veh_id  = vehiculo.tip_veh_id' );
    	
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traerTodosConCamara(){
    	 
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join ( 'tipo_vehiculo', 'tipo_vehiculo.tip_veh_id  = vehiculo.tip_veh_id' );
    	$select->where(array('veh_camara_activa' => 'S'));
    	 
    	$resultSet = $this->tableGateway->selectWith ( $select );
    	return $resultSet;
    }
    
    public function traer($veh_id){
    
    	$veh_id = (int) $veh_id;
    
    	$resultSet = $this->tableGateway->select(array('veh_id' => $veh_id));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID del vehiculo');
    	}
    
    	return $row;
    }
    
    
    public function guardar(Estado $estado) {
    
    	$id = ( int ) $estado->getVeh_id ();
    
    	$data = array (
    			'tip_veh_id' => $estado->getTip_veh_id (),
    			'veh_marca' => $estado->getVeh_marca (),
    			'veh_modelo' => $estado->getVeh_modelo (),
    			'veh_placa' => $estado->getVeh_placa (),
    			'veh_camara_activa' => $estado->getVeh_camara_activa ()
    	);
    
    	$data ['veh_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'veh_id' => $id ) );
    
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
    				'veh_id' => $id
    		) );
    	} else {
    		throw new \Exception ( 'No se encontro el id para eliminar' );
    	}
    }
}