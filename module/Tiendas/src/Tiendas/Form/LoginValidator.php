<?php //LoginValidator.php

namespace Tiendas\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class LoginValidator extends InputFilter{
	
	function __construct(){
		
		$usuario = new Input('pun_rec_ruc');
		$usuario->setRequired(true);
		$this->add($usuario);
		
		$usuario = new Input('pun_rec_clave');
		$usuario->setRequired(true);
		$this->add($usuario);
	}
	
}