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
        
        $this->calculateRGBImg($image);
        
        $color = $this->desviationColor();

       
        return $data = array(
            'status' => 'success',
            'color'   => $color,
            'img' => $img
        );
        
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
    
    //calcular la desviacion que hay entre la imagen y los colores
    private function desviationColor(){
        
        $selectedColor =  array();
        $deviation = PHP_INT_MAX;

        foreach ($this->colors as $hex => $color) {
            $hexademial = $this->calcultaeRGB($hex);
            $curDev = $this->compareColors($this->rgb_img, $hexademial);
            if ($curDev < $deviation) {
                $deviation = $curDev;
                $selectedColor = array ( 'color'=>$color,
                    'hexa'=>'#'.$hex);  
            }
        }
        
        return $selectedColor;
        
    }
    
    //Color de la imagen que predomina más
    private function calculateRGBImg($image){
        
        $rTotal = 0;
        $gTotal = 0;
        $bTotal = 0;
        $total = 0;
                
        for ($x=0;$x<imagesx($image);$x++) {
            for ($y=0;$y<imagesy($image);$y++) {
                $rgb = imagecolorat($image,$x,$y);
                $r   = ($rgb >> 16) & 0xFF;
                $g   =  ($rgb >> 8) & 0xFF;
                $b   = $rgb & 0xFF;
                $rTotal += $r;
                $gTotal += $g;
                $bTotal += $b;
                $total++;
            }
        }
        $rAverage = round($rTotal/$total);
        $gAverage = round($gTotal/$total);
        $bAverage = round($bTotal/$total);
        
        $this->rgb_img['r'] = round($rTotal/$total);
        $this->rgb_img['g'] = round($gTotal/$total);
        $this->rgb_img['b'] = round($bTotal/$total);
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
    
    //Buscar el margen de diferencia entre imagen i color
    private function compareColors($colorA, $colorB) {
        return abs($colorA['r'] - $colorB['r']) + abs($colorA['g'] - $colorB['g']) + abs($colorA['b'] - $colorB['b']);
    }
    
    //Inicializar colores
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
