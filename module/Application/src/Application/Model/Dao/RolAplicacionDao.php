<?php
 
 namespace Application\Model\Dao;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Sql;
 use Application\Model\Entity\RolAplicacion;

 class RolAplicacionDao
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function traerTodos()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }
     
     public function traerPorRol($rol_id){
     	
     	$rol_id = (int) $rol_id;
     	return $this->tableGateway->select(array('rol_id' => $rol_id));
     	
     }

    public function guardar(RolAplicacion $rolAplicacion){

        $data=array(
            'rol_id'=>$rolAplicacion->getRol_id(),
            'apl_id'=>$rolAplicacion->getApl_id(),
        );

        $this->tableGateway->insert($data);        
     }

    public function eliminarPorRol($rol_id){
    	$rol_id = (int) $rol_id;
    	$this->tableGateway->delete(array('rol_id' => $rol_id));
     }
     /*
     public function traerPorRolArreglo($rol_id)
     {
        $resultSet = $this->tableGateway->select(array('ROL_ID'=>$rol_id));
        $result_array=array();
        foreach($resultSet  as $apl){
            $result_array[$apl->getApl_id()]=$apl->getApl_id();
        }
        return $result_array;
     } */
 }