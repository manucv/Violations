<?php 
	//Consulta.php

	namespace Infraccion\Form;

	use Zend\Form\Form;
	use Zend\Form\Element\Select;

	date_default_timezone_set('America/Guayaquil');

	class Consulta extends Form {
		function __construct($name = null) {
			
			parent::__construct($name);
			
			$this->add ( array (
				'name' => 'placa',
				'options' => array (
						'label' => 'Placa:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '7',
						'id' => 'placa',
						'class' => 'form-control'
				)
			) );
		
		

			$this->add ( array (
				'name' => 'buscar',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Buscar Infracciones',
						'class' => 'btn btn-primary',
						'data-loading-text' => 'Loading...'
				)
			) );
		}
	}