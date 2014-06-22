<?php
namespace Usuarios\Form;

 use Zend\Form\Form;

 class RolUsuario extends Form
 {
     public function __construct($name = null)
     {
        parent::__construct('usuarios');
        $this->setAttribute ( 'method', 'post' );

        $this->add(array(
             'name' => 'usu_id',
             'type' => 'hidden',
             'attributes' => array(
                 'id' => 'usu_id',
             	 'readonly' => 'readonly'
             )
        ));
        
        $this->add(array(
        		'name' => 'usu_nombre',
        		'type' => 'text',
        		'options' => array(
        				'label' => 'Usuario*:',
        		),
        		'attributes' => array(
        				'id' => 'usu_nombre',
        				'class' => 'form-control',
        				'readonly' => 'readonly'
        		)
        ));

        $this->add(array(
             'name' => 'rol_id',
             'type' => 'Zend\Form\Element\Select',
             'options' => array(
                 'label' => 'Rol*:',
                 'empty_option' => '-- Seleccione --'                 
             ),
             'attributes' => array(
                 'id' => 'rol_id',
                 'class' => 'form-control'
             )
        ));



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