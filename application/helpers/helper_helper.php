<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
1	Gol                     11	Gol Rival
2	Gol de Penal		12	Gol de Penal Rival
3	Amarilla		13	Amarilla
4	Roja Directa		14	Roja

 */


if ( ! function_exists('incidencia'))
{
    function incidencia($nombre = null,$tipo=null,$aFavor=null,$id = null)
    {
        if ($aFavor){
            $val = '<p align="right">';
        }else{
            $val = '<p>';
        }
        if (($tipo < 10 && $aFavor) || ($tipo >= 10 && !$aFavor)){
            
            $val .= '<a href="'.base_url().'index.php/estadisticas/jugadores/'.$id.'" >'.$nombre.'</a>';
            switch ($tipo){
                case 1:
                case 11:
                    $val .= '<img src="'.base_url().'/assets/16pxPelota.png">';
                    break;
                    
                case 2:
                case 12:
                    $val .= '<img src="'.base_url().'/assets/16pxPelota.png"> (pen)';
                    break;
                case 3:
                case 13:
                    $val .= '<img src="'.base_url().'/assets/10pxAmarilla.png">';
                    break;
                case 4:
                case 14:
                    $val .= '<img src="'.base_url().'/assets/10pxRoja.png">';
                    break;
            }
        }else{
            $val .='<br>';
        }
        $val .= '</p>';
        echo $val;
    }   
}