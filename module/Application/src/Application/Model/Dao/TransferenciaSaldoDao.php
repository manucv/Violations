<?php 
	//TransferenciaSaldoDao.php
	
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\TransferenciaSaldo;
use Application\Model\Dao\InterfaceCrud;

class TransferenciaSaldoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($tra_sal_id){
    	 
    	$tra_sal_id = (int) $tra_sal_id;
    	 
    	$resultSet = $this->tableGateway->select(array('tra_sal_id' => $tra_sal_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la ciudad');
    	}
    	
    	return $row;
    }
    
    public function guardar(TransferenciaSaldo $transferenciaSaldo){
    
    	$id = (int) $transferenciaSaldo->getTra_sal_id();
    
    	$data = array(
			'cli_id_de' => $transferenciaSaldo->getCli_id_de(),
			'cli_id_para' => $transferenciaSaldo->getCli_id_para(),
			'tra_sal_valor' => $transferenciaSaldo->getTra_sal_valor(),
			'tra_sal_hora' => $transferenciaSaldo->getTra_sal_hora(),
    	);
    	
    	$data ['tra_sal_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'tra_sal_id' => $id ) );
    	
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
					'tra_sal_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
}	