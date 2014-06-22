<?php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;

class AplicacionDao {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function traerTodos() {
		return $this->tableGateway->select ();
	}
	
	public function traerArreglo(){
		$resultSet= $this->traerTodos();
		$result=array();
		foreach($resultSet as $aplicacion){
			$result[$aplicacion->getApl_id()]=  $aplicacion->getApl_nombre() . ' - ' . $aplicacion->getApl_descripcion();
		}
		return $result;
	}
}