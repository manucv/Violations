<?php 
//TicketsValidator.php

namespace Parqueaderos\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;
use Zend\Validator\Regex;

class TicketsValidator extends InputFilter {
	function __construct() {

	}
}