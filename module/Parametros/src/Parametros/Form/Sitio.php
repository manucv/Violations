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
		
		$this->add ( array (
				'name' => 'sit_estado',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '1',
						'id' => 'sit_estado',
						'class' => 'form-control',
						'value' => 'I'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO SECTOR LATITUD
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sit_latitud',
				'options' => array (
						'label' => 'Latitud*:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'sit_latitud',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO SECTOR LONGITUD
		* ********************************************/
		
		$this->add ( array (
				'name' => 'sit_longitud',
				'options' => array (
						'label' => 'Longitud*:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'sit_longitud',
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