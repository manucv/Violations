<?php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Parqueadero extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CLAVE PRIMARIO
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
		 * CAMPO CODIGO PARQUEADERO
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
		 * CAMPO ESTADO
		* ********************************************/
		
		$par_estado = new Select('par_estado');
		$par_estado->setLabel('Estado*: ');
		$par_estado->setAttributes(array('class' => 'form-control'));
		$par_estado->setAttributes(array('id' => 'par_estado'));
		$par_estado->setEmptyOption('-- Seleccione --');
		$par_estado->setValueOptions(array(
				'D' => 'Disponible',
				'O' => 'Ocupado',
		));
		$par_estado->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($par_estado);
		
		
		/* ********************************************
		 * CAMPO SECTOR
		 * ********************************************/
		$sec_id = new Select('sec_id');
		$sec_id->setLabel('Sector*: ');
		$sec_id->setAttributes(array('class' => 'form-control'));
		$sec_id->setEmptyOption('-- Seleccione --');
		$sec_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($sec_id);
		
		
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