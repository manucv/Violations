<?php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Estado extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'est_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '4',
						'id' => 'est_id',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO PAIS
		 * ********************************************/
		$pai_id = new Select('pai_id');
		$pai_id->setLabel('Pa&iacute;s*: ');
		$pai_id->setAttributes(array('id' => 'pai_id'));
		$pai_id->setAttributes(array('class' => 'form-control'));
		$pai_id->setEmptyOption('-- Seleccione --');
		$pai_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($pai_id);
		
		
		/* ********************************************
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'est_nombre_es',
				'options' => array (
						'label' => 'Nombre en espa&ntilde;ol*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'est_nombre_es',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO NOMBRE INGLES
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'est_nombre_en',
				'options' => array (
						'label' => 'Nombre en ingl&eacute;s*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'est_nombre_en',
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