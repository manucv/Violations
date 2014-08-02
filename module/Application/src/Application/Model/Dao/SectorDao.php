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
		$select = $this->tableGateway->getSql ()->select ();
		$select->join ( 'ciudad', 'ciudad.ciu_id  = sector.ciu_id' );
		 
		$resultSet = $this->tableGateway->selectWith ( $select );
		return $resultSet;
	}
	
	public function traer($sec_id) {
		
		$select = $this->tableGateway->getSql ()->select ();
		$select->join ( 'ciudad', 'ciudad.ciu_id  = sector.ciu_id' );
		$select->join ( 'estado', 'estado.est_id  = ciudad.est_id' );
		$select->join ( 'pais', 'pais.pai_id  = estado.pai_id' );
		$select->where(array('sec_id' => $sec_id));
			
		$resultSet = $this->tableGateway->selectWith ( $select );
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
				'sec_longitud' => $sector->getSec_longitud (),
				'ciu_id' => $sector->getCiu_id(),
				'sec_ubicacion' => $sector->getSec_ubicacion(),
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
	
	public function traerTodosArreglo(){
	
		$sql = new Sql($this->tableGateway->getAdapter());
		$select = $sql->select();
		$select->from($this->tableGateway->table);
	
		$statement = $sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();
	
		$sectores = new \ArrayObject();
		$result = array();
	
		foreach ($results as $row){
			$sector = new Sector();
			$sector->exchangeArray($row);
			$sectores->append($sector);
		}
	
		foreach ($sectores as $sec){
			$result[$sec->getSec_id()] = $sec->getSec_nombre();
		}
	
		return $result;
	}

	public function traerTodosJSON(){

		$adapter = $this->tableGateway->getAdapter();
		$query = "
			SELECT 	s.sec_id, s.sec_nombre, s.sec_latitud, s.sec_longitud, 
					COUNT( p.sec_id ) AS total, 
					SUM( CASE WHEN p.par_estado !=  'D' THEN 1 ELSE 0 END ) AS ocupados
			FROM sector AS s
				JOIN parqueadero AS p 
					ON p.sec_id = s.sec_id
			GROUP BY sec_id ";
    	
    	$statement = $adapter->query($query);
    	$results = $statement->execute();

		$sectores = new \ArrayObject();
	
		$count=0;
		$jsonArray=array();

		foreach ($results as $row){

			$jsonArray[$count]['id']=$row['sec_id'];
			$jsonArray[$count]['title']=$row['sec_nombre'];
			$jsonArray[$count]['lat']=$row['sec_latitud'];
			$jsonArray[$count]['lng']=$row['sec_longitud'];
			$jsonArray[$count]['description']=$row['sec_nombre'];
			$jsonArray[$count]['total']=$row['total'];
			$jsonArray[$count]['ocupados']=$row['ocupados'];

			$count++;
		}

		return json_encode($jsonArray);
	}	
}