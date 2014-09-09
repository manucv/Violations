<?php
	//ClienteDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Cliente;
use Application\Model\Dao\InterfaceCrud;

class ClienteDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($cli_id){
    	 
    	$cli_id = (int) $cli_id;
    	 
    	$resultSet = $this->tableGateway->select(array('cli_id' => $cli_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la ciudad');
    	}
    	
    	return $row;
    }
    
    public function guardar(Cliente $cliente){
    
    	$id = (int) $cliente->getCli_id();
    
    	$data = array(
			'cli_nombre' => $cliente->getCli_nombre(),
			'cli_email' => $cliente->getCli_email(),
			'cli_passw' => $cliente->getCli_passw(),
			'cli_saldo' => $cliente->getCli_saldo(),
			'cli_estado' => $cliente->getCli_estado()
    	);
    	
    	$data ['cli_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'cli_id' => $id ) );
    	
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
					'cli_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}

    public function buscarPorEmail($email,$passw){

        $resultSet = $this->tableGateway->select(array('cli_email' => $email, 'cli_passw'=>$passw));
        $row =  $resultSet->current();
        
        
        return $row;
    }

    public function debitar($cli_id, $valor=0) {
        if($cli_id){
            $cliente=$this->traer($cli_id);
            if($cliente){
                $cliente->setCli_saldo($cliente->getCli_saldo()-$valor);
                $data = $cliente->getArrayCopy();

                $this->tableGateway->update ( $data, array ( 'cli_id' => $cliente->getCli_id() ) );
                return $cliente;
            }
        }

    }    
    
}