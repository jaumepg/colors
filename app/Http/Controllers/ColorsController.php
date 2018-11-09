<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Provider\Image;
class ColorsController extends Controller
{
    
    private $colors = array();
    var $rgb_img = array();
    public function __construct(){
      
        //inicializamos los colores predeterminados
        $this->inicialize_colors();
              
    }

    public function index(Request $request)
    {
        
        $porcent = 0;
        $win = array();
        $rTotal = 0;
        $gTotal = 0;
        $bTotal = 0;
        $total = 0;
        
        $img = $this->saveImage($request);
        
        if(empty($img)){
            $data = array(
                'status' => 'error',
                'msg'   => 'Error subir imagen'
            );
            return $data;
        }

        $ruta = public_path($img);
        
        $mime = mime_content_type($ruta);
        
        if($mime=="image/jpeg") {
            $image = imagecreatefromjpeg ($ruta);
        }else if($mime=="image/png"){
            $image = imagecreatefrompng ($ruta);
        }
        
        $data = array(
                'status' => 'success',
                'color'   => '#FFFF00',
                'img' => $img
            );
        return $data;

        
        for ($x=0;$x<imagesx($image);$x++) {
            for ($y=0;$y<imagesy($image);$y++) {
                $rgb = imagecolorat($image,$x,$y);
                $r   = ($rgb >> 16) & 0xFF;
                $g   = ($rgb >> 8) & 0xFF;
                $b   = $rgb & 0xFF;
                $rTotal += $r;
                $gTotal += $g;
                $bTotal += $b;
                $total++;
            }
        }
        $rPromedio = round($rTotal/$total);
        $gPromedio = round($gTotal/$total);
        $bPromedio = round($bTotal/$total);


        echo "<div style='height:50px;width:400px;background-color:rgb(".$rPromedio.",".$gPromedio.",".$bPromedio.")'></div>";

        
        foreach($this->colors as $hex => $color){
             $rgb = $this->calcultaeRGB($hex);
             $resultado =sqrt(($rgb['r']-$rPromedio)^2+($rgb['g']-$gPromedio)^2+($rgb['b']-$bPromedio)^2);
             if($resultado > $porcent){
                $porcent = $resultado; 
                print_r($porcent.'-'.$color.'<br>');
                $win = $rgb;
            }
            
        }
        echo "<div style='height:50px;width:400px;margin-bottom:15px;background-color:rgb(".$win['r'].",".$win['g'].",".$win['b']."')></div>";


    }
    
    //Funcion devuelve el color rgb del color hexadecimal
    private function calcultaeRGB ($hex){
        $value = hexdec($hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        
        return $rgb;
    }
    
    //Guardar imagen devolver ubicacion guardada
    private function saveImage($request){
        
        $image = $request->file('imageInput');
        if($image) {
            $file_name = time() . $image->getClientOriginalName();
            $filename = $image->getClientOriginalName();
            $file_path = 'img/';
            $image->move(public_path($file_path), $filename);
            return $file_path.$filename;
        }else{
            return false;
        }

    }

    private function inicialize_colors(){
        $this->colors = array(
            '00FFFF' => 'AQUA',
            '000000' => 'BLACK',
            '0000FF' => 'BLUE',
            'FF00FF' => 'FUCHSIA',
            '808080' => 'GRAY',
            '008000' => 'GREEN',
            '00FF00' => 'LIME',
            '800000' => 'MAROON',
            '000080' => 'NAVY',
            '808000' => 'OLIVE',
            '800080' => 'PURPLE',
            'FF0000' => 'RED',
            'C0C0C0' => 'SILVER',
            '008080' => 'TEAL',
            'FFFFFF' => 'WHITE',
            'FFFF00' => 'YELLOW'
        );
    }




}
/*
 echo "<img src='".$ruta."' width='400' />";
        echo "<div style='display:block;height:50px;width:400px;background-color:rgb(".$rPromedio.",".$gPromedio.",".$bPromedio.")'>";
$resultado = imagecolorresolve ( $image , $rgb['r'] , $rgb['g'] , $rgb['b']);
             print_r($resultado .' - '. $color.'<br>');
            if($resultado > $porcent){
                $porcent = $resultado; 
                print_r($resultado .' - '. $color);
                echo('<br>');
            }*/