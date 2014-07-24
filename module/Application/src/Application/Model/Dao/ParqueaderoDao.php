<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Parqueadero;

class ParqueaderoDao implements InterfaceCrud {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function traerTodos() {
		return $this->tableGateway->select ();
		
		$select = $this->tableGateway->getSql ()->select ();
		$select->join ( 'sector', 'parqueadero.sec_id  = sector.sec_id' );
		 
		$resultSet = $this->tableGateway->selectWith ( $select );
		return $resultSet;
		
	}
	
	public function traer($par_id) {
		
		$par_id = ( int ) $par_id;
		
		$resultSet = $this->tableGateway->select ( array (
				'par_id' => $par_id 
		) );
		$row = $resultSet->current ();
		
		if (! $row) {
			throw new \Exception ( 'No se encontro el ID del parqueadero' );
		}
		
		return $row;
	}
	
	public function guardar(Parqueadero $parqueadero) {
		
		$id = ( int ) $parqueadero->getPar_id();
		
		$data = array (
				'par_estado' => $parqueadero->getPar_estado(),
				'par_codigo' => $parqueadero->getPar_codigo(),
				'sec_id' => $parqueadero->getSec_id()
		);
		
		$data ['par_id'] = $id;
		
		if (!empty ( $id ) && !is_null ( $id )) {
			if ($this->traer ( $id )) {
				
				$this->tableGateway->update ( $data, array ( 'par_id' => $id ) );
				
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
					'par_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
	
}