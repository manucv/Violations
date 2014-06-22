<?php

namespace Application\Form;

use Zend\Form\Form;

class Login extends Form {
	function __construct($name = null) {
		parent::__construct ( $name );
		
		$this->add ( array (
				'name' => 'usu_usuario',
				'options' => array (
						'label' => 'Usuario: ' 
				),
				'attributes' => array (
						'type' => 'text',
						'maxlenght' => '255',
						'id' => 'usu_usuario',
						'class' => 'form-control' 
				) 
		) );
		
		$this->add(array(
				'name' => 'usu_clave',
				'options' => array (
						'label' => 'Contrase&ntilde;a: '
				),
				'attributes' => array (
						'type' => 'password',
						'maxlenght' => '128',
						'id' => 'usu_clave',
						'class' => 'form-control'
				)
		));
		
		$this->add ( array (
				'name' => 'ingresar',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Ingresar al sistema',
						'class' => 'btn btn-primary' 
				) 
		) );
	}
}