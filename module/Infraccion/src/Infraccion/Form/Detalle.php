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
                    '60' => '1 hora',
                    '120' => '2 horas',
                    '180' => '3 horas',
                    '240' => '4 horas',
                    '300' => '5 horas',
                    '360' => '6 horas',
                    '420' => '7 horas',
                    '480' => '8 horas'
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