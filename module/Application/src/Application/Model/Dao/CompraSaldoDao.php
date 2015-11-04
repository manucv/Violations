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
        
        $select = $this->tableGateway->getSql ()->select ();
        $select-> join ('punto_recarga','punto_recarga.pun_rec_id = compra_saldo.punto_recarga_pun_rec_id');
        $select-> where ( array('compra_saldo.cli_id'=>$cli_id) );
        $resultSet = $this->tableGateway->selectWith ( $select );

        print_r($resultSet);

        // $sectores = new \ArrayObject();
    
        // $count=0;
        // $jsonArray=array();

        // foreach ($results as $row){
        //     $jsonArray[$count]['tra_id']=$row['tra_id'];
        //     $jsonArray[$count]['par_id']=$row['par_id'];
        //     $jsonArray[$count]['aut_placa']=$row['aut_placa'];
        //     $jsonArray[$count]['hora_salida']=$row['hora_salida'];
        //     $jsonArray[$count]['log_par_horas_parqueo']=$row['log_par_horas_parqueo'];
        //     $jsonArray[$count]['falta']=$row['falta'];

        //     $count++;
        // }

        // return json_encode($jsonArray);      


        return $resultSet;
    }    
    
    public function guardar(CompraSaldo $compraSaldo){
    
    	$id = (int) $compraSaldo->getCom_sal_id();
    
    	$data = array(
			'cli_id' => $compraSaldo->getCli_id(),
			'pun_rec_id' => $compraSaldo->getPun_rec_id(),
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