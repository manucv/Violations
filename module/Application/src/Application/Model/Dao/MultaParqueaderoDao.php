<?php
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\MultaParqueadero;
use Application\Model\Dao\InterfaceCrud;

class MultaParqueaderoDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($mul_par_id){
    	 
    	$mul_par_id = (int) $mul_par_id;
    	 
    	$resultSet = $this->tableGateway->select(array('mul_par_id' => $mul_par_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la multa parqueadero');
    	}
    	
    	return $row;
    }

    public function traerPorInfraccion($inf_id=null){
        $select = $this->tableGateway->getSql ()->select ();
        $select->join ( 'infraccion', 'multa_parqueadero.inf_id  = infraccion.inf_id' );
       //select->join ( 'parqueadero', 'multa_parqueadero.par_id  = parqueadero.par_id' );
        if(!is_null($inf_id)){
            $select->where ( array('multa_parqueadero.inf_id'=>$inf_id) );
            
        }     

        $resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet->current();
    }
    
    public function guardar(MultaParqueadero $multaParqueadero){

    	$id = (int) $multaParqueadero->getMul_par_id();

    	$data = array(
    			'par_id' => $multaParqueadero->getPar_id(),
    			'aut_placa' => $multaParqueadero->getAut_placa(),
    			'inf_id' => $multaParqueadero->getInf_id(),
    			'mul_par_estado' => $multaParqueadero->getMul_par_estado(),
    			'mul_par_valor' => $multaParqueadero->getMul_par_valor(),
                'mul_par_imagen' => $multaParqueadero->getMul_par_imagen(),
                'mul_par_prueba_1' => $multaParqueadero->getMul_par_prueba_1(),
                'mul_par_prueba_2' => $multaParqueadero->getMul_par_prueba_2(),
                'mul_par_prueba_3' => $multaParqueadero->getMul_par_prueba_3()
    	);

    	$data ['mul_par_id'] = $id;

    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'mul_par_id' => $id ) );
    	
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
					'mul_par_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
}