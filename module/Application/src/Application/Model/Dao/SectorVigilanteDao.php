<?php
	//SectorVigilanteDao.php
	
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\SectorVigilante;
use Application\Model\Dao\InterfaceCrud;

class SectorVigilanteDao implements InterfaceCrud {
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }

    public function traerTodos($usu_id=null){
    	$select = $this->tableGateway->getSql ()->select ();
        $select->where ( array('usu_id'=>$usu_id) );
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($sec_vig_id){
    
    	$sec_vig = (int) $sec_vig;
    
    	$resultSet = $this->tableGateway->select(array('sec_vig' => $sec_vig));
    	$row =  $resultSet->current();
    
    	if(!$row){
    		throw new \Exception('No se encontro el ID del estado');
    	}
    
    	return $row;
    }
    
    
    public function guardar(SectorVigilante $sectorVigilante) {
    
    	$id = ( int ) $sectorVigilante->getSec_vig_id ();
    
    	$data = array (
			'sec_vig_id' => $sectorVigilante->getSec_vig_id(),
			'usu_id' => $sectorVigilante->getUsu_id(),
			'sec_id' => $sectorVigilante->getSec_id()
    	);
    
    	$data ['sec_vig_id'] = $id;
    
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    
    			$this->tableGateway->update ( $data, array ( 'sec_vig_id' => $id ) );
    
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
    	}
    }
}
