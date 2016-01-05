<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Soap\Client as SoapClient;

use Application\Model\Entity\Infraccion;
use Application\Model\Entity\MultaParqueadero;
use Application\Model\Dao\InterfaceCrud;

class InfraccionDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join('usuario', 'usuario.usu_id = infraccion.usu_id');
    	$select->join('tipo_infraccion', 'tipo_infraccion.tip_inf_id = infraccion.tip_inf_id');
    	$select->join('sector', 'sector.sec_id = infraccion.sec_id');
    	$select->join('ciudad', 'ciudad.ciu_id = sector.ciu_id');
    	$select->join('estado', 'estado.est_id = ciudad.est_id');
    	$select->join('pais', 'pais.pai_id = estado.pai_id');
        $select->join('multa_parqueadero', 'infraccion.inf_id = multa_parqueadero.inf_id');
        $select->where (array('inf_estado' => 'R'));
        $select->order('infraccion.inf_id DESC');
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($inf_id){
    	 
    	$inf_id = (int) $inf_id;
    	 
    	$select = $this->tableGateway->getSql ()->select ();
        $select->join('tipo_infraccion', 'tipo_infraccion.tip_inf_id = infraccion.tip_inf_id');
        $select->where (array('inf_id' => $inf_id));
        $resultSet = $this->tableGateway->selectWith ( $select );

    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la infraccion');
    	}
    	
    	return $row;
    }
    
    public function guardar(Infraccion $infraccion){
    
    	$id = (int) $infraccion->getInf_id();
    
    	$data = array(
    			'inf_fecha' => $infraccion->getInf_fecha(),
    			'inf_detalles' => $infraccion->getInf_detalles(),
    			'usu_id' => $infraccion->getUsu_id(),
    			'tip_inf_id' => $infraccion->getTip_inf_id(),
    			'sec_id' => $infraccion->getSec_id(),
                'inf_latitud' => $infraccion->getInf_latitud(),
                'inf_longitud' => $infraccion->getInf_longitud(),
                'inf_estado' => $infraccion->getInf_estado()
    	);
    	
    	$data ['inf_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'inf_id' => $id ) );
    	       return $id;
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
            return $this->tableGateway->lastInsertValue;
    	}
    }
    
	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'inf_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}

    public function asentarInfraccionMunicipio( $data){
        
        
        
        $url = 'http://localhost/Violations/sismert/confirmar.php';
        
        $url .= '?' . http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;

    }

    public function consultarInfraccionMunicipio($data){
        
        $url = 'http://localhost/Violations/sismert/infracciones.php';
        
        $url .= '?' . http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;

    }

    public function traerPorTipo($fecha_ini, $fecha_fin){
        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT tip_inf_codigo, tip_inf_descripcion, count(inf_id) as total 
                FROM `infraccion` AS i right 
                JOIN tipo_infraccion AS t 
                    ON t.tip_inf_id=i.tip_inf_id ";

        if($fecha_ini!='' || $fecha_fin!='')                    
            $query .= " WHERE ";
        if($fecha_ini!='')            
            $query .= " i.inf_fecha >= '$fecha_ini 00:00:00' ";
        if($fecha_ini!='' && $fecha_fin!='')
            $query .= " AND ";    
        if($fecha_fin!='')            
            $query .= " i.inf_fecha <= '$fecha_fin 23:59:59' ";

        $query .= " GROUP BY t.tip_inf_id
                ORDER BY tip_inf_codigo ASC
        ";
        


        $statement = $adapter->query($query);
        $results = $statement->execute();

        return $results;
    }

    public function traerPorVigilante($fecha_ini, $fecha_fin){
        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT usu_nombre, usu_apellido, count(inf_id) as total 
                FROM `infraccion` AS i 
                JOIN usuario AS u 
                    ON u.usu_id=i.usu_id ";

        if($fecha_ini!='' || $fecha_fin!='')                    
            $query .= " WHERE ";
        if($fecha_ini!='')            
            $query .= " i.inf_fecha >= '$fecha_ini 00:00:00' ";
        if($fecha_ini!='' && $fecha_fin!='')
            $query .= " AND ";    
        if($fecha_fin!='')            
            $query .= " i.inf_fecha <= '$fecha_fin 23:59:59' ";

        $query .= " GROUP BY u.usu_id
                ORDER BY usu_nombre ASC
        ";
        
        $statement = $adapter->query($query);
        $results = $statement->execute();

        return $results;
    }

    public function traerPorCalle($fecha_ini, $fecha_fin){
        $adapter = $this->tableGateway->getAdapter();
        $query = "
            SELECT cal_nombre, count(i.inf_id) as total 
                FROM `infraccion` AS i 
                JOIN multa_parqueadero AS m 
                    ON m.inf_id=i.inf_id 
                JOIN parqueadero AS p 
                    ON m.par_id=p.par_id     
                JOIN calle AS c 
                    ON p.par_cal_principal=c.cal_id ";                      
        
        if($fecha_ini!='' || $fecha_fin!='')                    
            $query .= " WHERE ";
        if($fecha_ini!='')            
            $query .= " i.inf_fecha >= '$fecha_ini 00:00:00' ";
        if($fecha_ini!='' && $fecha_fin!='')
            $query .= " AND ";    
        if($fecha_fin!='')            
            $query .= " i.inf_fecha <= '$fecha_fin 23:59:59' ";

        $query .= " GROUP BY p.par_cal_principal
                ORDER BY cal_nombre ASC
        ";
        
        $statement = $adapter->query($query);
        $results = $statement->execute();

        return $results;
    }

    public function getNext( $id ){
        if (!empty ( $id ) && !is_null ( $id )) {
            $adapter = $this->tableGateway->getAdapter();
            $query = "SELECT * FROM `infraccion` WHERE inf_id = (SELECT min(inf_id) FROM `infraccion` WHERE inf_id > $id AND inf_estado = 'R')";
            $statement = $adapter->query($query);
            $results = $statement->execute();
            $row = $results->current();
            return $row['inf_id'];
        }
        return false;
    }

    public function getPrevious( $id ){
        if (!empty ( $id ) && !is_null ( $id )) {
            $adapter = $this->tableGateway->getAdapter();
            $query = "SELECT * FROM `infraccion` WHERE inf_id = (SELECT max(inf_id) FROM `infraccion` WHERE inf_id < $id AND inf_estado = 'R')";
            $statement = $adapter->query($query);
            $results = $statement->execute();
            $row = $results->current();
            return $row['inf_id'];
        }
        return false;
    }

}