<?php
namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\Validator\InArray;

class SitioValidator extends InputFilter {
	function __construct() {
		
		$sit_id = new Input ( 'sit_id' );
		$sit_id->setRequired ( false );
		$sit_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $sit_id );
		
		
		$sit_descripcion = new Input ( 'sit_descripcion' );
		$sit_descripcion->setRequired ( true );
		$sit_descripcion->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 200,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true
		) ) )->attach(new NotEmpty());
		
		$this->add ( $sit_descripcion );
		
		
		$sit_direccion = new Input ( 'sit_direccion' );
		$sit_direccion->setRequired ( true );
		$sit_direccion->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $sit_direccion );
		
		
		$sit_sector = new Input ( 'sit_sector' );
		$sit_sector->setRequired ( true );
		$sit_sector->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 50,
		) ) )->attach ( new Alnum ( array (
				'allowWhiteSpace' => true
		) ) )->attach(new NotEmpty());
		
		$this->add ( $sit_sector );
		
		
		$sit_reference_number = new Input ( 'sit_reference_number' );
		$sit_reference_number->setRequired ( true );
		$sit_reference_number->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 10,
		) ) )->attach ( new Digits() )
		->attach(new NotEmpty());
		
		$this->add ( $sit_reference_number );
		
		
		$this->add(array(
				'name' => 'sit_estado',
				'required' => true,
				'validators' => array(
						new NotEmpty(),
						new InArray(array(
								'haystack' => array('A','I'),
						)),
				),
		));
		
	}
}