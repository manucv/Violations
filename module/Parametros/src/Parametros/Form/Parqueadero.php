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
				'name' => 'par_codigo',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '7',
						'id' => 'par_codigo',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO CODIGO PARQUEADERO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'par_id',
				'options' => array (
						'label' => 'N&uacute;mero/C&oacute;digo de Parqueadero*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '10',
						'id' => 'par_id',
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
		 * CAMPO TIPO
		* ********************************************/
		
		$par_tipo = new Select('par_tipo');
		$par_tipo->setLabel('Tipo*: ');
		$par_tipo->setAttributes(array('class' => 'form-control'));
		$par_tipo->setAttributes(array('id' => 'par_tipo'));
		$par_tipo->setEmptyOption('-- Seleccione --');
		$par_tipo->setValueOptions(array(
				'N' => 'Automovil',
				'D' => 'Capacidades Especiales',
				'E' => 'Mujeres Embarazadas',
				'M' => 'Motos',
				'B' => 'Biciletas',
		));
		$par_tipo->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($par_tipo);		
		
		
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
		
		/* ********************************************
		 * CAMPO PARQUEADERO LATITUD
		* ********************************************/
		
		$this->add ( array (
				'name' => 'par_latitud',
				'options' => array (
						'label' => 'Latitud*:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'par_latitud',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO PARQUEADERO LONGITUD
		* ********************************************/
		
		$this->add ( array (
				'name' => 'par_longitud',
				'options' => array (
						'label' => 'Longitud*:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'par_longitud',
						'class' => 'form-control'
				)
		) );


		/* ********************************************
		 * CAMPO CALLE PRINCIPAL
		* ********************************************/
		
		$par_estado = new Select('par_cal_principal');
		$par_estado->setLabel('Calle Principal: ');
		$par_estado->setAttributes(array('class' => 'form-control'));
		$par_estado->setAttributes(array('id' => 'par_cal_principal'));
		$par_estado->setEmptyOption('-- Seleccione --');

		$par_estado->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($par_estado);

		/* ********************************************
		 * CAMPO CALLE SECUNDARIA
		* ********************************************/
		
		$par_estado = new Select('par_cal_secundaria');
		$par_estado->setLabel('Calle Secundaria: ');
		$par_estado->setAttributes(array('class' => 'form-control'));
		$par_estado->setAttributes(array('id' => 'par_cal_secundaria'));
		$par_estado->setEmptyOption('-- Seleccione --');

		$par_estado->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($par_estado);		



		
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