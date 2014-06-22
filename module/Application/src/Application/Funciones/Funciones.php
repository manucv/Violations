<?php 
namespace Application\Funciones;
/**
* Funciones: Contiene funciones globales del sistema
*/
class Funciones
{
    public static function translateAndFormatDate($date,$language='E',$inFormat='d/m/Y'){
        
        $months=array(
            'I'=>array(
                '1'=>'january',     '2'=>'february',    '3'=>'march',
                '4'=>'april',       '5'=>'may',         '6'=>'june',
                '7'=>'july',        '8'=>'august',      '9'=>'september',
                '10'=>'october',    '11'=>'november',   '12'=>'december'
                ),
            'E'=>array(
                '1'=>'enero',       '2'=>'febrero',     '3'=>'marzo',
                '4'=>'abril',       '5'=>'mayo',        '6'=>'junio',
                '7'=>'julio',       '8'=>'agosto',      '9'=>'septiembre',
                '10'=>'octubre',    '11'=>'noviembre',  '12'=>'diciembre'
                )
            );
        $date_info=date_parse_from_format($inFormat,$date);

        switch($language){
            case 'I':
                return $months[$language][$date_info['month']].' '.$date_info['day'].', 20'.$date_info['year'];
            break;
            case 'E':
                return $date_info['day'].' de '.
                $months[$language][$date_info['month']].' de 20'.
                $date_info['year'];
            break;
        } 

    }        

    public static function fechaFormateada($date,$language='E',$inFormat='d/m/Y'){
    	$months=array(
    			'I'=>array(
    					'1'=>'january',     '2'=>'february',    '3'=>'march',
    					'4'=>'april',       '5'=>'may',         '6'=>'june',
    					'7'=>'july',        '8'=>'august',      '9'=>'september',
    					'10'=>'october',    '11'=>'november',   '12'=>'december'
    			),
    			'E'=>array(
    					'1'=>'enero',       '2'=>'febrero',     '3'=>'marzo',
    					'4'=>'abril',       '5'=>'mayo',        '6'=>'junio',
    					'7'=>'julio',       '8'=>'agosto',      '9'=>'septiembre',
    					'10'=>'octubre',    '11'=>'noviembre',  '12'=>'diciembre'
    			)
    	);
    	$date_info=date_parse_from_format($inFormat,$date);
    	switch($language){
    		case 'I':
    			return $months[$language][$date_info['month']].' '.$date_info['day'].', '.$date_info['year'];
    			break;
    		case 'E':
    			return $date_info['day'].' de '.$months[$language][$date_info['month']].' de '.$date_info['year'];
    			break;
    	}
    
    }

}