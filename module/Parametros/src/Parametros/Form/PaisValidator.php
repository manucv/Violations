<?php
namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;

class PaisValidator extends InputFilter {
	function __construct() {
		
		$pai_id = new Input ( 'pai_id' );
		$pai_id->setRequired ( false );
		$pai_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 4,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $pai_id );
		
		
		$pai_nombre_es = new Input ( 'pai_nombre_es' );
		$pai_nombre_es->setRequired ( true );
		$pai_nombre_es->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 120,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true 
		) ) )->attach(new NotEmpty());
		
		$this->add ( $pai_nombre_es );
		
		
		$pai_nombre_en = new Input ( 'pai_nombre_en' );
		$pai_nombre_en->setRequired ( true );
		$pai_nombre_en->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 120,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true
		) ) )->attach(new NotEmpty());
		
		$this->add ( $pai_nombre_en );
		
		
		$pai_codigo_telefono = new Input ( 'pai_codigo_telefono' );
		$pai_codigo_telefono->setRequired ( true );
		$pai_codigo_telefono->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 5,
		) ) )->attach ( new Digits() )->attach(new NotEmpty());
		
		
		$this->add ( $pai_codigo_telefono );
		
	}
}