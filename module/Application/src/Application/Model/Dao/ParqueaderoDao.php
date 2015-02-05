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
		
		$select = $this->tableGateway->getSql ()->select ();
		$select->join ( 'sector', 'parqueadero.sec_id  = sector.sec_id' );
		 
		$resultSet = $this->tableGateway->selectWith ( $select );
		return $resultSet;
		
	}

	public function traerJerarquia($par_id) {

		$adapter = $this->tableGateway->getAdapter();
		$query = "
			SELECT * 
			FROM parqueadero AS p
			JOIN sector AS s ON p.sec_id=s.sec_id
			JOIN ciudad AS c ON s.ciu_id=c.ciu_id
			JOIN estado AS e ON c.est_id=e.est_id
			JOIN pais AS pai ON e.pai_id=pai.pai_id
			WHERE par_id='$par_id'
		";
    	
    	$statement = $adapter->query($query);
    	$results = $statement->execute();

    	$lugar = $results->current();

    	return $lugar;
		
	}	

	public function traerTodosPorSector($sec_id,$par_estado=null) {
		
		$select = $this->tableGateway->getSql ()->select ();
		$condiciones = array('sec_id'=>$sec_id);
		if(!is_null($par_estado)){
			$condiciones['par_estado']=$par_estado;	
		}
		$select-> where ( $condiciones );

		$resultSet = $this->tableGateway->selectWith ( $select );
		
		return $resultSet;
		
	}	

	public function traerOcupadosPorSectorJSON($sec_id) {

		$adapter = $this->tableGateway->getAdapter();
		$query = "
		select 	up.par_id, 
				TIME_FORMAT(max(up.hora_salida),'%H:%i') as salida, 
				up.aut_placa, 
				up.par_estado,
				up.log_par_horas_parqueo as horas,
				TIMESTAMPDIFF(MINUTE,NOW(),max(up.hora_salida)) AS falta
		from 
			(select lp.par_id, 
					aut_placa,
					(log_par_fecha_ingreso + INTERVAL log_par_horas_parqueo HOUR) AS hora_salida, 
					p.par_estado,
					lp.log_par_horas_parqueo
			FROM log_parqueadero AS lp 
			JOIN parqueadero AS p 
				ON lp.par_id=p.par_id and p.par_estado='O'
			WHERE log_par_fecha_ingreso > NOW() - INTERVAL 2 DAY 
				AND (log_par_fecha_ingreso + INTERVAL log_par_horas_parqueo HOUR) > NOW()
			ORDER BY 3 DESC ) AS up
		GROUP BY up.par_id;
		";
    	
    	$statement = $adapter->query($query);
    	$results = $statement->execute();

		$sectores = new \ArrayObject();
	
		$count=0;
		$jsonArray=array();

		foreach ($results as $row){

			$jsonArray[$count]['par_id']=$row['par_id'];
			$jsonArray[$count]['aut_placa']=$row['aut_placa'];
			$jsonArray[$count]['par_estado']=$row['par_estado'];
			$jsonArray[$count]['salida']=$row['salida'];
			$jsonArray[$count]['horas']=$row['horas'];
			$jsonArray[$count]['falta']=$row['falta'];

			$count++;
		}
		return json_encode($jsonArray);
	}		

	public function liberarParqueaderos() {
		$adapter = $this->tableGateway->getAdapter();
		$query = "
			UPDATE 	parqueadero SET par_estado = 'D',
					aut_placa = '', 
					par_fecha_ingreso = '0000-00-00 00:00:00',
					par_fecha_salida = '0000-00-00 00:00:00', 
					par_horas_parqueo = 0 
			WHERE par_id 
				NOT IN (
					SELECT lp.par_id 
					FROM log_parqueadero AS lp 
					WHERE log_par_fecha_ingreso > NOW() - INTERVAL 2 DAY 
					AND (log_par_fecha_ingreso + INTERVAL log_par_horas_parqueo HOUR) > NOW()
				) 
				AND par_estado = 'O'
		";
    	
    	$statement = $adapter->query($query);
    	$result = $statement->execute();

		return true;		
	}


	public function traerVaciosPorSectorJSON($sec_id) {

		$adapter = $this->tableGateway->getAdapter();
		/*$query = "
			SELECT * 
			FROM parqueadero
			WHERE par_id NOT 
			IN (

				SELECT up.par_id
				FROM (

					SELECT lp.par_id, aut_placa, (
					log_par_fecha_ingreso + INTERVAL log_par_horas_parqueo HOUR
					) AS hora_salida, p.par_estado, lp.log_par_horas_parqueo
					FROM log_parqueadero AS lp
					JOIN parqueadero AS p ON lp.par_id = p.par_id
						AND p.par_estado =  'O'
					WHERE log_par_fecha_ingreso > NOW( ) - INTERVAL 2 DAY 
					AND (
						log_par_fecha_ingreso + INTERVAL log_par_horas_parqueo HOUR
					) > NOW( ) 
					ORDER BY 3 DESC
				) AS up
				GROUP BY up.par_id
			)
			AND sec_id=$sec_id
		";*/

		$query = "
		SELECT p.par_id , if(o.par_id is not null, 'O', 'D') as par_estado, sec_id
			FROM parqueadero as p
			LEFT JOIN
			(
				SELECT up.par_id,'O'
				FROM (

					SELECT lp.par_id, aut_placa, (
					log_par_fecha_ingreso + INTERVAL log_par_horas_parqueo HOUR
					) AS hora_salida, p.par_estado, lp.log_par_horas_parqueo
					FROM log_parqueadero AS lp
					JOIN parqueadero AS p ON lp.par_id = p.par_id
						AND p.par_estado =  'O'
					WHERE log_par_fecha_ingreso > NOW( ) - INTERVAL 2 DAY 
					AND (
						log_par_fecha_ingreso + INTERVAL log_par_horas_parqueo HOUR
					) > NOW( ) 
					ORDER BY 3 DESC
				) AS up
				GROUP BY up.par_id
 			)   as o 
			ON o.par_id=p.par_id
			WHERE sec_id=$sec_id
		";
    	$statement = $adapter->query($query);
    	$results = $statement->execute();

		$sectores = new \ArrayObject();
	
		$count=0;
		$jsonArray=array();

		foreach ($results as $row){

			$jsonArray[$count]['par_id']=$row['par_id'];
			$jsonArray[$count]['par_estado']=$row['par_estado'];
			$jsonArray[$count]['sec_id']=$row['sec_id'];

			$count++;
		}

		return json_encode($jsonArray);

	}

	
	public function traerMultadosPorSectorJSON($sec_id) {

		$adapter = $this->tableGateway->getAdapter();
		$query = "
			SELECT m.mul_par_id, m.sec_id, m.par_id, m.aut_placa FROM 
			(SELECT i.inf_id, i.inf_fecha, mp.mul_par_id, i.sec_id, mp.par_id, mp.aut_placa 
			from multa_parqueadero as mp join infraccion as i 
			ON mp.inf_id=i.inf_id where mp.mul_par_estado='I' 
			and i.sec_id= $sec_id 
			order by i.inf_fecha DESC ) as m
			group by m.par_id
		";
    	
    	$statement = $adapter->query($query);
    	$results = $statement->execute();

		$sectores = new \ArrayObject();
	
		$count=0;
		$jsonArray=array();

		foreach ($results as $row){

			$jsonArray[$count]['par_id']=$row['par_id'];
			$jsonArray[$count]['aut_placa']=$row['aut_placa'];
			$jsonArray[$count]['mul_par_id']=$row['mul_par_id'];

			$count++;
		}

		return json_encode($jsonArray);

	}


	public function traerVaciosPorSector($sec_id) {
		
		$select = $this->tableGateway->getSql ()->select ();
		$select-> where ( array('sec_id'=>$sec_id, 'par_estado'=>'D') );
		
		$resultSet = $this->tableGateway->selectWith ( $select );
		return $resultSet;
		
	}		
	
	public function traer($par_id) {
		
		$par_id = $par_id;
		
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
		
		$id = $parqueadero->getPar_id();
		
		$data = array (
				'par_id' => $parqueadero->getPar_id(),
				'par_estado' => $parqueadero->getPar_estado(),
				'sec_id' => $parqueadero->getSec_id()
		);
		
		$this->tableGateway->insert ( $data );
	}
	
	public function actualizar(Parqueadero $parqueadero, $par_codigo) {
	
	    $id = $parqueadero->getPar_id();
	
	    $data = array (
	        'par_id' => $parqueadero->getPar_id(),
	        'par_estado' => $parqueadero->getPar_estado(),
	        'sec_id' => $parqueadero->getSec_id()
	    );
	
	    if (!empty ( $par_codigo ) && !is_null ( $par_codigo )) {
	        if ($this->traer ( $par_codigo )) {
	
	            $this->tableGateway->update ( $data, array ( 'par_id' => $par_codigo ) );
	
	        } else {
	            throw new \Exception ( 'No se encontro el id para actualizar' );
	        }
	    }
	}
	
	public function eliminar($id) {
		return $this->tableGateway->delete ( array (
				'par_id' => $id 
		) );
	}
	
}