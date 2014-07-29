<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Estado;

class EstadoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join ( 'pais', 'pais.pai_id  = estado.pai_id' );
    	
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    	
    }
    
    public function traer($est_id){
    
    	$est_id = (int) $est_id;
    
    	$resultSet = $this->tableGateway->select(array('est_id' => $est_id));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID del estado');
    	}
    
    	return $row;
    }
    
    
    public function guardar(Estado $estado) {
    
    	$id = ( int ) $estado->getEst_id ();
    
    	$data = array (
    			'pai_id' => $estado->getPai_id (),
    			'est_nombre_es' => $estado->getEst_nombre_es (),
    			'est_nombre_en' => $estado->getEst_nombre_en ()
    	);
    
    	$data ['est_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'est_id' => $id ) );
    
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
    				'est_id' => $id
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
    	 
    	$estados = new \ArrayObject();
    	$result = array();
    	 
    	foreach ($results as $row){
    		$estado = new Estado();
    		$estado->exchangeArray($row);
    		$estados->append($estado);
    	}
    	 
    	foreach ($estados as $est){
    		$result[$est->getEst_id()] = $est->getEst_nombre_es();
    	}
    
    	return $result;
    }
    
    public function getEstadosPorPais($pais){
    
    	$sql = new Sql($this->tableGateway->getAdapter());
    	$select = $sql->select();
    	$select->from($this->tableGateway->table);
    	$select->where(array('pai_id' => $pais));
    
    	$statement = $sql->prepareStatementForSqlObject($select);
    	$results = $statement->execute();
    
    	$estados = new \ArrayObject();
    	$result = array();
    
    	foreach ($results as $row){
    		$estado = new Estado();
    		$estado->exchangeArray($row);
    		$estados->append($estado);
    	}
    
    	foreach ($estados as $est){
    		$result[$est->getEst_id()] = $est->getEst_nombre_es();
    	}
    
    	return $result;
    }
    
}