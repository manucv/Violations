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
	    
	    $par_codigo = new Input ( 'par_codigo' );
	    $par_codigo->setRequired ( false );
	    $par_codigo->getValidatorChain ()->attach ( new StringLength ( array (
	        'max' => 7,
	        'min' => 1
	    ) ) );
	    
	    $this->add ( $par_codigo );
		
		$par_id = new Input ( 'par_id' );
		$par_id->setRequired ( true );
		$par_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 7,
				'min' => 1
		) ) )->attach(new NotEmpty());
		
		$this->add ( $par_id );
		
		
		$par_estado = new Input ( 'par_estado' );
		$par_estado->setRequired ( true );
		$par_estado->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 1,
		) ) )->attach ( new Alpha ( array (
				'allowWhiteSpace' => true
		) ) )->attach(new NotEmpty())
		     ->attach(new InArray(array(
				'haystack' => array('D','O'),
		)));
		
		$this->add ( $par_estado );
		
		
		$sec_id = new Input ( 'sec_id' );
		$sec_id->setRequired ( true );
		$sec_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $sec_id );
	}
}