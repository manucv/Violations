<?php
namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\Validator\Regex;

class SectorValidator extends InputFilter {
	function __construct() {
		
		$sec_id = new Input ( 'sec_id' );
		$sec_id->setRequired ( false );
		$sec_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $sec_id );
		
		
		$sec_nombre = new Input ( 'sec_nombre' );
		$sec_nombre->setRequired ( true );
		$sec_nombre->setErrorMessage ( "Ingrese un Nombre valido" );
		$sec_nombre->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 45,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true 
		) ) )->attach(new NotEmpty());
		
		$this->add ( $sec_nombre );
		
		
		$sec_latitud = new Input ( 'sec_latitud' );
		$sec_latitud->setRequired ( true );
		$sec_latitud->setErrorMessage ( "Ingrese una latitud valida, o de click en el mapa" );
		$sec_latitud->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 35,
		) ) )
		->attach(new NotEmpty())
		->attach(new Regex(array(
			'pattern' => '/^(\-?\d+(?:\.\d+)?)$/',
		)));
		
		$this->add ( $sec_latitud );
		
		
		$sec_longitud = new Input ( 'sec_longitud' );
		$sec_longitud->setRequired ( true );
		$sec_longitud->setErrorMessage ( "Ingrese una longitud valida, o de click en el mapa" );
		$sec_longitud->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 35,
		) ) )->attach(new NotEmpty())
		->attach(new Regex(array(
			'pattern' => '/^(\-?\d+(?:\.\d+)?)$/',
		)));
		
		$this->add ( $sec_longitud );
		
		
		
		$ciu_id = new Input ( 'ciu_id' );
		$ciu_id->setRequired ( true );
		$ciu_id->setErrorMessage ( "Seleccione una ciudad" );
		$ciu_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $ciu_id );
		
		$pai_id = new Input ( 'pai_id' );
		$pai_id->setRequired ( true );
		$pai_id->setErrorMessage ( "Seleccione un pais" );
		$pai_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $pai_id );
		
		$est_id = new Input ( 'est_id' );
		$est_id->setRequired ( true );
		$est_id->setErrorMessage ( "Seleccione un estado" );
		$est_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $est_id );
		
		
		
		$sec_ubicacion = new Input ( 'sec_ubicacion' );
		$sec_ubicacion->setRequired ( true );
		$sec_ubicacion->setErrorMessage ( "Ingrese una ubicacion" );
		$sec_ubicacion->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
				'min' => 1
		) ) )->attach(new NotEmpty());
		
		$this->add ( $sec_ubicacion );
	}
}