<?php
	//PuntoRecargaDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Soap\Client as SoapClient;

use Application\Model\Entity\PuntoRecarga;
use Application\Model\Dao\InterfaceCrud;

class PuntoRecargaDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }

    public function traerTodosMunicipio(){
        
        $client = new SoapClient("http://ws.ibarra.gob.ec:8080/ServicioTest/ServicioWS?wsdl", 
                        array(  "soap_version" => SOAP_1_1, 'encoding' => 'iso-8859-1')
                    );
        $result = $client->consultarPuntoVenta(array('usuario'=>'SISMERTWSE','password'=>'Eb2Yhye3'));

        $resultSet = array();

        foreach($result->return as $punto ){
            $punto_recarga = $this->traerPorRuc($punto->cedula);
            if(!is_object($punto_recarga)){
                $punto_recarga = new PuntoRecarga();
                $punto_recarga->setPun_rec_ruc($punto->cedula);
                $punto_recarga->setPun_rec_nombres($punto->nombres);
                $punto_recarga->setPun_rec_apellidos($punto->apellidos);
                $punto_recarga->setPun_rec_nombre($punto->razonsocial);
                $punto_recarga->setPun_rec_email($punto->email);
                $punto_recarga->setPun_rec_direccion($punto->direccion.' y '.$punto->interseccion);   
                $pun_rec_id = $this->guardar($punto_recarga);
                $punto_recarga->setPun_rec_id($pun_rec_id);
            }
            $resultSet[]=$punto_recarga;
        }

        return $resultSet;
    }    
    
    public function traer($pun_rec_id){
    	 
    	$pun_rec_id = (int) $pun_rec_id;
    	 
    	$resultSet = $this->tableGateway->select(array('pun_rec_id' => $pun_rec_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del establecimiento');
    	}
    	
    	return $row;
    }

    public function traerPorRucClave($pun_rec_ruc, $pun_rec_clave){
        return $this->tableGateway->select(array('pun_rec_ruc' => $pun_rec_ruc, 'pun_rec_clave' => md5($pun_rec_clave)))->current();
    }    

    public function traerPorRuc($pun_rec_ruc){
        return $this->tableGateway->select(array('pun_rec_ruc' => $pun_rec_ruc))->current();
    }    

    public function guardar(PuntoRecarga $punto_recarga){
    
    	$id = (int) $punto_recarga->getPun_rec_id();
    
    	$data = array(
			'pun_rec_id' => $punto_recarga->getPun_rec_id(),
			'pun_rec_nombre' => $punto_recarga->getPun_rec_nombre(),
			'pun_rec_ruc' => $punto_recarga->getPun_rec_ruc(),
			'pun_rec_lat' => $punto_recarga->getPun_rec_lat(),
			'pun_rec_lng' => $punto_recarga->getPun_rec_lng(),
			'pun_rec_direccion' => $punto_recarga->getPun_rec_direccion(),
            'pun_rec_nombres' => $punto_recarga->getPun_rec_nombres(),
            'pun_rec_email' => $punto_recarga->getPun_rec_email(),
            'pun_rec_apellidos' => $punto_recarga->getPun_rec_apellidos()
    	);
    	
    	$data ['pun_rec_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    			$this->tableGateway->update ( $data, array ( 'pun_rec_id' => $id ) );
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
            $id = $this->tableGateway->lastInsertValue;
    	}
        return $id; 

    }
    
    public function actualizar(PuntoRecarga $punto_recarga, $pun_rec_id) {
    
        $id = $punto_recarga->getPun_rec_id();
    
        $data = array (
            'pun_rec_id' => $punto_recarga->getPun_rec_id(),
            'pun_rec_nombre' => $punto_recarga->getPun_rec_nombre(),
            'pun_rec_ruc' => $punto_recarga->getPun_rec_ruc(),
            'pun_rec_direccion' => $punto_recarga->getPun_rec_direccion(),
            'pun_rec_observaciones' => $punto_recarga->getPun_rec_observaciones(),
            'pun_rec_habilitado' => $punto_recarga->getPun_rec_habilitado(),
            'pun_rec_nombres' => $punto_recarga->getPun_rec_nombres(),
            'pun_rec_email' => $punto_recarga->getPun_rec_email(),
            'pun_rec_apellidos' => $punto_recarga->getPun_rec_apellidos()
        );

        if($punto_recarga->getPun_rec_clave()!='')
            $data['pun_rec_clave'] = md5($punto_recarga->getPun_rec_clave());

        if($punto_recarga->getPun_rec_lat()!='')
            $data['pun_rec_lat'] = $punto_recarga->getPun_rec_lat();

        if($punto_recarga->getPun_rec_lng()!='')
            $data['pun_rec_lng'] = $punto_recarga->getPun_rec_lng();
    
        if (!empty ( $pun_rec_id ) && !is_null ( $pun_rec_id )) {
            if ($this->traer ( $pun_rec_id )) {
    
                $this->tableGateway->update ( $data, array ( 'pun_rec_id' => $pun_rec_id ) );
    
            } else {
                throw new \Exception ( 'No se encontro el id para actualizar' );
            }
        }
    }

	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'pun_rec_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
    
}