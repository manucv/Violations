<?php

namespace Monitoreo\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;


class LocalidadValidator extends InputFilter {
	function __construct() {
		
		$ciu_id = new Input ( 'ciu_id' );
		$ciu_id->setRequired ( true );
		$ciu_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $ciu_id );
		
		
		$pai_id = new Input ( 'pai_id' );
		$pai_id->setRequired ( true );
		$pai_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $pai_id );
		
		
		$est_id = new Input ( 'est_id' );
		$est_id->setRequired ( true );
		$est_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $est_id );
		
	}
}