<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Dispositivo;

class DispositivoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	
    	return $this->tableGateway->select();
    	
    }
    
    public function traer($dis_id){
    
    	$dis_id = (int) $dis_id;
    
    	$resultSet = $this->tableGateway->select(array('dis_id' => $dis_id));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID del estado');
    	}
    
    	return $row;
    }
    
    public function traerTodosPorVehiculo($veh_id){
    	
    	$veh_id = (int) $veh_id;
    	return $this->tableGateway->select(array('veh_id' => $veh_id));
    }
    
    
    public function guardar(Dispositivo $dispositivo) {
    
    	$id = ( int ) $dispositivo->getDis_id ();
    
    	$data = array (
    			'veh_id' => $dispositivo->getVeh_id (),
    			'dis_descripcion' => $dispositivo->getDis_descripcion (),
    			'dis_link' => $dispositivo->getDis_link (),
    			'dis_usuario' => $dispositivo->getDis_usuario (),
    			'dis_clave' => $dispositivo->getDis_clave ()
    	);
    
    	$data ['dis_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'dis_id' => $id ) );
    
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
    				'dis_id' => $id
    		) );
    	} else {
    		throw new \Exception ( 'No se encontro el id para eliminar' );
    	}
    }
}