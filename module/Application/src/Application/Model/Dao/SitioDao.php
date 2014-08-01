<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Entity\Sitio;

class SitioDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
         $select = $this->tableGateway->getSql ()->select ();
         $select->join ( 'ciudad', 'ciudad.ciu_id  = sitio.ciu_id' );
          
         $resultSet = $this->tableGateway->selectWith ( $select );
         return $resultSet;
    }
    
    public function traerTodosPorCiudad($ciu_id){
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join ( 'ciudad', 'ciudad.ciu_id  = sitio.ciu_id' );
    	$select->where(array('sitio.ciu_id' => $ciu_id));
    
    	$resultSet = $this->tableGateway->selectWith ( $select );
    	return $resultSet;
    }
    
    public function traer($sit_id){
    	$sit_id = (int) $sit_id;
    	
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join ( 'ciudad', 'ciudad.ciu_id  = sitio.ciu_id' );
    	$select->join ( 'estado', 'estado.est_id  = ciudad.est_id' );
    	$select->join ( 'pais', 'pais.pai_id  = estado.pai_id' );
    	
    	$select->where(array('sit_id' => $sit_id));
    	
    	$resultSet = $this->tableGateway->selectWith ( $select );
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del sitio');
    	}
    	
    	return $row;
    }
    
    public function eliminar($id) {
    	if ($this->traer ( $id )) {
    		return $this->tableGateway->delete ( array (
    				'sit_id' => $id
    		) );
    	} else {
    		throw new \Exception ( 'No se encontro el id para eliminar' );
    	}
    }
    
    public function guardar(Sitio $sitio) {
    
    	$id = ( int ) $sitio->getSit_id();
    
    	$data = array (
    			'ciu_id' => $sitio->getCiu_id(),
    			'sit_descripcion' => $sitio->getSit_descripcion(),
    			'sit_direccion' => $sitio->getSit_direccion(),
    			'sit_sector' => $sitio->getSit_sector(),
    			'sit_reference_number' => $sitio->getSit_reference_number(),
    			'sit_estado' => $sitio->getSit_estado(),
    			'sit_latitud' => $sitio->getSit_latitud(),
    			'sit_longitud' => $sitio->getSit_longitud(),
    			'sit_ultima_respuesta' => $sitio->getSit_ultima_respuesta(),
    			'sit_ultimo_valor' => $sitio->getSit_ultimo_valor(),
    	);
    
    	$data ['sit_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'sit_id' => $id ) );
    
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
    	}
    }
}