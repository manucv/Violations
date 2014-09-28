<?php

namespace Usuarios\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\Validator\Identical;
use Zend\Validator\EmailAddress;
use Zend\Validator\InArray;
use Application\Clases\PasswordValidate;

class MenuValidator extends InputFilter {
	function __construct() {
		
		$men_id = new Input ( 'men_id' );
		$men_id->setRequired ( false );
		$men_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $men_id );
		
		
		$men_nombre = new Input ( 'men_nombre' );
		$men_nombre->setRequired ( true );
		$men_nombre->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 200,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach(new Alnum(array(
				'allowWhiteSpace' => false,
		)));
		
		$this->add ( $men_nombre );
		
		
		$men_etiqueta = new Input ( 'men_etiqueta' );
		$men_etiqueta->setRequired ( true );
		$men_etiqueta->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 200,
				'min' => 1,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $men_etiqueta );
		
		$apl_id = new Input ( 'apl_id' );
		$apl_id->setRequired ( false );
		$apl_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $apl_id );
		
		
		$men_icon = new Input ( 'men_icon' );
		$men_icon->setRequired ( true );
		$men_icon->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 100,
				'min' => 16,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $men_icon );
		
		
		$men_padre = new Input ( 'men_padre' );
		$men_padre->setRequired ( true );
		$men_padre->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach(new Digits());
		
		$this->add ( $men_padre );
		
		
		$men_divisor = new Input ( 'men_divisor' );
		$men_divisor->setRequired ( true );
		$men_divisor->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 1,
				'min' => 1
		) ) )->attach(new Alnum(array(
				'allowWhiteSpace' => false,
		)))->attach(new NotEmpty())
		->attach(new InArray(array(
				'haystack' => array('S','N'),
		)));
		
		$this->add ( $men_divisor );
		
		
	}
}