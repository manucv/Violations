<?php

namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;


class CiudadValidator extends InputFilter {
	function __construct() {
		
		$ciu_id = new Input ( 'ciu_id' );
		$ciu_id->setRequired ( false );
		$ciu_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $ciu_id );
		
		
		$est_id = new Input ( 'est_id' );
		$est_id->setRequired ( true );
		$est_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 4,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $est_id );
		
		
		$ciu_nombre = new Input ( 'ciu_nombre_es' );
		$ciu_nombre->setRequired ( true );
		$ciu_nombre->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true 
		) ) )->attach(new NotEmpty());
		
		
		$this->add ( $ciu_nombre );
		
		$ciu_nombre_en = new Input ( 'ciu_nombre_en' );
		$ciu_nombre_en->setRequired ( true );
		$ciu_nombre_en->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true
		) ) )->attach(new NotEmpty());
		
		
		$this->add ( $ciu_nombre_en );
		
		
		$ciu_codigo_telefono = new Input ( 'ciu_codigo_telefono' );
		$ciu_codigo_telefono->setRequired ( true );
		$ciu_codigo_telefono->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 5,
		) ) )->attach ( new Digits() )->attach(new NotEmpty());
		
		
		$this->add ( $ciu_codigo_telefono );
		
	}
}