<?php
//PublicidadDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Publicidad;

class PublicidadDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	
    	return $this->tableGateway->select();
    }
    
    public function traer($pub_id){
    
    	$pub_id = (int) $pub_id;
    
    	$resultSet = $this->tableGateway->select(array('pub_id' => $pub_id));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la publicidad');
    	}
    
    	return $row;
    }
    
    public function traerRnd(){

        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT * 
            FROM publicidad 
            WHERE pub_estado='1'
            ORDER BY RAND()
            LIMIT 1
        ";
        
        $statement = $adapter->query($query);
        $results = $statement->execute();

        $anuncio = $results->current();

        return $anuncio;
    }
    
    public function guardar(Publicidad $publicidad) {
    
    	$id = ( int ) $publicidad->getPub_id ();
    
    	$data = array (
			'pub_nombre' => $publicidad->getPub_nombre(),
			'pub_imagen' => $publicidad->getPub_imagen(),
			'pub_link' => $publicidad->getPub_link(),
			'pub_estado' => $publicidad->getPub_estado()
    	);
    
    	$data ['pub_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'pub_id' => $id ) );
    
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
    				'pub_id' => $id
    		) );
    	} else {
    		throw new \Exception ( 'No se encontro el id para eliminar' );
    	}
    }
    
}