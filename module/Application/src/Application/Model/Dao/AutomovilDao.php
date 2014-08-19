<?php
/* AutomovilDao.php */

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Automovil;
use Application\Model\Dao\InterfaceCrud;

class AutomovilDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }

    public function traer($aut_placa){
    	 
    	$aut_placa = $aut_placa;
    	 
    	$resultSet = $this->tableGateway->select(array('aut_placa' => $aut_placa));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la ciudad');
    	}
    	
    	return $row;
    }

    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }    

    public function guardar(Automovil $automovil){
    
    	$id =  $automovil->getAut_placa();

    	
    	$data ['aut_placa'] = $id;
    	
    	/*if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			$this->tableGateway->update ( $data, array ( 'aut_placa' => $id ) );
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{*/
    		$this->tableGateway->insert ( $data );
    	//}
    }
    
	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'aut_placa' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
    
}