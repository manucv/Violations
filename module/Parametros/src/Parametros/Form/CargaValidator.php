<?php 	//CalleValidator.php

namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\I18n\Validator\Float;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\Validator\Regex;

class CargaValidator extends InputFilter {
	function __construct() {
			
		$car_valor = new Input ( 'car_valor' );
		$car_valor->setRequired ( true );
		$car_valor->setErrorMessage ( "Ingrese un valor valido" );
		$car_valor->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Float () );
		
		$this->add ( $car_valor );

	}
}