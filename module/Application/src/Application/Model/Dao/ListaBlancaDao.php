<?php	//ListaBlancaDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\ListaBlanca;
use Application\Model\Dao\InterfaceCrud;

class ListaBlancaDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($lis_bla_id){
    	 
    	$lis_bla_id = (int) $lis_bla_id;
    	 
    	$resultSet = $this->tableGateway->select(array('lis_bla_id' => $lis_bla_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del establecimiento');
    	}
    	
    	return $row;
    }

    public function enLista($lis_bla_placa){

        if($lis_bla_placa != ''){ 
            $lis_bla_placa = strtoupper($lis_bla_placa);
            $sql = new Sql($this->tableGateway->getAdapter());
            $select = $sql->select();
            $select->from('lista_blanca');
            $select->where            
                    ->equalTo('lis_bla_placa',$lis_bla_placa);
            
            $statement = $sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();
            $count =  $results->count();

            return $count;
        }
        return 0;
    }

    public function guardar(ListaBlanca $lista_blanca){
    
    	$id = (int) $lista_blanca->getLis_bla_id();
    
    	$data = array(
			'lis_bla_id' => $lista_blanca->getLis_bla_id(),
			'lis_bla_placa' => $lista_blanca->getLis_bla_placa()
    	);
    	
    	$data ['lis_bla_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			$this->tableGateway->update ( $data, array ( 'lis_bla_id' => $id ) );
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
    	}
    }
    
    public function actualizar(ListaBlanca $lista_blanca, $lis_bla_id) {
    
        $id = $lista_blanca->getLis_bla_id();
    
        $data = array (
            'lis_bla_id' => $lista_blanca->getLis_bla_id(),
            'lis_bla_placa' => $lista_blanca->getLis_bla_placa(),
        );
    
        if (!empty ( $lis_bla_id ) && !is_null ( $lis_bla_id )) {
            if ($this->traer ( $lis_bla_id )) {
                $this->tableGateway->update ( $data, array ( 'lis_bla_id' => $lis_bla_id ) );
            } else {
                throw new \Exception ( 'No se encontro el id para actualizar' );
            }
        }
    }

    public function buscar($placa){
    	
    }

	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'lis_bla_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
}	