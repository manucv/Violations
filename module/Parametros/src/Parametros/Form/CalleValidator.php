<?php 	//CalleValidator.php

namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\Validator\Regex;

class CalleValidator extends InputFilter {
	function __construct() {
			
		$cal_codigo = new Input ( 'cal_codigo' );
		$cal_codigo->setRequired ( true );
		$cal_codigo->setErrorMessage ( "Ingrese un codigo" );
		$cal_codigo->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
		) ) )->attach(new NotEmpty())->attach(new Alnum(array('allowWhiteSpace' => true)));
		
		$this->add ( $cal_codigo );

		$cal_nombre = new Input ( 'cal_nombre' );
		$cal_nombre->setRequired ( true );
		$cal_nombre->setErrorMessage ( "Ingrese un nombre" );
		$cal_nombre->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 250,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $cal_nombre );

	}
}