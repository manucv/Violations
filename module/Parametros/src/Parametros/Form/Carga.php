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
				'name' => 'pun_rec_saldo',
				'options' => array (
						'label' => 'Valor de la Recarga:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'pun_rec_saldo',
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
