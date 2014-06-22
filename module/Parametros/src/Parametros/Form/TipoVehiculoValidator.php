<?php

namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\I18n\Validator\Alpha;


class TipoVehiculoValidator extends InputFilter {
	function __construct() {
		
		$tip_veh_id = new Input ( 'tip_veh_id' );
		$tip_veh_id->setRequired ( false );
		$tip_veh_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 4,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $tip_veh_id );
		
		
		$tip_veh_descripcion = new Input ( 'tip_veh_descripcion' );
		$tip_veh_descripcion->setRequired ( true );
		$tip_veh_descripcion->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 75,
		) ) )->attach(new NotEmpty())->attach(new Alnum(array('allowWhiteSpace' => true)));
		
		
		$this->add ( $tip_veh_descripcion );
		
	}
}