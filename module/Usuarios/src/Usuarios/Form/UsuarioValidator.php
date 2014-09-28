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

class UsuarioValidator extends InputFilter {
	function __construct() {
		
		$usu_id = new Input ( 'usu_id' );
		$usu_id->setRequired ( false );
		$usu_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1
		) ) )->attach ( new Digits () );
		
		$this->add ( $usu_id );
		
		
		$ciu_id = new Input ( 'ciu_id' );
		$ciu_id->setRequired ( true );
		$ciu_id->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 11,
				'min' => 1,
		) ) )->attach(new NotEmpty())
		->attach ( new Digits () );
		
		$this->add ( $ciu_id );
		
		
		$usu_usuario = new Input ( 'usu_usuario' );
		$usu_usuario->setRequired ( true );
		$usu_usuario->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 15,
				'min' => 6,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $usu_usuario );
		
		$usu_email = new Input ( 'usu_email' );
		$usu_email->setRequired ( true );
		$usu_email->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 150,
				'min' => 6,
		) ) )->attach(new NotEmpty())
		->attach(new EmailAddress(array(
            	'domain' => true,
        )));
		
		$this->add ( $usu_email );
		
		
		$usu_nombre = new Input ( 'usu_nombre' );
		$usu_nombre->setRequired ( true );
		$usu_nombre->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 35,
				'min' => 2,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $usu_nombre );
		
		
		$usu_apellido = new Input ( 'usu_apellido' );
		$usu_apellido->setRequired ( true );
		$usu_apellido->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 35,
				'min' => 2,
		) ) )->attach(new NotEmpty());
		
		$this->add ( $usu_apellido );
		
		
		$usu_clave = new Input ( 'usu_clave' );
		$usu_clave->setRequired ( true );
		$usu_clave->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 50,
				'min' => 4,
		) ) )->attach(new NotEmpty())
		->attach( new PasswordValidate());
		
		$this->add ( $usu_clave );
		
		
		$usu_clave_check = new Input ( 'usu_clave_check' );
		$usu_clave_check->setRequired ( true );
		$usu_clave_check->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 50,
				'min' => 4,
		) ) )->attach(new NotEmpty())
		->attach( new PasswordValidate())
		->attach(new Identical(array(
			'token' => 'usu_clave',
		)));
		
		$this->add ( $usu_clave_check );
		
		
		$usu_estado = new Input ( 'usu_estado' );
		$usu_estado->setRequired ( true );
		$usu_estado->getValidatorChain ()->attach ( new StringLength ( array (
				'max' => 1,
				'min' => 1
		) ) )->attach(new Alnum(array(
				'allowWhiteSpace' => false,
		)))->attach(new NotEmpty())
		->attach(new InArray(array(
				'haystack' => array('A','I'),
		)));
		
		$this->add ( $usu_estado );
		
		
	}
}