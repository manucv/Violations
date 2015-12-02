<?php 	//Carga.php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Carga extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CLAVE PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '7',
						'id' => 'pun_rec_id',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO CODIGO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'car_valor',
				'options' => array (
						'label' => 'Valor de la Recarga: *'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'car_valor',
						'class' => 'form-control'
				)
		) );


		/* ********************************************
		 * CAMPO VALOR
		* ********************************************/
		
		$car_valor = new Select('car_valor');
		$car_valor->setLabel('Valor de la Recarga: *: ');
		$car_valor->setAttributes(array('class' => 'form-control'));
		$car_valor->setAttributes(array('id' => 'car_valor'));
		$car_valor->setEmptyOption('-- Seleccione --');
		$car_valor->setValueOptions(array(
				'10' => '$10.00',
				'20' => '$20.00',
				'30' => '$30.00',
				'40' => '$40.00',
				'50' => '$50.00',
				'60' => '$60.00',
		));
		$car_valor->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($car_valor);



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
