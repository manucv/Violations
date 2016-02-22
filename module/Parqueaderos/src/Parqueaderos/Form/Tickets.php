<?php 
	//Tickets.php

	namespace Parqueaderos\Form;

	use Zend\Form\Form;
	use Zend\Form\Element\Select;

	date_default_timezone_set('America/Guayaquil');

	class Tickets extends Form {
		function __construct($name = null) {
			
			parent::__construct($name);
			
			$this->add ( array (
				'name' => 'nro_ticket',
				'options' => array (
						'label' => 'Nro. Ticket:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'nro_ticket',
						'class' => 'form-control'
				)
			) );
		
		

			$this->add ( array (
				'name' => 'buscar',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Buscar Ticket',
						'class' => 'btn btn-primary',
						'data-loading-text' => 'Loading...'
				)
			) );
		}
	}