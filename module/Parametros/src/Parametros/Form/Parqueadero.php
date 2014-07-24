<?php

namespace Parametros\Form;

use Zend\Form\Form;

date_default_timezone_set('America/Guayaquil');

class Parqueadero extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'par_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '11',
						'id' => 'par_id',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'par_codigo',
				'options' => array (
						'label' => 'N&uacute;mero/C&oacute;digo de Parqueadero*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '10',
						'id' => 'par_codigo',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO NOMBRE INGLES
		* ********************************************/
		
		$this->add ( array (
				'name' => 'par_estado',
				'options' => array (
						'label' => 'Estado*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '1',
						'id' => 'par_estado',
						'class' => 'form-control',
						'value' => 'D'
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