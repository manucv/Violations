<?php

namespace Parametros\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class Vehiculo extends Form {
	function __construct($name = null) {
		
		parent::__construct($name);
		
		/* ********************************************
		 * CAMPO CODIGO PRIMARIO
		* ********************************************/
		
		$this->add ( array (
				'name' => 'veh_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlength' => '6',
						'id' => 'veh_id',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO TIPO VEHICULO
		 * ********************************************/
		$tip_veh_id = new Select('tip_veh_id');
		$tip_veh_id->setLabel('Tipo de Veh&iacute;culo*: ');
		$tip_veh_id->setAttributes(array('id' => 'tip_veh_id'));
		$tip_veh_id->setAttributes(array('class' => 'form-control'));
		$tip_veh_id->setEmptyOption('-- Seleccione --');
		$tip_veh_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($tip_veh_id);
		
		
		/* ********************************************
		 * CAMPO MARCA
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'veh_marca',
				'options' => array (
						'label' => 'Marca*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'veh_marca',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO MODELO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'veh_modelo',
				'options' => array (
						'label' => 'Modelo*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '100',
						'id' => 'veh_modelo',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO PLACA
		* ********************************************/
		
		$this->add ( array (
				'name' => 'veh_placa',
				'options' => array (
						'label' => 'Placa*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '10',
						'id' => 'veh_placa',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO CAMARA ACTIVA
		* ********************************************/
		$veh_camara_activa = new Select('veh_camara_activa');
		$veh_camara_activa->setLabel('&iquest;Tiene camara asociada?*: ');
		$veh_camara_activa->setAttributes(array('id' => 'veh_camara_activa'));
		$veh_camara_activa->setAttributes(array('class' => 'form-control'));
		$veh_camara_activa->setEmptyOption('-- Seleccione --');
		$veh_camara_activa->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$veh_camara_activa->setValueOptions(array(
			'S' => 'S&iacute;',
			'N' => 'No'	
		));
		$this->add($veh_camara_activa);
		
		
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