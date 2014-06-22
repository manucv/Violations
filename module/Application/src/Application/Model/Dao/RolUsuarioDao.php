<?php
 
 namespace Application\Model\Dao;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Sql;
 use Application\Model\Entity\RolUsuario;
 
 class RolUsuarioDao
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function traerTodos()
     {
         return $this->tableGateway->select();
     }

    public function guardar(RolUsuario $rolUsuario){

        $data=array(
            'usu_id'=>$rolUsuario->getUsu_id(),
            'rol_id'=>$rolUsuario->getRol_id(),
        );

        $this->tableGateway->insert($data);        
     }

     public function eliminarPorUsuario($usu_id){
     	
		$usu_id = (int) $usu_id;
     	$this->tableGateway->delete(array('usu_id' => $usu_id));
     	
     }

     public function traerPorUsCodigo($usu_id)
     {
        $resultSet = $this->tableGateway->select(array('usu_id'=>$usu_id));
        $row=$resultSet->current();
        return $row;
     }
     
 	public function rolPorCodigo($codigo)
     {
         $resultSet = $this->tableGateway->select(array('usu_id'=>$codigo))->current();

         return $resultSet;
     }
     
 }