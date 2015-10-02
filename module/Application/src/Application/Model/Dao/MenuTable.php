<?php

namespace Application\Model\Dao;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Adapter\AdapterAwareInterface;

class MenuTable extends AbstractTableGateway implements AdapterAwareInterface {
	
	protected $table = 'menu';
	
	public function setDbAdapter(Adapter $adapter) {
		$this->adapter = $adapter;
		$this->resultSetPrototype = new HydratingResultSet ();
		
		$this->initialize ();
	}
	
	public function fetchAllPadres() {
			$rol_id = 6; 
			if(isset($_SESSION['Zend_Auth'])){
				$rol_id = $_SESSION['Zend_Auth']['storage']->rol_id; 
			}

			$resultSet = $this->select ( function (Select $select) {
				$select->join('rol_aplicacion', 'rol_aplicacion.apl_id = menu.apl_id');
				$select->join('aplicacion', 'aplicacion.apl_id = menu.apl_id');
				$select->where(array('rol_aplicacion.rol_id' => $rol_id));
				$select->order ( array (
						'men_id asc' 
				) );
			} );
			
			$resultSet = $resultSet->toArray ();
			
			return $resultSet;

	}
}