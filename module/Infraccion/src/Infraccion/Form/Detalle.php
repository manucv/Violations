<?php 	//Detalle.php

namespace Infraccion\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class Detalle extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		


		$this->add(array(
         	'type' => 'Zend\Form\Element\Select',
         	'name' => 'inmovilizado',
         	'options' => array(
                'label' => 'Inmovilizado:',
                'value_options' => array(
                    'f' => 'No',
                    't' => 'Si'
   				)
			),	
			'attributes' => array (
				'id' => 'pun_rec_habilitado',
				'class' => 'form-control'
			)
     	));

		$this->add(array(
         	'type' => 'Zend\Form\Element\Select',
         	'name' => 'tiempo_permanencia',
         	'options' => array(
                'label' => 'Tiempo Permanencia:',
                'value_options' => array(
                    '0' => 'No hubo permanencia',
                    '1' => '1 hora',
                    '2' => '2 horas',
                    '3' => '3 horas',
                    '4' => '4 horas',
                    '5' => '5 horas',
                    '6' => '6 horas',
                    '7' => '7 horas',
                    '8' => '8 horas'
				)
			),	
			'attributes' => array (
				'id' => 'pun_rec_habilitado',
				'class' => 'form-control'
			)
     	));
	

		$this->add ( array (
			'name' => 'buscar',
			'attributes' => array (
					'type' => 'submit',
					'value' => 'Aprobar Infracción',
					'class' => 'btn btn-primary',
					'data-loading-text' => 'Loading...'
			)
		) );
	}
}