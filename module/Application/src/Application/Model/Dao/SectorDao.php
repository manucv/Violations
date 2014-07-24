<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Sector;

class SectorDao implements InterfaceCrud {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function traerTodos() {
		return $this->tableGateway->select ();
	}
	
	public function traer($sec_id) {
		
		$sec_id = ( int ) $sec_id;
		
		$resultSet = $this->tableGateway->select ( array (
				'sec_id' => $sec_id 
		) );
		$row = $resultSet->current ();
		
		if (! $row) {
			throw new \Exception ( 'No se encontro el ID del sector' );
		}
		
		return $row;
	}
	
	public function guardar(Sector $sector) {
		
		$id = ( int ) $sector->getSec_id ();
		
		$data = array (
				'sec_nombre' => $sector->getSec_nombre (),
				'sec_latitud' => $sector->getSec_latitud (),
				'sec_longitud' => $sector->getSec_longitud ()
		);
		
		$data ['sec_id'] = $id;
		
		if (!empty ( $id ) && !is_null ( $id )) {
			if ($this->traer ( $id )) {
				
				$this->tableGateway->update ( $data, array ( 'sec_id' => $id ) );
				
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
					'sec_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
}