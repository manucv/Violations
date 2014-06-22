<?php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Sitio extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sit_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '11',
						'id' => 'sit_id',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO CIUDAD
		* ********************************************/
		$ciu_id = new Select('ciu_id');
		$ciu_id->setLabel('Ciudad*: ');
		$ciu_id->setAttributes(array('id' => 'ciu_id'));
		$ciu_id->setAttributes(array('class' => 'form-control'));
		$ciu_id->setEmptyOption('-- Seleccione --');
		$ciu_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($ciu_id);
		
		
		/* ********************************************
		 * CAMPO DESCRIPCION
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'sit_descripcion',
				'options' => array (
						'label' => 'Descripci&oacute;n*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '200',
						'id' => 'sit_descripcion',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO DIRECCION
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'sit_direccion',
				'options' => array (
						'label' => 'Direcci&oacute;n*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'sit_direccion',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO SECTOR
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sit_sector',
				'options' => array (
						'label' => 'Sector*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '50',
						'id' => 'sit_sector',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO NUMERO DE REFERENCIA
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sit_reference_number',
				'options' => array (
						'label' => 'N&uacute;mero de referencia*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '10',
						'id' => 'sit_reference_number',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO ESTADO
		* ********************************************/
		$sit_estado = new Select('sit_estado');
		$sit_estado->setLabel('Estado*: ');
		$sit_estado->setAttributes(array('id' => 'sit_estado'));
		$sit_estado->setAttributes(array('class' => 'form-control'));
		$sit_estado->setEmptyOption('-- Seleccione --');
		$sit_estado->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$sit_estado->setValueOptions(array(
			'A' => 'Activo',
			'I' => 'Inactivo'
		));
		$this->add($sit_estado);
		
		
		
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