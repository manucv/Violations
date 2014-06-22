<?php

namespace Parametros\Form;

use Zend\Form\Form;

date_default_timezone_set('America/Guayaquil');

class Pais extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'pai_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '4',
						'id' => 'pai_id',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pai_nombre_es',
				'options' => array (
						'label' => 'Nombre en espa&ntilde;ol*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '120',
						'id' => 'pai_nombre_es',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO NOMBRE INGLES
		* ********************************************/
		
		$this->add ( array (
				'name' => 'pai_nombre_en',
				'options' => array (
						'label' => 'Nombre en ingl&eacute;s*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '120',
						'id' => 'pai_nombre_en',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO APELLIDO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pai_codigo_telefono',
				'options' => array (
						'label' => 'C&oacute;digo de Tel&eacute;fono*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '5',
						'id' => 'pai_codigo_telefono',
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