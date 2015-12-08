<?php 	//Calle.php

// cal_id
// cal_codigo
// cal_nombre

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Calle extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CLAVE PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'cal_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '7',
						'id' => 'cal_id',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO CODIGO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'cal_codigo',
				'options' => array (
						'label' => 'Código*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '3',
						'id' => 'cal_codigo',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'cal_nombre',
				'options' => array (
						'label' => 'Nombre*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '45',
						'id' => 'cal_nombre',
						'class' => 'form-control'
				)
		) );		

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
