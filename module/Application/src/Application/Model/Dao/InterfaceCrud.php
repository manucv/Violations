<?php

namespace Application\Model\Dao;

use Zend\Form\Annotation\Object;
interface InterfaceCrud {
	
	public function traerTodos();
    public function traer($id);
    public function eliminar($id);

}