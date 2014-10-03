<?php
namespace Usuarios\Form;

 use Zend\Form\Form;
 use Zend\Form\Element\Select;

 class Menu extends Form
 {
     public function __construct($name = null)
     {
        parent::__construct('menu');
        $this->setAttribute ( 'method', 'post' );

        $this->add(array(
        		'name' => 'men_id',
        		'type' => 'hidden',
        		'attributes' => array (
        				'id' => 'men_id',
        		)
        ));

        $this->add(array(
             'name' => 'men_nombre',
             'type' => 'text',
             'options' => array(
                 'label' => 'Nombre*:',
             ),
            'attributes' => array(
                 'id' => 'men_nombre',
                 'class' => 'form-control'
             )
        ));

        $this->add(array(
        		'name' => 'men_etiqueta',
        		'type' => 'text',
        		'options' => array(
        				'label' => 'Etiqueta*:',
        		),
        		'attributes' => array(
        				'id' => 'men_etiqueta',
        				'class' => 'form-control'
        		)
        ));

        /* ********************************************
		 * CAMPO CIUDAD
		 * ********************************************/
		$apl_id = new Select('apl_id');
		$apl_id->setLabel('Aplicacion*: ');
		$apl_id->setAttributes(array('id' => 'apl_id'));
		$apl_id->setAttributes(array('class' => 'form-control'));
		$apl_id->setEmptyOption('-- Seleccione --');
		$apl_id->setOptions(array(
				'disable_inarray_validator' => false, // <-- disable
		));
		$this->add($apl_id);
		
        
        $this->add(array(
        		'name' => 'men_icon',
        		'type' => 'text',
        		'options' => array(
        				'label' => '&Iacute;cono*:',
        		),
        		'attributes' => array(
        				'id' => 'men_icon',
        				'class' => 'form-control'
        		)
        ));
        
        $this->add(array(
        		'name' => 'men_padre',
        		'type' => 'text',
        		'options' => array(
        				'label' => 'Padre*:',
        		),
        		'attributes' => array(
        				'id' => 'men_padre',
        				'class' => 'form-control'
        		)
        ));
        
        $men_divisor = new Select('men_divisor');
        $men_divisor->setLabel('Divisor*: ');
        $men_divisor->setAttributes(array('id' => 'men_divisor'));
        $men_divisor->setAttributes(array('class' => 'form-control'));
        $men_divisor->setEmptyOption('-- Seleccione --');
        $men_divisor->setValueOptions(array(
        		'S' => 'Si',
        		'N' => 'No',
        ));
        $men_divisor->setOptions(array(
        		'disable_inarray_validator' => false, // <-- disable
        ));
        $this->add($men_divisor);
        

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