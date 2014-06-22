<?php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Pais;

class PaisDao implements InterfaceCrud {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function traerTodos() {
		return $this->tableGateway->select ();
	}
	
	public function traer($pai_id) {
		
		$pai_id = ( int ) $pai_id;
		
		$resultSet = $this->tableGateway->select ( array (
				'pai_id' => $pai_id 
		) );
		$row = $resultSet->current ();
		
		if (! $row) {
			throw new \Exception ( 'No se encontro el ID de la pais' );
		}
		
		return $row;
	}
	
	public function guardar(Pais $pais) {
		
		$id = ( int ) $pais->getPai_id ();
		
		$data = array (
				'pai_nombre_es' => $pais->getPai_nombre_es (),
				'pai_nombre_en' => $pais->getPai_nombre_en (),
				'pai_codigo_telefono' => $pais->getPai_codigo_telefono ()
		);
		
		$data ['pai_id'] = $id;
		
		if (!empty ( $id ) && !is_null ( $id )) {
			if ($this->traer ( $id )) {
				
				$this->tableGateway->update ( $data, array ( 'pai_id' => $id ) );
				
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
					'pai_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
	
	public function traerTodosArreglo() {
		$sql = new Sql ( $this->tableGateway->getAdapter () );
		$select = $sql->select ();
		$select->from ( $this->tableGateway->table );
	
		$statement = $sql->prepareStatementForSqlObject ( $select );
		$results = $statement->execute ();
	
		$paises = new \ArrayObject ();
		$result = array ();
	
		foreach ( $results as $row ) {
			$pais = new Pais ();
			$pais->exchangeArray ( $row );
			$paises->append ( $pais );
		}
	
		foreach ( $paises as $emp ) {
			$result [$emp->getPai_id ()] = $emp->getPai_nombre_es ();
		}
	
		return $result;
	}
	
}