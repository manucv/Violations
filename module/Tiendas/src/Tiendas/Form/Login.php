<?php  //Login.php

namespace Tiendas\Form;

use Zend\Form\Form;

class Login extends Form {
	function __construct($name = null) {
		parent::__construct ( $name );
		
		$this->add ( array (
				'name' => 'pun_rec_ruc',
				'options' => array (
						'label' => 'Cédula / RUC: ' 
				),
				'attributes' => array (
						'type' => 'text',
						'maxlenght' => '13',
						'id' => 'pun_rec_ruc',
						'class' => 'form-control',
				        'style' => 'color: #000000; font-weight: 700;',
				        'autocomplete'=>'off'
				) 
		) );
		
		$this->add(array(
				'name' => 'pun_rec_clave',
				'options' => array (
						'label' => 'Contrase&ntilde;a: '
				),
				'attributes' => array (
						'type' => 'password',
						'maxlenght' => '25',
						'id' => 'pun_rec_clave',
						'class' => 'form-control',
				        'style' => 'color: #000000; font-weight: 700;',
				        'autocomplete'=>'off'
				)
		));
		
		$this->add ( array (
				'name' => 'ingresar',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Ingresar al sistema',
						'class' => 'btn btn-primary',
				    'style' => 'background: #ee5d1f; border: 1px solid #f5b942;' 
				) 
		) );
	}
}