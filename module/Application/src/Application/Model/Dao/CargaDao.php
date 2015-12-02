<?php //CargaDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Soap\Client as SoapClient;

use Application\Model\Entity\Carga;
use Application\Model\Entity\PuntoRecarga;
use Application\Model\Dao\InterfaceCrud;

class CargaDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($car_id){
    	 
    	$car_id = (int) $car_id;
    	 
    	$resultSet = $this->tableGateway->select(array('car_id' => $car_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la recarga');
    	}
    	
    	return $row;
    }


    public function traerPendientes(){
                 
        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT * 
            FROM carga AS c
            JOIN punto_recarga AS p ON c.pun_rec_id=p.pun_rec_id
            JOIN usuario AS u ON u.usu_id = c.usu_id
            WHERE car_estado='P'
        ";
        
        $statement = $adapter->query($query);
        $results = $statement->execute();

        return $results;
    }
    

    public function guardar(Carga $carga){
    	$id = (int) $carga->getCar_id();
    
    	$data = array(
			'pun_rec_id'=> $carga->getPun_rec_id(),
			'car_valor' => $carga->getCar_valor(),
            'usu_id'    => $_SESSION['Zend_Auth']['storage']->usu_id
    	);

        if($carga->getCar_estado())
    	   $data['car_estado'] = $carga->getCar_estado();

    	$data ['car_id'] = $id;

    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			$this->tableGateway->update ( $data, array ( 'car_id' => $id ) );
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
					'car_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}

    public function asentarCargaMunicipio(Carga $carga, PuntoRecarga $punto_recarga){
        
        $client = new SoapClient("http://ws.ibarra.gob.ec:8080/ServicioTest/ServicioWS?wsdl", 
                        array(  "soap_version" => SOAP_1_1, 'encoding' => 'iso-8859-1')
                    );


        $data=array(
            'usuario'=>'SISMERTWSE',
            'password'=>'Eb2Yhye3', 
            'cedulaCiudadano' => $punto_recarga->getPun_rec_ruc(),
            'nombreCiudadano' => $punto_recarga->getPun_rec_nombres().' '.$punto_recarga->getPun_rec_apellidos(),
            'direccion' => $punto_recarga->getPun_rec_direccion(),
            'valorTitulo' => $carga->getCar_valor(),
            'usuarioIngreso' => 'jjarrin'
            );

        $result = $client->ingresoPago($data);

        return $result->return;
    }   

    
}	