<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $st=new \IteratorIterator();
        $st->name="taobao";
        $st->age=30;
        var_dump(iterator_to_array($st));
        
        return new ViewModel();
    }
    public function leafAction(){
          $viewModel=new ViewModel();
          $viewModel->setTerminal(true);
        $im=  imagecreate(670,500); 
        $white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF); 
        $g = imagecolorallocate($im, 0x00, 0x00, 0x00); 
        define("PII",M_PI/180); 
        function drawLeaf($im,$g,$x,$y,$L,$a){ 

            //    global $im; 
                $B = 50; 
                $C =9; 
                $s1 = 2; 
                $s2 = 3 ; 
                $s3 = 1.2; 
                if($L > $s1) 
                { 
                    $x2 = $x + $L * cos($a * PII); 
                    $y2 = $y + $L * sin($a * PII); 
                    $x2R = $x2 + $L / $s2 * cos(($a + $B) * PII); 
                    $y2R = $y2 + $L / $s2 * sin(($a + $B) * PII); 
                    $x2L = $x2 +$L / $s2 * cos(($a - $B) * PII); 
                    $y2L = $y2 + $L / $s2 * sin(($a - $B) * PII); 

                    $x1 = $x + $L / $s2 * cos($a * PII); 
                    $y1 = $y + $L / $s2 * sin($a * PII); 
                    $x1L = $x1 + $L / $s2 * cos(($a - $B) * PII); 
                    $y1L = $y1 + $L / $s2 * sin(($a - $B) * PII); 
                    $x1R = $x1 + $L / $s2 * cos(($a + $B) * PII); 
                    $y1R = $y1 + $L / $s2 * sin(($a + $B) * PII); 

                    ImageLine($im,(int)$x,  (int)$y,  (int)$x2,  (int)$y2,  $g); 
                    ImageLine($im,(int)$x2, (int)$y2, (int)$x2R, (int)$y2R, $g); 
                    ImageLine($im,(int)$x2, (int)$y2, (int)$x2L, (int)$y2L, $g); 
                    ImageLine($im,(int)$x1, (int)$y1, (int)$x1L, (int)$y1L, $g); 
                    ImageLine($im,(int)$x1, (int)$y1, (int)$x1R, (int)$y1R, $g); 

                    drawLeaf($im,$g, $x2,  $y2,  $L / $s3, $a + $C); 
                    drawLeaf($im,$g, $x2R, $y2R, $L / $s2, $a + $B); 
                    drawLeaf($im,$g, $x2L, $y2L, $L / $s2, $a - $B); 
                    drawLeaf($im,$g, $x1L, $y1L, $L / $s2, $a - $B); 
                    drawLeaf($im,$g, $x1R, $y1R, $L / $s2, $a + $B); 
                   } 
        } 
        drawLeaf($im,$g,300,500,100,270); 
        header("Content-type: image/png"); 
        imagepng($im);
    }

}


?>
