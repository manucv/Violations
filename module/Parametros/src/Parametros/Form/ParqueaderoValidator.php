<?php
namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\I18n\Validator\Alpha;
use Zend\Validator\InArray;

class ParqueaderoValidator extends InputFilter {
	function __construct() {
		
		$par_id = new Input ( 'par_id' );
		$par_id->setRequired ( false );
		$par_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $par_id );
		
		
		$par_codigo = new Input ( 'par_codigo' );
		$par_codigo->setRequired ( true );
		$par_codigo->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 10,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true 
		) ) )->attach(new NotEmpty());
		
		$this->add ( $par_codigo );
		
		
		$par_estado = new Input ( 'par_estado' );
		$par_estado->setRequired ( true );
		$par_estado->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 1,
		) ) )->attach ( new Alpha ( array (
				'allowWhiteSpace' => true
		) ) )->attach(new NotEmpty())
		     ->attach(new InArray(array(
				'haystack' => array('D'),
		)));
		
		$this->add ( $par_estado );
	}
}