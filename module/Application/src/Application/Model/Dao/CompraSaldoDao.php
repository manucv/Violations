<?php
	//CompraSaldoDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\CompraSaldo;
use Application\Model\Dao\InterfaceCrud;

class CompraSaldoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($com_sal_id){
    	 
    	$com_sal_id = (int) $com_sal_id;
    	 
    	$resultSet = $this->tableGateway->select(array('com_sal_id' => $com_sal_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la ciudad');
    	}
    	
    	return $row;
    }
    
    public function traerRecargasPorUsuario($cli_id){
        
        $select = $this->tableGateway->getSql ()->select ();
        $select-> join ('punto_recarga','punto_recarga.pun_rec_id = compra_saldo.punto_recarga_pun_rec_id');
        $select-> where ( array('compra_saldo.cli_id'=>$cli_id) );
        $resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }

    public function traerRecargasPorUsuarioJSON($cli_id){
        
        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT *
            FROM compra_saldo as c join punto_recarga as p
            ON c.punto_recarga_pun_rec_id = p.pun_rec_id
            WHERE cli_id = $cli_id
        ";
        
        $statement = $adapter->query($query);
        $results = $statement->execute();


        $sectores = new \ArrayObject();
    
        $count=0;
        $jsonArray=array();

        foreach ($results as $row){
            $jsonArray[$count]['pun_rec_id']=$row['pun_rec_id'];
            $jsonArray[$count]['pun_rec_nombre']=$row['pun_rec_nombre'];
            $jsonArray[$count]['com_sal_valor']=$row['com_sal_valor'];
            $jsonArray[$count]['com_sal_hora']=$row['com_sal_hora'];


            $count++;
        }

        return json_encode($jsonArray);    

    }    
    
    public function guardar(CompraSaldo $compraSaldo){
    
    	$id = (int) $compraSaldo->getCom_sal_id();
    
    	$data = array(
			'cli_id' => $compraSaldo->getCli_id(),
			'punto_recarga_pun_rec_id' => $compraSaldo->getPunto_recarga_pun_rec_id(),
			'com_sal_valor' => $compraSaldo->getCom_sal_valor(),
			'com_sal_hora' => $compraSaldo->getCom_sal_hora()
    	);
    	
    	$data ['com_sal_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'com_sal_id' => $id ) );
    	
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
    	}
    }

    public function traerPorPuntoRecarga($pun_rec_id){

        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT * 
            FROM compra_saldo as cs 
                JOIN cliente as c ON cs.cli_id = c.cli_id
                JOIN usuario as u ON u.usu_id = c.usu_id 

            WHERE punto_recarga_pun_rec_id = '$pun_rec_id'
        ";
        
        $statement = $adapter->query($query);
        $results = $statement->execute();

        return $results;
    }
    
	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'com_sal_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
}	