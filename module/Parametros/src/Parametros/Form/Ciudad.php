<?php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Ciudad extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'ciu_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '11',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO ESTADO
		 * ********************************************/
		$est_id = new Select('est_id');
		$est_id->setLabel('Estado*: ');
		$est_id->setAttributes(array('class' => 'form-control'));
		$est_id->setEmptyOption('-- Seleccione --');
		$est_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($est_id);
		
		
		/* ********************************************
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'ciu_nombre_es',
				'options' => array (
						'label' => 'Nombre en espa&ntilde;ol*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'ciu_nombre_es',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO NOMBRE INGLES
		* ********************************************/
		
		$this->add ( array (
				'name' => 'ciu_nombre_en',
				'options' => array (
						'label' => 'Nombre en ingl&eacute;s*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'ciu_nombre_en',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO CODIGO DE TELEFONO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'ciu_codigo_telefono',
				'options' => array (
						'label' => 'C&oacute;digo de Tel&eacute;fono*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '5',
						'id' => 'ciu_codigo_telefono',
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