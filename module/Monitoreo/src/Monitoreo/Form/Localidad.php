<?php

namespace Monitoreo\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class Localidad extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO PAIS
		* ********************************************/
		$pai_id = new Select('pai_id');
		$pai_id->setLabel('Pa&iacute;s*: ');
		$pai_id->setAttribute('id', 'pai_id');
		$pai_id->setAttributes(array('class' => 'form-control'));
		$pai_id->setEmptyOption('-- Seleccione --');
		$pai_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($pai_id);
		
		
		$this->add ( array (
				'name' => 'pai_id_hidden',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '11',
						'id' => 'pai_id_hidden',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO ESTADO
		* ********************************************/
		$est_id = new Select('est_id');
		$est_id->setLabel('Estado*: ');
		$est_id->setAttribute('id', 'est_id');
		$est_id->setAttributes(array('class' => 'form-control'));
		$est_id->setEmptyOption('-- Seleccione --');
		$est_id->setOptions(array(
				'disable_inarray_validator' => true, // <-- disable
		));
		$this->add($est_id);
		
		
		$this->add ( array (
				'name' => 'est_id_hidden',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '11',
						'id' => 'est_id_hidden',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO CIUDAD
		 * ********************************************/
		$ciu_id = new Select('ciu_id');
		$ciu_id->setLabel('Ciudad*: ');
		$ciu_id->setAttribute('id', 'ciu_id');
		$ciu_id->setAttributes(array('class' => 'form-control'));
		$ciu_id->setEmptyOption('-- Seleccione --');
		$ciu_id->setOptions(array(
				'disable_inarray_validator' => true, // <-- disable
		));
		$this->add($ciu_id);
		
		
		$this->add ( array (
				'name' => 'ciu_id_hidden',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '11',
						'id' => 'ciu_id_hidden',
						'class' => 'form-control'
				)
		) );
		
		
		//BOTON DE SUBMIT
		$this->add ( array (
				'name' => 'ingresar',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Buscar',
						'class' => 'btn btn-primary',
						'data-loading-text' => 'Loading...',
						'id' => 'id_buscar_sitio'
				)
		) );
		
	}
}