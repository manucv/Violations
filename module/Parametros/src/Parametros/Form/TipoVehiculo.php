<?php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class TipoVehiculo extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'tip_veh_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '4',
						'id' => 'tip_veh_id',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'tip_veh_descripcion',
				'options' => array (
						'label' => 'Descripci&oacute;n*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '75',
						'id' => 'tip_veh_descripcion',
						'class' => 'form-control'
				)
		) );
		
		
		//BOTON DE SUBMIT
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