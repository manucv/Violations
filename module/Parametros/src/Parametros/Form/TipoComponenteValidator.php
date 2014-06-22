<?php

namespace Parametros\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;


class TipoComponenteValidator extends InputFilter {
	function __construct() {
		
		$tip_com_id = new Input ( 'tip_com_id' );
		$tip_com_id->setRequired ( false );
		$tip_com_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 3,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $tip_com_id );
		
		
		$tip_com_descripcion = new Input ( 'tip_com_descripcion' );
		$tip_com_descripcion->setRequired ( true );
		$tip_com_descripcion->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
		) ) )->attach(new NotEmpty());
		
		
		$this->add ( $tip_com_descripcion );
		
	}
}