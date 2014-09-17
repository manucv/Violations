<?php
	//RelacionClienteDao.php
	
namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\RelacionCliente;
use Application\Model\Dao\InterfaceCrud;

class RelacionClienteDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }

    public function traerTodosPorCliente($cli_id){
        $select = $this->tableGateway->getSql ()->select ();
        $select-> join ('cliente','relacion_cliente.cli_id_relacionado=cliente.cli_id');
        $select-> where ( array('relacion_cliente.cli_id'=>$cli_id) );
        $resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    
    public function traer($rel_cli_id){
    	 
    	$rel_cli_id = (int) $rel_cli_id;
    	 
    	$resultSet = $this->tableGateway->select(array('rel_cli_id' => $rel_cli_id));
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID de la relación');
    	}
    	
    	return $row;
    }
    
    public function guardar(RelacionCliente $relacionCliente){
    
    	$id = (int) $relacionCliente->getRel_cli_id();
    
    	$data = array(
			'cli_id' => $relacionCliente->getCli_id(),	
			'cli_id_relacionado' => $relacionCliente->getCli_id_relacionado(),
			'rel_cli_hora' => $relacionCliente->getRel_cli_hora(),
			'rel_cli_tipo' => $relacionCliente->getRel_cli_tipo()
    	);
    	
    	$data ['rel_cli_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'rel_cli_id' => $id ) );
    	
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
					'rel_cli_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}
}	