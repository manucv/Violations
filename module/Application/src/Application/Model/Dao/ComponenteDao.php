<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
use Application\Model\Entity\Componente;

class ComponenteDao {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$resultSet = $this->tableGateway->select();
         return $resultSet;
    }
    
    public function traer($sit_id){
    	 
    	$sit_id = (int) $sit_id;
    	 
    	$resultSet = $this->tableGateway->select(array('com_id' => $sit_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del componente');
    	}
    	
    	return $row;
    }
    
    public function traerPorSitio($sit_id){
    	$sit_id = (int) $sit_id;
    	
    	$sql = new Sql($this->tableGateway->getAdapter());
    	$select = $sql->select();
    	$select->from($this->tableGateway->table);
    	$select->where(array('sit_id' => $sit_id));
    	 
    	$statement = $sql->prepareStatementForSqlObject($select);
    	$results = $statement->execute();
    	$result = array();
    	foreach ($results as $row => $value){
    		$result[$row] = $value;
    	}
    	 
    	return $result;
    	
    }
}