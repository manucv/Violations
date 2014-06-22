<?php
 
 namespace Application\Model\Dao;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Sql;
 use Application\Model\Entity\Rol;

 class RolDao implements InterfaceCrud
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
     
     public function traer($id){
     	
     	$id = (int)$id;
     	
     	$resulset = $this->tableGateway->select(array('rol_id' => $id));
     	$row = $resulset->current();
     	
     	return $row;
     }

     public function getRolesSelect()
     {
         $resultSet= $this->tableGateway->select();
         $result=array();
         foreach($resultSet as $rol){
            $result[$rol->getRol_id()]=$rol->getRol_descripcion();
         }
         return $result;
     }

    public function guardar(Rol $rol){
    	
    	$id= (int)$rol->getRol_id();

        $data=array(
        	'rol_id'=>$id,
        	'rol_descripcion'=>$rol->getRol_descripcion(),
        	'rol_estado'=> 'A'
        );

        if(empty($id) || is_null($id)){
           // $data=array_change_key_case($data,CASE_UPPER);
            $this->tableGateway->insert($data);
            return $this->tableGateway->getLastInsertValue();
            
        }else{
           // $data=array_change_key_case($data,CASE_UPPER);
            $this->tableGateway->update($data,array('rol_id' => $id));
            return $id;
        }
     }

 	public	function eliminar($id) {
		if ($this->traer ( $id )) {
			return $this->tableGateway->delete ( array (
					'rol_id' => $id 
			) );
		} else {
			throw new \Exception ( 'No se encontro el id para eliminar' );
		}
	}


     /* public function existeDescripcion($rol_descripcion,$rol_id=null){

        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from($this->tableGateway->table);
        $select->where(array('ROL_DESCRIPCION' => $rol_descripcion));
        if($rol_id != '' && !is_null($rol_id)){
            $select->where->notEqualTo('ROL_ID',$rol_id);
        }
        
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $count=0;
        foreach($results as $row){$count++; break;   }
        if($count){
            return 'false';   
        }
 
        return 'true'; 

     } */
 }