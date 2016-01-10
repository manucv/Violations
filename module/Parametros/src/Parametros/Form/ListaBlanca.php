<?php
	//ListaBlanca.php

	//lis_bla_id
	//lis_bla_placa

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class ListaBlanca extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CLAVE PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'lis_bla_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '7',
						'id' => 'lis_bla_id',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO PLACA
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'lis_bla_placa',
				'options' => array (
						'label' => 'Placa*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '7',
						'id' => 'lis_bla_placa',
						'class' => 'form-control'
				)
		) );


		$this->add ( array (
				'name' => 'lis_bla_motivo',
				'options' => array (
						'label' => 'Motivo:'
				),
				'attributes' => array (
						'type' => 'textarea',
						'id' => 'lis_bla_motivo',
						'class' => 'form-control'
				)
		) );
		

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