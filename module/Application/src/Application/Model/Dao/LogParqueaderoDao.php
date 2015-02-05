<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\LogParqueadero;

class LogParqueaderoDao implements InterfaceCrud {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function traerOcupadosPorSector($sec_id) {
		$select = $this->tableGateway->getSql()->select();
		$select->join ( 'parqueadero', 'log_parqueadero.par_id  = parqueadero.par_id' ); 
		$select->join ( 'sector', 'parqueadero.sec_id  = sector.sec_id' ); 
		$select->where ( 'sector', 'parqueadero.sec_id  = sector.sec_id' ); 
		$resultSet = $this->tableGateway->selectWith ( $select );
		return $resultSet;
	}
		
	public function guardar(LogParqueadero $logParqueadero) {
		
		$id = ( int ) $logParqueadero->getLog_par_id();
		
		$data = array (
			'log_par_fecha_ingreso' => $logParqueadero->getLog_par_fecha_ingreso(),
			'log_par_horas_parqueo' => $logParqueadero->getLog_par_horas_parqueo(),
			'log_par_estado' => $logParqueadero->getLog_par_estado(),
			'par_id' => $logParqueadero->getPar_id(),
			'aut_placa' => $logParqueadero->getAut_placa(),
			'tra_id' => $logParqueadero->getTra_id()
		);
		
		$data ['log_par_id'] = $id;
		
		$this->tableGateway->insert ( $data );
		
	}

	public function traerTodos() {
		
		$select = $this->tableGateway->getSql ()->select ();
		 
		$resultSet = $this->tableGateway->selectWith ( $select );
		return $resultSet;
		
	}

	public function traerPorTransaccion($tra_id) {
		
		$select = $this->tableGateway->getSql ()->select ();
        $select->where ( array('tra_id'=>$tra_id) );
		$resultSet = $this->tableGateway->selectWith ( $select );
		return $resultSet->current();
		
	}

	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'log_par_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}

	public function traer($log_par_id) {
		
		$log_par_id = ( int ) $log_par_id;
		
		$resultSet = $this->tableGateway->select ( array (
				'log_par_id' => $log_par_id 
		) );
		$row = $resultSet->current ();
		
		if (! $row) {
			throw new \Exception ( 'No se encontro el ID del parqueadero' );
		}
		
		return $row;
	}


	
}