<?php
namespace Usuarios\Form;

 use Zend\Form\Form;

 class Rol extends Form
 {
     public function __construct($name = null)
     {
        parent::__construct('roles');
        $this->setAttribute ( 'method', 'post' );


        $this->add(array(
             'name' => 'rol_descripcion',
             'type' => 'text',
             'options' => array(
                 'label' => 'Nombre*:',
             ),
            'attributes' => array(
                 'id' => 'rol_descripcion',
                 'class' => 'form-control'
             )
        ));


        $this->add(array(
             'name' => 'rol_id',
             'type' => 'hidden',
             'attributes' => array (
                'id' => 'rol_id',
            )
        ));


        /* ********************************************
         * CAMPO APLICACION
         * ********************************************/
        
        $this->add(array(
        		'type' => 'Zend\Form\Element\MultiCheckbox',
        		'name' => 'aplicacion',
        		'validators' => array(
        				'required' => true
        		),
        		'options' => array('label'=>'Columnas',
					'label_attributes' => array('class' => 'checkbox-style'),
				),
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