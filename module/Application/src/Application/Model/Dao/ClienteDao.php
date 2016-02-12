<?php
	//ClienteDao.php

namespace Application\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Application\Model\Entity\Cliente;
use Application\Model\Dao\InterfaceCrud;
use Application\Model\Entity\Usuario;

class ClienteDao implements InterfaceCrud {
	
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway){
    	$this->tableGateway = $tableGateway;
    }
    
    public function traerTodos(){
    	$select = $this->tableGateway->getSql ()->select ();
    	$select->join ( 'usuario', 'usuario.usu_id  = cliente.usu_id' );
    	$resultSet = $this->tableGateway->selectWith ( $select );
        return $resultSet;
    }
    
    public function traer($cli_id){
    	 
    	$cli_id = (int) $cli_id;
    	
    	$select = $this->tableGateway->getSql ()->select ();
        $select->columns(array('cli_id','usu_id','cli_saldo','cli_movil'));
    	$select->join ( 'usuario', 'usuario.usu_id  = cliente.usu_id' , array('usu_usuario','usu_email','usu_nombre','usu_apellido','usu_estado'));
    	$select->where (array('cli_id' => $cli_id));
    	$resultSet = $this->tableGateway->selectWith ( $select );
    	$row =  $resultSet->current();
    	
    	if(!$row){
    		throw new \Exception('No se encontro el ID del cliente');
    	}
    	
    	return $row;
    }
    
    public function guardar(Cliente $cliente){
    
    	$id = (int) $cliente->getCli_id();
    
    	$data = array(
			'usu_id' => $cliente->getUsu_id(),
            'cli_saldo' => $cliente->getCli_saldo(),
			'cli_foto' => $cliente->getCli_foto(),
            'cli_movil' => $cliente->getCli_movil(),
    	);
    	
    	$data ['cli_id'] = $id;
    	
    	if (!empty ( $id ) && !is_null ( $id )) {
    		if ($this->traer ( $id )) {
    	
    			$this->tableGateway->update ( $data, array ( 'cli_id' => $id ) );
    	
    		} else {
    			throw new \Exception ( 'No se encontro el id para actualizar' );
    		}
    	}else{
    		$this->tableGateway->insert ( $data );
            $id = $this->tableGateway->lastInsertValue;
    	}

        return $id;
    }
    
    public function verificar($usuario){    

            $sql = new Sql($this->tableGateway->getAdapter());
            $select = $sql->select();
            $select->from('usuario');
            $select->where            
                    ->equalTo('usu_email',$usuario['usu_email'])
                    ->or
                    ->equalTo('usu_usuario',$usuario['usu_usuario']);
            
            $statement = $sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();
            $count =  $results->count();

            return $count;
    }

	public function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'cli_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}

    public function buscarPorEmail($email,$passw){

        $resultSet = $this->tableGateway->select(array('usu_email' => $email, 'usu_clave'=>$passw));
        $row =  $resultSet->current();
        
        
        return $row;
    }

    public function buscarPorEmailOUsuario($email,$passw=NULL){
        
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from('usuario');
        $select->join('cliente','usuario.usu_id  = cliente.usu_id');
        $select->where->like('usu_email', $email);
        $select->where->or;
        $select->where->like('usu_usuario', $email);
        $select->where->or;
        $select->where->like('cli_movil', $email);
        if(!is_null($passw)){
            $select->where(array('usu_clave'=>$passw));
        }
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $cliente=null;
        foreach ($results as $row) {
            $cliente = new Cliente();    
            $cliente->exchangeArray($row);
        }

        return $cliente;
    }    

    public function debitar($cli_id, $valor=0) {
        if($cli_id){
            $cliente=$this->traer($cli_id);
            if($cliente){
                $cliente->setCli_saldo($cliente->getCli_saldo()-$valor);
                $data = $cliente->getArrayCopy();

                $data_cliente['cli_id']=$data['cli_id'];
                $data_cliente['usu_id']=$data['usu_id'];
                $data_cliente['cli_saldo']=$data['cli_saldo'];
                $data_cliente['cli_foto']=$data['cli_foto'];
                $data_cliente['cli_cod_pais']=$data['cli_cod_pais'];
                $data_cliente['cli_cod_ciudad']=$data['cli_cod_ciudad'];
                $data_cliente['cli_direccion']=$data['cli_direccion'];
                $data_cliente['cli_movil']=$data['cli_movil'];

                $this->tableGateway->update ( $data_cliente, array ( 'cli_id' => $cliente->getCli_id() ) );
                return $cliente;
            }
        }
    }    
    public function acreditar($cli_id, $valor=0) {
        if($cli_id){
            $cliente=$this->traer($cli_id);
            if($cliente){
                $cliente->setCli_saldo($cliente->getCli_saldo()+$valor);
                $data = $cliente->getArrayCopy();

                $data_cliente['cli_id']=$data['cli_id'];
                $data_cliente['usu_id']=$data['usu_id'];
                $data_cliente['cli_saldo']=$data['cli_saldo'];
                $data_cliente['cli_foto']=$data['cli_foto'];
                $data_cliente['cli_cod_pais']=$data['cli_cod_pais'];
                $data_cliente['cli_cod_ciudad']=$data['cli_cod_ciudad'];
                $data_cliente['cli_direccion']=$data['cli_direccion'];
                $data_cliente['cli_movil']=$data['cli_movil'];

                $this->tableGateway->update ( $data_cliente, array ( 'cli_id' => $cliente->getCli_id() ) );
                return $cliente;
            }
        }

    }    
    
}