<?php  //Login.php

namespace Tiendas\Form;

use Zend\Form\Form;

class Buscar extends Form {
	function __construct($name = null) {
		parent::__construct ( $name );
		
		$this->add ( array (
				'name' => 'punto_recarga_pun_rec_id',
				'attributes' => array (
						'type' => 'hidden',
						'maxlenght' => '7',
						'id' => 'punto_recarga_pun_rec_id',
				) 
		) );

		$this->add ( array (
				'name' => 'usu_email',
				'options' => array (
						'label' => 'Nro. Celular &oacute; email registrado: ' 
				),
				'attributes' => array (
						'type' => 'text',
						'maxlenght' => '25',
						'id' => 'usu_email',
						'class' => 'form-control',
				        'style' => 'color: #000000; font-weight: 700;'
				) 
		) );

		$this->add ( array (
				'name' => 'com_sal_valor',
				'options' => array (
						'label' => 'Valor: ' 
				),
				'attributes' => array (
						'type' => 'text',
						'maxlenght' => '25',
						'id' => 'com_sal_valor',
						'class' => 'form-control',
				        'style' => 'color: #000000; font-weight: 700;'
				) 
		) );
		
		$this->add ( array (
				'name' => 'buscar',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Cargar',
						'class' => 'btn btn-primary',
				    'style' => 'background: #ee5d1f; border: 1px solid #f5b942;' 
				) 
		) );
	}
}