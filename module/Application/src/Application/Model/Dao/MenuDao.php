<?php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Entity\Menu;

class MenuDao {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join ( 'aplicacion', 'menu.apl_id  = aplicacion.apl_id' );
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
	public function traer($men_id){
    
    	$men_id = (int) $men_id;
    
    	$resultSet = $this->tableGateway->select(array('men_id' => $men_id));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID del menu');
    	}
    
    	return $row;
    }
    
    public function traerTodosArreglo(){
    	$resultSet = $this->tableGateway->select();
    	return $resultSet->toArray ();
    }
    
    public function guardar(Menu $menu){
    	$id = ( int ) $menu->getMen_id ();
    	
    	$data = array (
    			'men_nombre' => $menu->getMen_nombre (),
    			'men_etiqueta' => $menu->getMen_etiqueta (),
    			'apl_id' => $menu->getApl_id (),
    			'men_icon' => $menu->getMen_icon (),
    			'men_padre' => $menu->getMen_padre (),
    			'men_divisor' => $menu->getMen_divisor ()
    	);
    	
    	$data ['men_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'men_id' => $id ) );
    	
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
    				'men_id' => $id
    		) );
    	} else {
    		throw new \Exception ( 'No se encontro el id para eliminar' );
    	}
    }
	
}