<?php
	//PuntoRecarga.php

	// pun_rec_id
	// pun_rec_nombre
	// pun_rec_ruc
	// pun_rec_codigo
	// pun_rec_lat
	// pun_rec_lng
	// pun_rec_direccion
	// pun_rec_observaciones

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

date_default_timezone_set('America/Guayaquil');

class PuntoRecarga extends Form {
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
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_nombre',
				'options' => array (
						'label' => 'Nombre:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '10',
						'id' => 'pun_rec_nombre',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO RUC
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_ruc',
				'options' => array (
						'label' => 'RUC:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '13',
						'id' => 'pun_rec_ruc',
						'class' => 'form-control'
				)
		) );
		
		/* ********************************************
		 * CAMPO CODIGO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_codigo',
				'options' => array (
						'label' => 'Código:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'pun_rec_codigo',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO LATITUD
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_lat',
				'options' => array (
						'label' => 'Latitud:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'pun_rec_lat',
						'class' => 'form-control'
				)
		) );

		/* ********************************************
		 * CAMPO LONGITUD
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_lng',
				'options' => array (
						'label' => 'Longitud:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'pun_rec_lng',
						'class' => 'form-control'
				)
		) );

		/* ********************************************
		 * CAMPO DIRECCION
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_direccion',
				'options' => array (
						'label' => 'Dirección:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'pun_rec_direccion',
						'class' => 'form-control'
				)
		) );


		/* ********************************************
		 * CAMPO OBSERVACIONES
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_observaciones',
				'options' => array (
						'label' => 'Observaciones:'
				),
				'attributes' => array (
						'type' => 'textarea',
						'id' => 'pun_rec_observaciones',
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