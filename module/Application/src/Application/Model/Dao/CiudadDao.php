<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Ciudad;
use Application\Model\Dao\InterfaceCrud;

class CiudadDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos($est_id=null){
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join ( 'estado', 'ciudad.est_id  = estado.est_id' );
        if(!is_null($est_id)){
            $select->where ( array('estado.est_id'=>$est_id) );
        }   	
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($ciu_id){
    	 
    	$ciu_id = (int) $ciu_id;
    	 
    	$resultSet = $this->tableGateway->select(array('ciu_id' => $ciu_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la ciudad');
    	}
    	
    	return $row;
    }
    
    public function guardar(Ciudad $ciudad){
    
    	$id = (int) $ciudad->getCiu_id();
    
    	$data = array(
    			'est_id' => $ciudad->getEst_id(),
    			'ciu_nombre_es' => $ciudad->getCiu_nombre_es(),
    			'ciu_nombre_en' => $ciudad->getCiu_nombre_en(),
    			'ciu_codigo_telefono' => $ciudad->getCiu_codigo_telefono()
    	);
    	
    	$data ['ciu_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'ciu_id' => $id ) );
    	
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
					'ciu_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
    
    public function traerTodosArreglo(){
    	 
    	$sql = new Sql($this->tableGateway->getAdapter());
    	$select = $sql->select();
    	$select->from($this->tableGateway->table);
    	 
    	$statement = $sql->prepareStatementForSqlObject($select);
    	$results = $statement->execute();
    	 
    	$ciudades = new \ArrayObject();
    	$result = array();
    	 
    	foreach ($results as $row){
    		$ciudad = new Ciudad();
    		$ciudad->exchangeArray($row);
    		$ciudades->append($ciudad);
    	}
    	 
    	foreach ($ciudades as $ciu){
    		$result[$ciu->getCiu_id()] = $ciu->getCiu_nombre_es();
    	}
    
    	return $result;
    }
    
    public function getCiudadesPorEstado($ciudad){
    
    	$sql = new Sql($this->tableGateway->getAdapter());
    	$select = $sql->select();
    	$select->from($this->tableGateway->table);
    	$select->where(array('est_id' => $ciudad));
    
    	$statement = $sql->prepareStatementForSqlObject($select);
    	$results = $statement->execute();
    
    	$ciudades = new \ArrayObject();
    	$result = array();
    
    	foreach ($results as $row){
    		$ciudad = new Ciudad();
    		$ciudad->exchangeArray($row);
    		$ciudades->append($ciudad);
    	}
    
    	foreach ($ciudades as $ciu){
    		$result[$ciu->getCiu_id()] = $ciu->getCiu_nombre_es();
    	}
    
    	return $result;
    }
    
}