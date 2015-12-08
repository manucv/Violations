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
						'maxlength' => '45',
						'id' => 'pun_rec_nombre',
						'class' => 'form-control',
						'readonly' => 'true'
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
						'class' => 'form-control',
						'readonly' => 'true'
				)
		) );

		/* ********************************************
		 * CAMPO NOMBRES PROPIETARIO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_nombres',
				'options' => array (
						'label' => 'Nombres Propietario:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '45',
						'id' => 'pun_rec_nombres',
						'class' => 'form-control',
						'readonly' => 'true'
				)
		) );

		/* ********************************************
		 * CAMPO APELLIDOS PROPIETARIO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_apellidos',
				'options' => array (
						'label' => 'Apellidos Propietario:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '45',
						'id' => 'pun_rec_apellidos',
						'class' => 'form-control',
						'readonly' => 'true'
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
		 * CAMPO CODIGO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_email',
				'options' => array (
						'label' => 'Email:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'pun_rec_email',
						'class' => 'form-control',
						'readonly' => 'true'
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
						'class' => 'form-control',
						'readonly' => 'true'
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

		/* ********************************************
		 * CAMPO HABILITADO
		 * ********************************************/

		$this->add(array(
         	'type' => 'Zend\Form\Element\Select',
         	'name' => 'pun_rec_habilitado',
         	'options' => array(
                'label' => 'Recargas',
                'value_options' => array(
                    '0' => 'No',
                    '1' => 'Si'
				)
			),	
			'attributes' => array (
				'id' => 'pun_rec_habilitado',
				'class' => 'form-control'
			)
     	));

     	/* ********************************************
		 * CAMPO CLAVE
		* ********************************************/
		
		$this->add ( array (
				'name' => 'pun_rec_clave',
				'options' => array (
						'label' => 'Clave Sistema de Ventas:'
				),
				'attributes' => array (
						'type' => 'password',
						'maxlength' => '25',
						'id' => 'pun_rec_clave',
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