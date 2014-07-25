<?php
namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Sector extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CLAVE PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sec_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '11',
						'id' => 'sec_id',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO SECTOR NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'sec_nombre',
				'options' => array (
						'label' => 'Nombre del Sector*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '45',
						'id' => 'sec_nombre',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO SECTOR LATITUD
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sec_latitud',
				'options' => array (
						'label' => 'Latitud*:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'sec_latitud',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO SECTOR LONGITUD
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sec_longitud',
				'options' => array (
						'label' => 'Longitud*:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'sec_longitud',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO CIUDAD
		 * ********************************************/
		$ciu_id = new Select('ciu_id');
		$ciu_id->setLabel('Ciudad*: ');
		$ciu_id->setAttributes(array('class' => 'form-control'));
		$ciu_id->setEmptyOption('-- Seleccione --');
		$ciu_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($ciu_id);
		
		
		/* ********************************************
		 * CAMPO UBICACION
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sec_ubicacion',
				'options' => array (
						'label' => 'Ubicaci&oacute;n*:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'sec_ubicacion',
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