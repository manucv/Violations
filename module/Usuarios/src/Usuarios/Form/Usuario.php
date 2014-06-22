<?php
namespace Usuarios\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

 class Usuario extends Form
 {
     public function __construct($name = null, $max_detalle_contacto=5)
     {
        parent::__construct('usuarios');
        $this->setAttribute ( 'method', 'post' );
        
        /* ********************************************
         * CAMPO CODIGO PRIMARIO
        * ********************************************/
        
        $this->add ( array (
        		'name' => 'usu_id',
        		'attributes' => array (
        				'type' => 'hidden',
        				'maxlength' => '11',
        				'id' => 'usu_id',
        				'class' => 'form-control'
        		)
        ) );

        /* ********************************************
		 * CAMPO CIUDAD
		 * ********************************************/
		$ciu_id = new Select('ciu_id');
		$ciu_id->setLabel('Ciudad*: ');
		$ciu_id->setAttributes(array('id' => 'ciu_id'));
		$ciu_id->setAttributes(array('class' => 'form-control'));
		$ciu_id->setEmptyOption('-- Seleccione --');
		$ciu_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($ciu_id);
		
		
		/* ********************************************
		 * CAMPO USUARIO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'usu_usuario',
				'options' => array (
						'label' => 'Usuario*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '15',
						'id' => 'usu_usuario',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO EMAIL
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'usu_email',
				'options' => array (
						'label' => 'Email*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '150',
						'id' => 'usu_email',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO NOMBRE
		* ********************************************/
		
		$this->add ( array (
				'name' => 'usu_nombre',
				'options' => array (
						'label' => 'Nombre*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '35',
						'id' => 'usu_nombre',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO APELLIDO
		 * ********************************************/
		
		$this->add ( array (
				'name' => 'usu_apellido',
				'options' => array (
						'label' => 'Apellido*:'
				),
				'attributes' => array (
						'type' => 'text',
						'maxlength' => '35',
						'id' => 'usu_apellido',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO USU CLAVE
		* ********************************************/
		
		$this->add ( array (
				'name' => 'usu_clave',
				'options' => array (
						'label' => 'Clave*:'
				),
				'attributes' => array (
						'type' => 'password',
						'maxlength' => '50',
						'id' => 'usu_clave',
						'class' => 'form-control'
				)
		) );
		
		
		/* ********************************************
		 * CAMPO USU CLAVE REPETICION
		* ********************************************/
		
		$this->add ( array (
				'name' => 'usu_clave_check',
				'options' => array (
						'label' => 'Repetir clave*:'
				),
				'attributes' => array (
						'type' => 'password',
						'maxlength' => '50',
						'id' => 'usu_clave_check',
						'class' => 'form-control'
				)
		) );


		/* ********************************************
		 * CAMPO ESTADO
		* ********************************************/
		
		$usu_estado = new Select('usu_estado');
		$usu_estado->setLabel('Estado*: ');
		$usu_estado->setAttributes(array('id' => 'usu_estado'));
		$usu_estado->setAttributes(array('class' => 'form-control'));
		$usu_estado->setEmptyOption('-- Seleccione --');
		$usu_estado->setValueOptions(array(
			'A' => 'Activo',
			'I' => 'Inactivo',
		));
		$usu_estado->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($usu_estado);
		
		
		/* ********************************************
		 * BOTON SUBMIT
		* ********************************************/
		
        $this->add(array(
             'name' => 'ingresar',
             'type' => 'submit',
             'attributes' => array(
                 'id' => 'submit',
                 'value' => 'Ingresar',
                 'class' => 'btn btn-primary'
             )
        ));

     }
 } 