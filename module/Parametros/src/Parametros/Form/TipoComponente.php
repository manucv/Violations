<?php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class TipoComponente extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'tip_com_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '3',
						'id' => 'tip_com_id',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'tip_com_descripcion',
				'options' => array (
						'label' => 'Descripci&oacute;n*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'tip_com_descripcion',
						'class' => 'form-control'
				)
		) );
		
		
		//BOTON DE SUBMIT
		$this->add ( array (
				'name' => 'ingresar',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Ingresar',
						'class' => 'btn btn-primary',
						'data-loading-text' => 'Loading...'
				)
		) );
		
	}
}