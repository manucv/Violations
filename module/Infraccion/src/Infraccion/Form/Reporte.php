<?php 	//Reporte.php

namespace Infraccion\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Reporte extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		$this->add ( array (
				'name' => 'fecha_ini',
				'options' => array (
						'label' => 'Fecha de Inicio:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '10',
						'id' => 'fecha_ini',
						'class' => 'form-control'
				)
		) );
		
		$this->add ( array (
				'name' => 'fecha_fin',
				'options' => array (
						'label' => 'Fecha de Fin:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '10',
						'id' => 'fecha_fin',
						'class' => 'form-control'
				)
		) );

		$this->add ( array (
				'name' => 'buscar',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Buscar',
						'class' => 'btn btn-primary',
						'data-loading-text' => 'Loading...'
				)
		) );
		

	}
}