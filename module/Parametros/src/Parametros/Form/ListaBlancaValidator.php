<?php
	//ListaBlancaValidator.php

	namespace Parametros\Form;

	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\Input;
	use Zend\Validator\StringLength;
	use Zend\I18n\Validator\Alnum;
	use Zend\Validator\Digits;
	use Zend\Validator\NotEmpty;
	use Zend\Validator\Regex;

	class ListaBlancaValidator extends InputFilter {
		function __construct() {
			$lis_bla_placa = new Input ( 'lis_bla_placa' );
			$lis_bla_placa->setRequired ( true );
			$lis_bla_placa->setErrorMessage("Ingrese un placa válida");
			$lis_bla_placa->getValidatorChain ()->attach ( 
				new StringLength ( 
					array (
						'max' => 7,
						'min' => 7
					) 
				)
			)->attach(new NotEmpty());

			$this->add ( $lis_bla_placa );
		}
	}