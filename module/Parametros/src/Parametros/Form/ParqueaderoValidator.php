<?php
namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\I18n\Validator\Float;
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
		$par_id->setErrorMessage ( "Ingrese un valor" );
		$par_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 7,
				'min' => 1
		) ) )->attach(new NotEmpty());
		
		$this->add ( $par_id );
		
		
		$par_estado = new Input ( 'par_estado' );
		$par_estado->setRequired ( true );
		$par_estado->setErrorMessage ( "Selecione un estado" );
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
		$sec_id->setErrorMessage ( "Selecione un sector" );
		$sec_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $sec_id );


		$par_tipo = new Input ( 'par_tipo' );
		$par_tipo->setRequired ( true );
		$par_tipo->setErrorMessage ( "Selecione un tipo" );
		$par_tipo->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 1,
		) ) )->attach ( new Alpha ( array (
				'allowWhiteSpace' => true
		) ) )->attach(new NotEmpty());
		
		$this->add ( $par_tipo );


		$par_cal_principal = new Input ( 'par_cal_principal' );
		$par_cal_principal->setRequired ( true );
		$par_cal_principal->setErrorMessage ( "Selecione una calle principal" );
		$par_cal_principal->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $par_cal_principal );

		$par_cal_secundaria = new Input ( 'par_cal_secundaria' );
		$par_cal_secundaria->setRequired ( true );
		$par_cal_secundaria->setErrorMessage ( "Selecione una calle secundaria" );
		$par_cal_secundaria->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $par_cal_secundaria );

		$par_latitud = new Input ( 'par_latitud' );
		$par_latitud->setRequired ( true );
		$par_latitud->setErrorMessage ( "Ingrese una latitud valida, o de click en el mapa" );
		$par_latitud->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 35,
		) ) )
		->attach(new NotEmpty())
		->attach(new Float ());
		
		$this->add ( $par_latitud );
		
		
		$par_longitud = new Input ( 'par_longitud' );
		$par_longitud->setRequired ( true );
		$par_longitud->setErrorMessage ( "Ingrese una longitud valida, o de click en el mapa" );
		$par_longitud->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 35,
		) ) )->attach(new NotEmpty())
		->attach(new Float ());
		
		$this->add ( $par_longitud );

	}
}