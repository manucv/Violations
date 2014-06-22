<?php

namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\I18n\Validator\Alpha;


class TipoInfraccionValidator extends InputFilter {
	function __construct() {
		
		$tip_inf_id = new Input ( 'tip_inf_id' );
		$tip_inf_id->setRequired ( false );
		$tip_inf_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 4,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $tip_inf_id );
		
		
		$tip_inf_descripcion = new Input ( 'tip_inf_descripcion' );
		$tip_inf_descripcion->setRequired ( true );
		$tip_inf_descripcion->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
		) ) )->attach(new NotEmpty())->attach(new Alnum(array('allowWhiteSpace' => true)));
		
		
		$this->add ( $tip_inf_descripcion );
		
	}
}