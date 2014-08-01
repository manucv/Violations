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
    	$select = $this->tableGateway->getSql ()->select ();
		$select->join ( 'sitio', 'sitio.sit_id  = componente.sit_id' );
		$select->join ( 'tipo_componente', 'tipo_componente.tip_com_id  = componente.tip_com_id' );
		 
		$resultSet = $this->tableGateway->selectWith ( $select );
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
    
    public function guardar(Componente $componente){
    
    	$id = (int) $componente->getCom_id();
    
    	$data = array(
    			'sit_id' => $componente->getSit_id(),
    			'tip_com_id' => $componente->getTip_com_id(),
    			'com_descripcion' => $componente->getCom_descripcion(),
    			'com_ip_local' => $componente->getCom_ip_local(),
    			'com_ip_publica' => $componente->getCom_ip_publica(),
    			'com_usuario' => $componente->getCom_usuario(),
    			'com_clave' => $componente->getCom_clave(),
    			'com_puerto' => $componente->getCom_puerto(),
    			'com_mascara' => $componente->getCom_mascara(),
    			'com_gateway' => $componente->getCom_gateway(),
    			'com_dns1' => $componente->getCom_dns1(),
    			'com_dns2' => $componente->getCom_dns2(),
    			'com_estado' => $componente->getCom_estado(),
    			'com_ultima_respuesta' => $componente->getCom_ultima_respuesta(),
    			'com_ultimo_valor' => $componente->getCom_ultimo_valor(),
    	);
    	 
    	$data ['com_id'] = $id;
    	 
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			 
    			//$this->tableGateway->update ( $data, array ( 'com_id' => $id ) );
    			
    			$sql = new Sql($this->tableGateway->getAdapter());
    			$update = $sql->update($this->tableGateway->table);
    			$update->set(array('com_estado' => $componente->getCom_estado(), 'com_ultima_respuesta' => $componente->getCom_ultima_respuesta(), 'com_ultimo_valor' => $componente->getCom_ultimo_valor()));
    			$update->where(array('com_id' => $id));
    			
    			$statement = $sql->prepareStatementForSqlObject($update);
    			$statement->execute();
    			
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
    	}
    }
}