<?php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class TipoInfraccion extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'tip_inf_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '4',
						'id' => 'tip_inf_id',
						'class' => 'form-control'
				)
		) );
		
		$this->add ( array (
				'name' => 'tip_inf_codigo',
				'options' => array (
						'label' => 'Código:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'tip_inf_codigo',
						'class' => 'form-control'
				)
		) );


		/* ********************************************
		 * CAMPO NOMBRE
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'tip_inf_descripcion',
				'options' => array (
						'label' => 'Descripci&oacute;n*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'tip_inf_descripcion',
						'class' => 'form-control'
				)
		) );
		
		$this->add ( array (
				'name' => 'tip_inf_legal',
				'options' => array (
						'label' => 'Base Legal:'
				),
				'attributes' => array (
						'type' => 'textarea',
						'id' => 'tip_inf_legal',
						'class' => 'form-control'
				)
		) );

		$this->add ( array (
				'name' => 'tip_inf_valor',
				'options' => array (
						'label' => 'Valor:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'tip_inf_valor',
						'class' => 'form-control'
				)
		) );

		$this->add ( array (
				'name' => 'tip_inf_valor',
				'options' => array (
						'label' => 'Valor:'
				),
				'attributes' => array (
						'type' => 'text',
						'id' => 'tip_inf_valor',
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