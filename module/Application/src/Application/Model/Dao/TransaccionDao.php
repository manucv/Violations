<?php
	//TransaccionDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Transaccion;
use Application\Model\Dao\InterfaceCrud;

class TransaccionDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($tra_id){
    	 
    	$tra_id = (int) $tra_id;
    	 
    	$resultSet = $this->tableGateway->select(array('tra_id' => $tra_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del establecimiento');
    	}
    	
    	return $row;
    }
    
    /*public function traerPorCliente($cli_id){
        $select = $this->tableGateway->getSql()->select ();

        $select-> where ( array('cli_id'=>$cli_id) );
        $resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }*/

    public function traerPorClienteJSON($cli_id){
        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT 
                t.tra_id,
                t.est_id as establecimiento_id,
                cli_id,
                tra_valor,
                tra_tipo,
                tra_saldo,
                tra_descripcion,
                tra_hora,
                log_par_id,
                log_par_fecha_ingreso,
                log_par_horas_parqueo,
                p.par_id,
                aut_placa,
                s.sec_id,
                sec_nombre,
                c.ciu_id,
                e.est_id,
                ciu_nombre_es as ciu_nombre,
                pai.pai_id,
                est_nombre_es as est_nombre,
                pai_nombre_es as pai_nombre
            FROM transaccion AS t
            JOIN log_parqueadero AS l ON l.tra_id=t.tra_id
            JOIN parqueadero AS p ON p.par_id = l.par_id
            JOIN sector AS s ON p.sec_id=s.sec_id
            JOIN ciudad AS c ON s.ciu_id=c.ciu_id
            JOIN estado AS e ON c.est_id=e.est_id
            JOIN pais AS pai ON e.pai_id=pai.pai_id
            WHERE t.cli_id=$cli_id
        ";

        $statement = $adapter->query($query);
        $results = $statement->execute();

        $sectores = new \ArrayObject();
    
        $count=0;
        $jsonArray=array();

        foreach ($results as $row){

            $jsonArray[$count]['tra_id']=$row['tra_id'];
            $jsonArray[$count]['establecimiento_id']=$row['establecimiento_id'];
            $jsonArray[$count]['cli_id']=$row['cli_id'];
            $jsonArray[$count]['tra_valor']=$row['tra_valor'];
            $jsonArray[$count]['tra_tipo']=$row['tra_tipo'];
            $jsonArray[$count]['tra_saldo']=$row['tra_saldo'];
            $jsonArray[$count]['tra_descripcion']=$row['tra_descripcion'];
            $jsonArray[$count]['tra_hora']=$row['tra_hora'];
            $jsonArray[$count]['log_par_id']=$row['log_par_id'];
            $jsonArray[$count]['log_par_fecha_ingreso']=$row['log_par_fecha_ingreso'];
            $jsonArray[$count]['log_par_horas_parqueo']=$row['log_par_horas_parqueo'];
            $jsonArray[$count]['par_id']=$row['par_id'];
            $jsonArray[$count]['aut_placa']=$row['aut_placa'];
            $jsonArray[$count]['sec_id']=$row['sec_id'];
            $jsonArray[$count]['sec_nombre']=$row['sec_nombre'];
            $jsonArray[$count]['ciu_id']=$row['ciu_id'];
            $jsonArray[$count]['est_id']=$row['est_id'];
            $jsonArray[$count]['ciu_nombre']=$row['ciu_nombre'];
            $jsonArray[$count]['pai_id']=$row['pai_id'];
            $jsonArray[$count]['est_nombre']=$row['est_nombre'];
            $jsonArray[$count]['pai_nombre']=$row['pai_nombre'];

            $count++;
        }

        return json_encode($jsonArray);
        return $results;
    }

        

    public function guardar(Transaccion $transaccion){
    
    	$id = (int) $transaccion->getTra_id();
    
    	$data = array(
    		'est_id' => $transaccion->getEst_id(),
    		'cli_id' => $transaccion->getCli_id(),
			'tra_valor' => $transaccion->getTra_valor(),
			'tra_tipo' => $transaccion->getTra_tipo(),
            'tra_descripcion' => $transaccion->getTra_descripcion(),
            'tra_saldo' => $transaccion->getTra_saldo(),
            'tra_hora' => $transaccion->getTra_hora()
    	);
    	
    	$data ['tra_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			$this->tableGateway->update ( $data, array ( 'tra_id' => $id ) );
    	
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
            $id = $this->tableGateway->lastInsertValue;
    	}

        return $id;
    }
    
	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'tra_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
}