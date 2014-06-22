<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\TipoComponente;

class TipoComponenteDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	
    	return $this->tableGateway->select();
    }
    
    public function traer($est_id){
    
    	$est_id = (int) $est_id;
    
    	$resultSet = $this->tableGateway->select(array('tip_com_id' => $est_id));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID del estado');
    	}
    
    	return $row;
    }
    
    
    public function guardar(TipoComponente $tipo_componente) {
    
    	$id = ( int ) $tipo_componente->getTip_com_id ();
    
    	$data = array (
    			'tip_com_descripcion' => $tipo_componente->getTip_com_descripcion (),
    			'tip_com_imagen' => $tipo_componente->getTip_com_imagen ()
    	);
    
    	$data ['tip_com_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'tip_com_id' => $id ) );
    
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
    				'tip_com_id' => $id
    		) );
    	} else {
    		throw new \Exception ( 'No se encontro el id para eliminar' );
    	}
    }
    
}