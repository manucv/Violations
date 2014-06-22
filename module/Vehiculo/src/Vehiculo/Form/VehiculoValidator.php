<?php

namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\I18n\Filter\Alpha;


class VehiculoValidator extends InputFilter {
	function __construct() {
		
		$veh_id = new Input ( 'veh_id' );
		$veh_id->setRequired ( false );
		$veh_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 6,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $veh_id );
		
		
		$tip_veh_id = new Input ( 'tip_veh_id' );
		$tip_veh_id->setRequired ( true );
		$tip_veh_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 4,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $tip_veh_id );
		
		
		$veh_marca = new Input ( 'veh_marca' );
		$veh_marca->setRequired ( true );
		$veh_marca->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
		) ) )->attach ( new Alpha ( array (
				'allowWhiteSpace' => true 
		) ) )->attach(new NotEmpty());
		
		
		$this->add ( $veh_marca );
		
		
		$veh_modelo = new Input ( 'veh_modelo' );
		$veh_modelo->setRequired ( true );
		$veh_modelo->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 100,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true
		) ) )->attach(new NotEmpty());
		
		
		$this->add ( $veh_modelo );
		
		
		$veh_placa = new Input ( 'veh_placa' );
		$veh_placa->setRequired ( true );
		$veh_placa->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 10,
		) ) )->attach(new NotEmpty());
		
		
		$this->add ( $veh_placa );
		
		
		$veh_camara_activa = new Input ( 'veh_camara_activa' );
		$veh_camara_activa->setRequired ( true );
		$veh_camara_activa->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 1,
				'min' => 1
		) ) )->attach(new Alpha(array(
				'allowWhiteSpace' => false,
		)))->attach(new NotEmpty())
		->attach(new InArray(array(
				'haystack' => array('S','N'),
		)));
		
		$this->add ( $veh_camara_activa );
		
	}
}